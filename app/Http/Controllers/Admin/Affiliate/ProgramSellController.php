<?php

namespace App\Http\Controllers\Admin\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\Affiliate\ProgramSellRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User\Affiliate\ProgramSell;
use App\Models\User\Affiliate\CommissionRate;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\Category;

class ProgramSellController extends Controller
{
    public function index(Request $request)
    {
        $category = DB::table('categories')->join('commission_rates', 'categories.id', '=', 'commission_rates.category_id')->select('categories.id', 'categories.name_cate', 'commission_rates.rose_old', 'commission_rates.rose_new')->get()->toArray();
        // dd($category);
        if(request()->ajax()) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'category' => 'required|min:0',
            ]);
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $category = $request->category;
                if($category == 0){
                    $operatorCategory = '<>';
                }else{
                    $operatorcategory = '=';
                }
                if(($start_date) == ($end_date)){
                    $data = DB::table('program_sells')
                                ->join('products', 'program_sells.product_id', '=', 'products.id')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->select('program_sells.id', 'program_sells.image', 'categories.name_cate', 'products.name', 'program_sells.title', 'program_sells.rose_old', 'program_sells.rose_new', 'program_sells.status', 'program_sells.created_at')->whereDate('program_sells.created_at', '=', $start_date)->where('products.category_id', $operatorCategory, $category)->get()->toArray();
                }else{
                    $data = DB::table('program_sells')->join('products', 'program_sells.product_id', '=', 'products.id')->join('categories', 'products.category_id', '=', 'categories.id')->select('program_sells.id', 'program_sells.image', 'categories.name_cate', 'products.name', 'program_sells.title', 'program_sells.rose_old', 'program_sells.rose_new', 'program_sells.status', 'program_sells.created_at')->where('products.category_id', $operatorCategory, $category)->whereBetween('program_sells.created_at', array($start_date, $end_date))->get()->toArray();
                }
            foreach($data as $key => $value){
                $status = $value->status;
                if(($status) == 1){
                    $data[$key]->status = 'Đang hoạt động';
                }elseif(($status) == 2){
                    $data[$key]->status = 'Dừng hoạt động';
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/affiliate.view-program',[
            'category' => $category,
        ]);
    }

    public function viewAdd(Request $request){
        // $category = Category::select('id', 'name_cate')->where('status', 1)->get()->toArray();
        $category = DB::table('categories')->join('commission_rates', 'categories.id', '=', 'commission_rates.category_id')->select('categories.id', 'categories.name_cate', 'commission_rates.rose_old', 'commission_rates.rose_new')->where('categories.status', 1)->get()->toArray();
        return view('admin/pages/affiliate/pages.add-program',[
            'category' => $category
        ]);
    }

    public function view(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->id) && is_numeric($request->id)) {
                $dataRose = CommissionRate::select('id', 'rose_old', 'rose_new')->where('category_id', '=', $request->id)->get()->toArray();
                $dataProduct = Product::select('id', 'name')->where('category_id', '=', $request->id)->get()->toArray();
                // dd($dataProduct);
                return response()->json(['dataRose' => $dataRose, 'dataProduct' => $dataProduct]);
            }
        }
    }

    public function insert(ProgramSellRequest $request)
    {
        $validated = $request->validated();
        if(request()->ajax()){
            $check = ProgramSell::select('id')->where('product_id', '=', $request->product_id)->get()->toArray();
            if(empty($check)){
                if($request->hasFile('file')){
                    $image = $request->file('file')->hashName();
                    Storage::putFile('public/images/affiliate', $request->file('file'));
    
                    ProgramSell::create([
                        'commission_id' => $request->commission_id,
                        'product_id' => $request->product_id,
                        'image' => $image,
                        'title' => $request->title,
                        'rose_old' => $request->rose_old,
                        'rose_new' => $request->rose_new,
                        'description' => $request->description
                    ]);
                    echo 0;
                }
            }else{
                echo 1;
            }
        }
    }

    public function delete(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $programSell = ProgramSell::select('image')->where('id', '=', $request->id)->get()->toArray();
                $des_path = 'storage/images/affiliate/' . $programSell[0]['image'];
                if (file_exists($des_path)) {
                    unlink($des_path);
                }

                ProgramSell::find($request->id)->delete();
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $data = DB::table('program_sells')->join('products', 'program_sells.product_id', '=', 'products.id')->join('categories', 'products.category_id', '=', 'categories.id')->select('program_sells.id', 'program_sells.image', 'categories.name_cate', 'products.name', 'program_sells.title', 'program_sells.rose_old', 'program_sells.rose_new', 'program_sells.description', 'program_sells.status', 'program_sells.created_at', 'program_sells.updated_at')->where('program_sells.id', '=', $request->id)->get()->toArray();

                return view('admin/pages/affiliate.edit-program',[
                    'data' => $data
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'file' => 'image|mimes:jpg,png,jpeg',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|min:1|max:2',
        ]);
        if($request->hasFile('file')){
            $image = $request->file('file')->hashName();
            Storage::putFile('public/images/affiliate', $request->file('file'));
            
            $programSell = ProgramSell::select('image')->where('id', '=', $request->id)->get()->toArray();
            $des_path = 'storage/images/affiliate/' . $programSell[0]['image'];
            if (file_exists($des_path)) {
                unlink($des_path);
            }
            
            $program = ProgramSell::find($request->id);
            $program->image = $image;
            $program->title = $request->title;
            $program->description = $request->description;
            $program->status = $request->status;
            $program->save();
        }else{
            $program = ProgramSell::find($request->id);
            $program->title = $request->title;
            $program->description = $request->description;
            $program->status = $request->status;
            $program->save();
        }
    }

}
