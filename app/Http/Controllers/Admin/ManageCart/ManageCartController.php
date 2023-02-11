<?php

namespace App\Http\Controllers\Admin\ManageCart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\User\ShoppingCart\Order;
use App\Models\User\ShoppingCart\OrderDetail;
use App\Models\User\Member\Member;
use App\Models\Admin\Product\Product;

class ManageCartController extends Controller
{
    function index(Request $request) {
        if(request()->ajax()) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|in:0,1,2,3,4,5,6,7',
                'payment' => 'required|in:0,1,2'
            ]);
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $status = $request->status;
            if($status == 0){
                $operatorStatus = '<>';
            }else{
                $operatorStatus = '=';
            }
            $payment = $request->payment;
            if($payment == 0){
                $operatorPayment = '<>';
            }else{
                $operatorPayment = '=';
            }

            if(($start_date) == ($end_date)){
                $data = DB::table('orders')->join('members', 'orders.member_id', '=', 'members.id')->select('orders.id', 'orders.member_id', 'members.name', 'members.phone', 'orders.total_money', 'orders.created_at', 'orders.status')->whereDate('orders.created_at', '=', $start_date)->where('orders.payment_method', $operatorPayment, $payment)->where('orders.status', $operatorStatus, $status)->get()->toArray();
            }else{
                $data = DB::table('orders')->join('members', 'orders.member_id', '=', 'members.id')->select('orders.id', 'orders.member_id', 'members.name', 'members.phone', 'orders.total_money', 'orders.created_at', 'orders.status')->whereBetween('orders.created_at', array($start_date, $end_date))->where('orders.payment_method', $operatorPayment, $payment)->where('orders.status', $operatorStatus, $status)->get()->toArray();
            }
            if(!empty($data)){
                foreach($data as $key => $value){
                    $data[$key]->created_at = date('d-m-Y', strtotime($value->created_at));
                }
            }
            foreach ($data as $key => $value){
                $data[$key]->order = $key+1;
            }
            session()->put('ssProductSheet', $data);
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/manage-cart.view-managecart');
    }

    public function edit(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->id)){
                $order = Order::find($request->id)->toArray();
                if(!empty($order)){
                    $order['created_at'] = date('d-m-Y', strtotime($order['created_at']));
                    $order['updated_at'] = date('d-m-Y', strtotime($order['updated_at']));
                }
                // $orderDetail = OrderDetail::select('*')->where('order_id', '=', $order['id'])->get()->toArray();

                $orderDetail = DB::table('order_details')->join('orders', 'order_details.order_id', '=', 'orders.id')->join('products', 'order_details.product_id', '=', 'products.id')->select('order_details.order_id', 'order_details.product_id', 'order_details.name', 'order_details.name_size', 'order_details.quantity', 'order_details.price', 'order_details.total_money', 'products.main_image')->where('order_details.order_id', '=', $order['id'])->get()->toArray();
                $member = Member::select('id', 'name', 'phone', 'address', 'email')->where('id', '=', $order['member_id'])->get()->toArray();
                return view('admin/pages/manage-cart.approval-cart',[
                    'order' => $order,
                    'orderDetail' => $orderDetail,
                    'member' => $member,
                ]);
            }
        }
    }

    public function update(Request $request){
        if($request->ajax()){
            if(!empty($request->id) && !empty($request->check)){
                if(($request->check) == 1){
                    $order = Order::find($request->id);
                    $order->status += 1;
                    $order->save();
                }elseif(($request->check) == 2){
                    if(!empty($request->status)){
                        $status = $request->status;
                        $pattern = '/^[1-7]{1}$/';
                        if (preg_match($pattern, $status)) {
                            $order = Order::find($request->id);
                            $order->status = $status;
                            $order->save();
                        }
                    }
                }
            }
        }
    }

    public function delete(Request $request){
        if(request()->ajax()){
            if(!empty($request->id)){
                Order::where('id', '=', $request->id)->update(['status' => 7]);
            }
        }
    }
}
