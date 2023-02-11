<?php

namespace App\Http\Controllers\Admin\DiscountCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Product\Category;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Discount_code;

class DiscountCodeController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::all()->toArray();
        if(request()->ajax()) {
            $data = DB::table('discount_codes')->select('id', 'title', 'type_code', 'price', 'time', 'status')->get()->toArray();
            foreach($data as $key => $value){
                $type_code = $value->type_code;
                if(($type_code) == 1){
                    $data[$key]->type = '1';
                    $data[$key]->type_code = 'Mã giảm giá % theo sản phẩm';
                }elseif(($type_code) == 2){
                    $data[$key]->type = '2';
                    $data[$key]->type_code = 'Mã giảm giá tiền';
                }elseif(($type_code) == 3){
                    $data[$key]->type = '3';
                    $data[$key]->type_code = 'Mã miễn phí vận chuyển';
                }

                $status = $value->status;
                if(($status) == 1){
                    $data[$key]->status = 'Đang hoạt động';
                }elseif(($status) == 2){
                    $data[$key]->status = 'Dừng hoạt động';
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/discount.view-discount',['category' => $category]);
    }

    public function viewAdd(Request $request){
        $category = Category::all()->toArray();
        return view('admin/pages/discount.add-discount',['category' => $category]); 
    }

    public function showCode(Request $request){
        if(request()->ajax()) {
            if(!empty($request->id) && is_numeric($request->id)) {
                $data = Discount_code::select('*')->where('id', '=', $request->id)->where('status', 1)->get()->toArray();
                return response()->json(['data' => $data]);
            }
        }
    }

    public function insertCode(Request $request){
        if(request()->ajax()) {
            $request->validate([
                'category_id' => 'nullable|integer',
                'title' => 'required',
                'quantity' => 'required|min:1',
                'time' => 'required|min:1|max:6',
                'code' => 'required',
                'typeCode' => 'required|min:1|max:3',
                'check' => 'required|integer|min:1|max:2'
            ]);

            if(($request->check) == 1){
                $request->validate([
                    'price' => 'nullable|integer|min:1|max:100'
                ]);
                $discount_code = new Discount_code;
                if(($request->category_id) == 0){

                }else{
                    $discount_code->category_id  = $request->category_id;
                }
                $discount_code->title = $request->title;
                $discount_code->code = $request->code;
                $discount_code->type_code = $request->typeCode;
                $discount_code->price = $request->price;
                $discount_code->quantity = $request->quantity;
                $discount_code->time = $request->time;
                $discount_code->save();
            }elseif(($request->check) == 2){
                $request->validate([
                    'price' => 'nullable|integer|min:1'
                ]);
                $discount_code = new Discount_code;
                if(($request->category_id) == 0){

                }else{
                    $discount_code->category_id  = $request->category_id;
                }
                $discount_code->title = $request->title;
                $discount_code->code = $request->code;
                $discount_code->type_code = $request->typeCode;
                $discount_code->price = $request->price;
                $discount_code->quantity = $request->quantity;
                $discount_code->time = $request->time;
                $discount_code->save();

            }
        }
    }

    public function updateCode(Request $request){
        if(request()->ajax()) {
            $request->validate([
                'category_id' => 'nullable|integer',
                'id' => 'nullable|integer',
                'title' => 'required',
                'quantity' => 'required|min:1',
                'time' => 'required|min:1|max:6',
            ]);
            $check = Discount_code::where('id','<>',$request->id)->where('title',$request->title)->get()->toArray();
            if(empty($check)){
                $discount_code = Discount_code::find($request->id);
                $discount_code->category_id = $request->category_id;
                $discount_code->title = $request->title;
                $discount_code->price = $request->price;
                $discount_code->quantity = $request->quantity;
                $discount_code->time = $request->time;
                $discount_code->save();
            }else{
                return 'error';
            }
        }
    }

    public function delete(Request $request){
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                Discount_code::find($request->id)->delete();
            }
        }
    }

}


