<?php

namespace App\Http\Controllers\User\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Product\Comment;
use App\Models\Admin\Product\ReplyComment;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //* Comment product
    public function loadComment(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'id' => 'required|integer|min:0',
                'page' => 'required|integer|min:0',
            ]);
            $id = $request->id;
            $comments = Comment::select('comments.*', 'members.avatar', 'members.name AS member_name', 'members.email AS member_email')->leftJoin('members', 'members.id', '=', 'comments.member_id')->where('product_id', '=', $id)->orderBy('id', 'DESC')->paginate(3);
            // dd($comments);
            return view('User/pages/product/pages.load-comment',[
                'dataComment' => $comments,
            ]);
        }
    }

    public function addComment(Request $request)
    {
        if(request()->ajax()) {
            if(($request->account) == 0){
                $request->validate([
                    'id' => 'required|integer|min:0',
                    'name' => 'required',
                    'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                    'comment' => 'required',
                ]);
                Comment::create([
                    'product_id' => $request->id,
                    'email' => $request->email,
                    'name' => $request->name,
                    'comment' => $request->comment,
                ]);
            }elseif(($request->account) == 1){
                $request->validate([
                    'id' => 'required|integer|min:0',
                    'comment' => 'required',
                ]);
                if(session()->has('member_id')){
                    Comment::create([
                        'product_id' => $request->id,
                        'member_id' => session('member_id'),
                        'comment' => $request->comment,
                    ]);
                }
            }
        }
    }

    public function replyComment(Request $request)
    {
        if(request()->ajax()) {
            if(($request->account) == 1){
                $request->validate([
                    'id' => 'required|integer|min:0',
                    'reply' => 'required',
                ]);
                if(session()->has('member_id')){
                    ReplyComment::create([
                        'comment_id' => $request->id,
                        'member_id' => session('member_id'),
                        'reply_comment' => $request->reply,
                    ]);
                }
            }
        }
    }

    public function editComment(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'id' => 'required|integer|min:0'
            ]);
            if(($request->check) == 1){
                $select = Comment::select('id', 'comment')->where('id', '=', $request->id)->get()->toArray();
                return response()->json(['data' => $select]);
            }elseif(($request->check) == 2){
                $select = ReplyComment::select('id', 'reply_comment AS comment')->where('id', '=', $request->id)->get()->toArray();
                return response()->json(['data' => $select]);
            }
        }
    }

    public function updateComment(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'id' => 'required|integer|min:0',
                'comment' => 'required'
            ]);
            if(session()->has('member_id')){
                if(($request->check) == 1){
                    $check = Comment::select('id', 'member_id')->where('id', '=', $request->id)->get()->toArray();
                    if(session('member_id') == $check[0]['member_id']){
                        $comment = Comment::find($request->id);
                        $comment->comment = $request->comment;
                        $comment->save();
                    }
                }elseif(($request->check) == 2){
                    $check = ReplyComment::select('id', 'member_id')->where('id', '=', $request->id)->get()->toArray();
                    if(session('member_id') == $check[0]['member_id']){
                        $comment = ReplyComment::find($request->id);
                        $comment->reply_comment = $request->comment;
                        $comment->save();
                    }
                }
            }
        }
    }

    public function deleteComment(Request $request)
    {
        if(request()->ajax()) {
            if(($request->account) == 1){
                $request->validate([
                    'id' => 'required|integer|min:0'
                ]);
                if(session()->has('member_id')){
                    if(($request->checkTable) == 1){
                        $check = Comment::select('id', 'member_id')->where('id', '=', $request->id)->get()->toArray();
                        if(session('member_id') == $check[0]['member_id'] || session('member_id') == 1){
                            Comment::find($request->id)->delete();
                        }
                    }elseif(($request->checkTable) == 2){
                        $check = ReplyComment::select('id', 'member_id')->where('id', '=', $request->id)->get()->toArray();
                        if(session('member_id') == $check[0]['member_id'] || session('member_id') == 1){
                            ReplyComment::find($request->id)->delete();
                        }
                    }
                }
            }elseif(($request->account) == 0){
                $request->validate([
                    'id' => 'required|integer|min:0',
                    'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                ]);
                if(($request->checkTable) == 1){
                    $check = Comment::select('id', 'member_id', 'email')->where('id', '=', $request->id)->get()->toArray();
                    if($request->email == $check[0]['email'] && $check[0]['member_id'] == NULL){
                        Comment::find($request->id)->delete();
                    }else{
                        echo 'error';
                    }
                }elseif(($request->checkTable) == 2){
                    $check = ReplyComment::select('id', 'member_id', 'email')->where('id', '=', $request->id)->get()->toArray();
                    if($request->email == $check[0]['email'] && $check[0]['member_id'] == NULL){
                        ReplyComment::find($request->id)->delete();
                    }else{
                        echo 'error';
                    }
                }
            }
        }
    }


    //* Load product
    public function loadProduct(Request $request){
        if(request()->ajax()) {
            $request->validate([
                'gender' => 'required|integer|min:1|max:2',
                'status' => 'required|integer|min:0|max:5',
                'filter' => 'required|integer|min:0|max:1',
                'category_id' => 'required|integer|min:0',
                'brand_id' => 'required|integer|min:0',
            ]);
            $category_id = $request->category_id;
            $brand_id = $request->brand_id;
            if(($request->category_id) == 0){
                if(($request->brand_id) == 0){
                    if(($request->filter) == 0){
                        $category_id = 0;
                        $brand_id = 0;
                        if(($request->value) == 0){
                            $orderBy = 'id';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }elseif(($request->filter) == 1){
                        if(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }
                }else{
                    $category_id = 0;
                    $brand_id = $request->brand_id;
                    if(($request->filter) == 0){
                        if(($request->value) == 0){
                            $orderBy = 'id';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }elseif(($request->filter) == 1){
                        if(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }
                }
            }else{
                if(($request->brand_id) == 0){
                    if(($request->filter) == 0){
                        $category_id = $request->category_id;
                        $brand_id = 0;
                        if(($request->value) == 0){
                            $orderBy = 'id';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }elseif(($request->filter) == 1){
                        if(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }
                }else{
                    $category_id = $request->category_id;
                    $brand_id = $request->brand_id;
                    if(($request->filter) == 0){
                        if(($request->value) == 0){
                            $orderBy = 'id';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }elseif(($request->filter) == 1){
                        if(($request->value) == 1){
                            $orderBy = 'price';
                            $sort = 'ASC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }elseif(($request->value) == 2){
                            $orderBy = 'price';
                            $sort = 'DESC';
                            if(($request->status) == 0){
                                $status = 5;
                            }else{
                                $status = $request->status;
                            }
                        }
                    }
                }
            }
            $gender = $request->gender;
            if($category_id == 0){
                if($brand_id == 0){
                    if($status == 5){
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('products.status', '<>', 5)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }else{
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('products.status', '=', $status)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }
                }else{
                    if($status == 5){
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('brands.id', '=', $brand_id)->where('products.status', '<>', 5)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }else{
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('brands.id', '=', $brand_id)->where('products.status', '=', $status)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }
                }
            }else{
                if($brand_id == 0){
                    if($status == 5){
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('categories.id', '=', $category_id)->where('products.status', '<>', 5)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }else{
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('categories.id', '=', $category_id)->where('products.status', '=', $status)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }
                }else{
                    if($status == 5){
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('brands.id', '=', $brand_id)->where('categories.id', '=', $category_id)->where('products.status', '<>', 5)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }else{
                        $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('categories.id', '=', $category_id)->where('brands.id', '=', $brand_id)->where('products.status', '=', $status)->where('categories.gender_product', '=', $gender)->orderBy('products.'.$orderBy, $sort)->paginate(15);
                    }
                }
            }
            
            // dd($data);
            return view('User/pages/product/pages.load-product', [
                'data' => $data,
                'gender' => $gender,
            ]);
        }
    }

    //* Load category product
    public function loadCategory(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'gender' => 'required|integer|min:1|max:2',
            ]);
            if(($request->gender) == 1 || ($request->gender) == 2){
                $gender = $request->gender;
                $data = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')->select('categories.id', 'categories.name_cate', DB::raw('count(products.id) as countSL'))->where('categories.gender_product', '=', $gender)->groupBy('categories.id')->orderByRaw("RAND()")->limit(10)->get()->toArray();
                return response()->json(['data' => $data]);
            }
        }
    }

    //* Load brand product
    public function loadBrand(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'gender' => 'required|integer|min:1|max:2',
            ]);
            if(($request->gender) == 1 || ($request->gender) == 2){
                $data = DB::table('brands')->join('products', 'brands.id', '=', 'products.brand_id')->select('brands.id', 'brands.name_brand', DB::raw('count(products.id) as countSL'))->groupBy('brands.id')->orderByRaw("RAND()")->limit(10)->get()->toArray();

                return response()->json(['data' => $data]);
            }
        }
    }

    //* Live search data product
    public function liveSearch(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'search' => 'required',
            ]);
            $search = $request->search;
            $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'categories.gender_product')->where('products.name', 'like', '%'.$search.'%')->orWhere('products.price', 'like', '%'.$search.'%')->where('products.status', '<>', 5)->orderBy('products.views', 'DESC')->limit(5)->get()->toArray();

            return response()->json(['data' => $data]);
        }
    }

}
