<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product\Category;
use Illuminate\Support\Facades\Storage;
use DB;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'category' => 'required|in:0,1,2',
                'product' => 'required|in:0,1,2,3,4,5,6,7,8'
            ]);
            $category = $request->category;
            if($category == 0){
                $operatorCate = '<>';
            }else{
                $operatorCate = '=';
            }
            $product = $request->product;
            if($product == 0){
                $operatorPro = '<>';
            }else{
                $operatorPro = '=';
            }
            $data = Category::select('*')->where('gender_product', $operatorCate, $category)->where('items', $operatorPro, $product)->get()->toArray();
            if(!empty($data)){
                foreach($data as $key => $value){
                    $data[$key]['created_at'] = date('d-m-Y', strtotime($value['created_at']));
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/category-product.view-category');
    }

    public function insert(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'gender' => 'required|in:1,2',
                'items' => 'required|in:1,2,3,4,5,6,7,8',
                'name_cate' => 'required'
            ]);
            $items = $request->items;
            $check = Category::select('name_cate')->where('name_cate', '=', $request->name_cate)->get()->toArray();
            if(($request->gender) == 1){
                if($items == 1 || $items == 3 || $items == 5 || $items == 7){
                    if(empty($check)){
                        Category::create([
                            'gender_product' => $request->gender,
                            'items' => $items,
                            'name_cate' => $request->name_cate,
                        ]);
                    }else{
                        echo 1;
                    }
                }
            }elseif(($request->gender) == 2){
                if($items == 2 || $items == 4 || $items == 6 || $items == 8){
                    if(empty($check)){
                        Category::create([
                            'gender_product' => $request->gender,
                            'items' => $items,
                            'name_cate' => $request->name_cate,
                        ]);
                    }else{
                        echo 1;
                    }
                }
            }
        }
    }

    public function destroy(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                Category::find($request->id)->delete();
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $category = Category::select('id', 'gender_product', 'items', 'name_cate', 'status')->where('id', '=', $request->id)->get()->toArray();
                return response()->json(['data' => $category]);
            }
        }
    }

    public function update(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'id' => 'required|integer|min:1',
                'gender' => 'required|in:1,2',
                'items' => 'required|in:1,2,3,4,5,6,7,8',
                'name_cate' => 'required',
                'status' => 'required|min:1|max:2'
            ]);
            $items = $request->items;
            $check = Category::select('id', 'name_cate')->where('id', '=', $request->id)->get()->toArray();
            if($check[0]['name_cate'] == $request->name_cate){
                $category = Category::find($request->id);
                $category->gender_product = $request->gender;
                if(($request->gender) == 1){
                    if($items == 1 || $items == 3 || $items == 5 || $items == 7){
                        $category->items = $items;
                    }
                }elseif(($request->gender) == 2){
                    if($items == 2 || $items == 4 || $items == 6 || $items == 8){
                        $category->items = $items;
                    }
                }
                $category->name_cate = $request->name_cate;
                $category->status = $request->status;
                $category->save();
            }else{
                $checkName = Category::select('name_cate')->where('name_cate', '=', $request->name_cate)->where('id', '<>', $request->id)->get()->toArray();
                if(empty($checkName)){
                    $category = Category::find($request->id);
                    $category->gender_product = $request->gender;
                    if(($request->gender) == 1){
                        if($items == 1 || $items == 3 || $items == 5 || $items == 7){
                            $category->items = $items;
                        }
                    }elseif(($request->gender) == 2){
                        if($items == 2 || $items == 4 || $items == 6 || $items == 8){
                            $category->items = $items;
                        }
                    }
                    $category->name_cate = $request->name_cate;
                    $category->status = $request->status;
                    $category->save();
                }else{
                    echo 1;
                }
            }
        }
    }

}
