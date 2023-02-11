<?php

namespace App\Http\Controllers\User\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountLoginRequest;
use App\Http\Requests\User\AccountRegisterRequest;
use App\Models\User\Member\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\User\ShoppingCart\Order;
use App\Http\Requests\User\InformationOrder;

class AccountController extends Controller
{
    public function view_login()
    {
        return view('User.pages.account.login');
    }

    public function view_register()
    {
        return view('User.pages.account.register');
    }

    public function register(AccountRegisterRequest $request)
    {
        $image = $request->file('avatar')->hashName();
        Storage::putFile('public/images/avatar', $request->file('avatar'));
        $member = Member::create([
            'avatar' => $image,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login-view');
    }
    public function login(AccountLoginRequest $request)
    {
        $member = Member::query()->where('email', $request->email)->first();
        if (!empty($member->password)) {
            if (!Hash::check($request->password, $member->password)) {
                return redirect()->back()->with('login_failed', 'Tài khoản hoặc mật khẩu không chính xác!');
            } else {
                session()->put('member_id', $member->id);

                if(session()->has('checkout-login')){
                    session()->forget('checkout-login');
                    return redirect()->route('checkout.index');
                }else{
                    return redirect()->route('index');
                }
            }
        }else{
            return redirect()->back()->with('login_failed','Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function logout()
    {
        session()->forget('member_id');
        return redirect()->route('index');
    }

    public function information()
    {
        if(session()->has('member_id')){
            $member = Member::select('avatar')->where('id', '=', session('member_id'))->get()->toArray();
            return view('User/pages/account.account-information',[
                'data' => $member,
            ]);
        }else{
            return redirect()->route('login-view');
        }
    }

    public function loadInformation()
    {
        if(session()->has('member_id')){
            return view('User/pages/account/information.information');
        }
    }

    public function dataInformation()
    {
        if(session()->has('member_id')){
            $member = Member::select('id', 'name', 'phone', 'address', 'email')->where('id', '=', session('member_id'))->get()->toArray();
            return response()->json(['data' => $member]);
        }
    }

    public function uploadAvatar(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);
            if(session()->has('member_id')){
                if($request->hasFile('avatar')){
                    $image = $request->file('avatar')->hashName();
                    Storage::putFile('public/images/avatar', $request->file('avatar'));

                    $member = Member::select('avatar')->where('id', '=', session('member_id'))->get()->toArray();
                    if(!empty($member)){
                    $des_path = 'storage/images/avatar/' . $member[0]['avatar'];
                        if (file_exists($des_path)) {
                            unlink($des_path);
                        }
                    }

                    $updateAvatar = Member::find(session('member_id'));
                    $updateAvatar->avatar = $image;
                    $updateAvatar->save();
                }
            }
        }
    }

    public function updateInformation(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'name' => 'required|string',
                'phone' => 'required|regex:/^0[0-9]{9}$/',
                'address' => 'required',
                'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
            ]);
            if (session()->has('member_id')) {
                $checkPhone = Member::select('id', 'phone')->where('id', '=', session('member_id'))->where('phone', $request->phone)->get()->toArray();
                $checkMail = Member::select('id', 'email')->where('id', '=', session('member_id'))->where('email', $request->email)->get()->toArray();

                $member = Member::find(session('member_id'));
                $member->name = $request->name;
                $member->address = $request->address;
                if(!empty($checkMail) && !empty($checkPhone)){
                    $member->phone = $request->phone;
                    $member->email = $request->email;
                    echo 'success';
                }elseif(!empty($checkMail) && empty($checkPhone)){
                    $member->email = $request->email;
                    $check = Member::query()->where('id', '!=', session('member_id'))->where('phone', $request->phone)->first();
                    if($check == NULL){
                        $member->phone = $request->phone;
                        echo 'success';
                    }else{
                        echo 'error mail';
                    }
                }elseif(empty($checkMail) && !empty($checkPhone)){
                    $member->phone = $request->phone;
                    $check = Member::query()->where('id', '!=', session('member_id'))->where('email', $request->email)->first();
                    if($check == NULL){
                        $member->email = $request->email;
                        echo 'success';
                    }else{
                        echo 'error mail';
                    }
                }elseif(empty($checkMail) && empty($checkPhone)){
                    $checkM = Member::query()->where('id', '!=', session('member_id'))->where('email', $request->email)->first();
                    $checkP = Member::query()->where('id', '!=', session('member_id'))->where('phone', $request->phone)->first();
                    if($checkM == NULL && $checkP == NULL){
                        $member->email = $request->email;
                        $member->phone = $request->phone;
                        echo 'success';
                    }elseif($checkM != NULL && $checkP == NULL){
                        $member->phone = $request->phone;
                        echo 'error mail';
                    }elseif($checkM == NULL && $checkP != NULL){
                        $member->email = $request->email;
                        echo 'error phone';
                    }elseif($checkM != NULL && $checkP != NULL){
                        echo 'error all';
                    }
                }
                $member->save();
            }
        }
    }

    public function changePass(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'pass_old' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'password_confirm' => 'required|required_with:password|same:password',
            ]);
            if (session()->has('member_id')) {
                $check = Member::query()->where('id', session('member_id'))->first();
                if (Hash::check($request->pass_old, $check->password)) {
                    $member = Member::find(session('member_id'));
                    $member->password = Hash::make($request->password);
                    $member->save();
                    echo 'success';
                }else{
                    echo 'error';
                }
            }
        }
    }

    public function loadManageOrder()
    {
        if (session()->has('member_id')) {
            if(request()->ajax()) {
                return view('User/pages/account/information.manage-order');
            }
        }
    }

    public function dataManageOrder(Request $request)
    {
        if (session()->has('member_id')) {
            $member_id = session('member_id');
            if(request()->ajax()) {
                if(!empty($request->start_date) && !empty($request->end_date)) {
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;
                    if(($start_date) == ($end_date)){
                        $data = DB::table('order_details')->join('products', 'order_details.product_id', '=', 'products.id')->join('orders', 'order_details.order_id', '=', 'orders.id')->select('order_details.order_id', 'order_details.product_id', 'products.main_image', 'order_details.name', 'order_details.name_size', 'order_details.quantity', 'order_details.price', 'order_details.total_money', 'orders.status')->where('orders.member_id', '=', $member_id)->whereDate('order_details.created_at', '=', $start_date)->get()->toArray();
                    }else{
                        $data = DB::table('order_details')->join('products', 'order_details.product_id', '=', 'products.id')->join('orders', 'order_details.order_id', '=', 'orders.id')->select('order_details.order_id', 'order_details.product_id', 'products.main_image', 'order_details.name', 'order_details.name_size', 'order_details.quantity', 'order_details.price', 'order_details.total_money', 'orders.status')->where('orders.member_id', '=', $member_id)->whereBetween('order_details.created_at', array($start_date, $end_date))->get()->toArray();
                    }
                }
                foreach($data as $key => $value){
                    $status = $value->status;
                    if(($status) == 1){
                        $data[$key]->status = 'Chờ xử lý';
                    }elseif(($status) == 2){
                        $data[$key]->status = 'Đã xác nhận';
                    }elseif(($status) == 3){
                        $data[$key]->status = 'Chờ lấy hàng';
                    }elseif(($status) == 4){
                        $data[$key]->status = 'Đang giao hàng';
                    }elseif(($status) == 5){
                        $data[$key]->status = 'Đã giao hàng';
                    }elseif(($status) == 6){
                        $data[$key]->status = 'Đã hoàn tất';
                    }elseif(($status) == 7){
                        $data[$key]->status = 'Đã hủy';
                    }
                }
                return Datatables::of($data)->make(true);
            }
            return view('User/pages/account/information.manage-order');
        }
    }

    public function detailOrder(InformationOrder $request)
    {
        if (session()->has('member_id')) {
            if(request()->ajax()) {
                $order = Order::select('*')->where('id', '=', $request->order_id)->where('member_id', '=', session('member_id'))->get()->toArray();

                $orderDetail = DB::table('order_details')->join('orders', 'order_details.order_id', '=', 'orders.id')->join('products', 'order_details.product_id', '=', 'products.id')->select('order_details.order_id', 'order_details.product_id', 'order_details.name', 'order_details.name_size', 'order_details.quantity', 'order_details.price', 'order_details.total_money', 'products.main_image')->where('order_details.order_id', '=', $order[0]['id'])->get()->toArray();

                $member = Member::select('id', 'name', 'phone', 'address', 'email')->where('id', '=', session('member_id'))->get()->toArray();
                return view('User/pages/account/information.detail-order',[
                    'order' => $order,
                    'orderDetail' => $orderDetail,
                    'member' => $member,
                ]);
            }
        }
    }

    public function cancelOrder(InformationOrder $request)
    {
        if (session()->has('member_id')) {
            if(request()->ajax()) {
                Order::where('id', '=', $request->order_id)->where('member_id', '=', session('member_id'))->where('status', '=', 1)->update(['status' => 7]);
            }
        }
    }


}
