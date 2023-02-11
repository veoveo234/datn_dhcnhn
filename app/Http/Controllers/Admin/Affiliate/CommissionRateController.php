<?php

namespace App\Http\Controllers\Admin\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Product\Category;
use App\Models\User\Affiliate\CommissionRate;
use App\Http\Requests\Admin\Affiliate\CommissionRateRequest;

class CommissionRateController extends Controller
{
    public function index(Request $request) {
        $category = Category::select('id', 'name_cate')->where('status', 1)->get()->toArray();
        $category_filter = Category::select('id', 'name_cate')->get()->toArray();
        if(request()->ajax()) {
            $request->validate([
                'category' => 'required|min:0',
            ]);
            $category = $request->category;
            if($category == 0){
                $operatorCate = '<>';
            }else{
                $operatorCate = '=';
            }
            $data = DB::table('commission_rates')->join('categories', 'commission_rates.category_id', '=', 'categories.id')->select('commission_rates.id', 'commission_rates.category_id', 'categories.name_cate', 'commission_rates.rose_old', 'commission_rates.rose_new', 'commission_rates.status', 'commission_rates.created_at')->where('commission_rates.category_id', $operatorCate, $category)->get()->toArray();
            if(!empty($data)){
                foreach($data as $key => $value){
                    $data[$key]->created_at = date('d-m-Y', strtotime($value->created_at));
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/affiliate.commission-rate',[
            'category' => $category,
            'category_filter' => $category_filter,
        ]);
    }

    public function insert(Request $request){
        if(request()->ajax()) {
            $request->validate([
                'category_id' => 'required|integer',
                'rose_old' => 'required|integer|min:0',
                'rose_new' => 'required|integer|min:0',
            ]);
            $check = CommissionRate::select('id', 'category_id')->where('category_id', $request->category_id)->get()->toArray();
            if(empty($check)){
                CommissionRate::create([
                    'category_id' => $request->category_id,
                    'rose_old' => $request->rose_old,
                    'rose_new' => $request->rose_new,
                ]);
            }else{
                return 1;
            }
        }
    }

    public function delete(Request $request){
        if(request()->ajax()) {
            if(!empty($request->id) && is_numeric($request->id)){
                CommissionRate::find($request->id)->delete();
            }
        }
    }

    public function edit(Request $request){
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $data = DB::table('commission_rates')->join('categories', 'commission_rates.category_id', '=', 'categories.id')->select('commission_rates.id', 'commission_rates.category_id', 'categories.name_cate', 'commission_rates.rose_old', 'commission_rates.rose_new', 'commission_rates.status', 'commission_rates.created_at', 'commission_rates.updated_at')->where('commission_rates.id', '=', $request->id)->get()->toArray();
                
                return view('admin/pages/affiliate.edit-rate',[
                    'data' => $data
                ]);
            }
        }
    }

    public function update(Request $request){
        if(request()->ajax()){
            $id = $request->id;
            $rose_old = $request->rose_old;
            $rose_new = $request->rose_new;
            $status = $request->status;
            if(!empty($id) && is_numeric($id) && !empty($rose_old) && is_numeric($rose_old) && !empty($rose_new) && is_numeric($rose_new) && !empty($status) && is_numeric($status)){
                if($status == 1 || $status == 2){
                    $commissionRate = CommissionRate::find($id);
                    $commissionRate->rose_old = $rose_old;
                    $commissionRate->rose_new = $rose_new;
                    $commissionRate->status = $status;
                    $commissionRate->save();
                }
            }
        }
    }
}
