<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Product\Brand;

class BrandController extends Controller
{
    public function index(Request $request){
        if(request()->ajax()) {
            $data = Brand::select('*')->get()->toArray();
            if(!empty($data)){
                foreach($data as $key => $value){
                    $status = $value['status'];
                    if(($status) == 1){
                        $data[$key]['status'] = 'Đang hoạt động';
                    }elseif(($status) == 2){
                        $data[$key]['status'] = 'Dừng hoạt động';
                    }
                    $data[$key]['created_at'] = date('d-m-Y', strtotime($value['created_at']));
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/brand.view-brand');
    }

    public function insert(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'name_brand' => 'required',
                'file' => 'image|mimes:jpg,png,jpeg'
            ]);
            $check = Brand::select('id', 'name_brand')->where('name_brand', '=', $request->name_brand)->get()->toArray();
            if(empty($check)){
                if($request->hasFile('file')){
                    $image = $request->file('file')->hashName();
                    Storage::putFile('public/images/brand', $request->file('file'));

                    Brand::create([
                        'name_brand' => $request->name_brand,
                        'image_brand' => $image
                    ]);
                }
            }else{
                echo 1;
            }
        }
    }

    public function destroy(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $id = $request->id;
                $brand = Brand::select('image_brand')->where('id', '=', $id)->get()->toArray();
                if(!empty($brand)){
                    $des_path = 'storage/images/brand/' . $brand[0]['image_brand'];
                    if (file_exists($des_path)) {
                        unlink($des_path);
                    }
                }
                Brand::find($id)->delete();
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $brand = Brand::select('id', 'name_brand', 'image_brand', 'status')->where('id', '=', $request->id)->get()->toArray();
                return response()->json(['data' => $brand]);
            }
        }
    }

    public function update(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'id' => 'required|integer|min:1',
                'name_brand' => 'required',
                'file' => 'nullable|image|mimes:jpg,png,jpeg',
                'status' => 'required|min:1|max:2'
            ]);

            $selectImage = Brand::select('name_brand', 'image_brand')->where('id', '=', $request->id)->get()->toArray();
            if(($selectImage[0]['name_brand']) == $request->name_brand){
                $brand = Brand::find($request->id);
                $brand->name_brand = $request->name_brand;
                if($request->hasFile('file')){
                    $image = $request->file('file')->hashName();
                    // dd($image);
                    Storage::putFile('public/images/brand', $request->file('file'));

                    $des_path = 'storage/images/brand/' . $selectImage[0]['image_brand'];
                    if (file_exists($des_path)) {
                        unlink($des_path);
                    }

                    $brand->image_brand = $image;
                }else{

                }
                $brand->status = $request->status;
                $brand->save();
            }else{
                $check = Brand::select('id', 'name_brand')->where('name_brand', '=', $request->name_brand)->where('id', '<>', $request->id)->get()->toArray();
                if(empty($check)){
                    if($request->hasFile('file')){
                        $image = $request->file('file')->hashName();
                        Storage::putFile('public/images/brand', $request->file('file'));

                        $des_path = 'storage/images/brand/' . $selectImage[0]['image_brand'];
                        if (file_exists($des_path)) {
                            unlink($des_path);
                        }
                        $brand = Brand::find($request->id);
                        $brand->name_brand = $request->name_brand;
                        $brand->image_brand = $image;
                        $brand->status = $request->status;
                        $brand->save();
                    }else{
                        $brand = Brand::find($request->id);
                        $brand->name_brand = $request->name_brand;
                        $brand->status = $request->status;
                        $brand->save();
                    }
                }else{
                    echo 1;
                }
            }
        }
    }


}
