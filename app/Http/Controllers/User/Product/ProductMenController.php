<?php

namespace App\Http\Controllers\User\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use App\Models\Admin\Product\Comment;
use Illuminate\Support\Facades\Cache;

class ProductMenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gender = 1;
        $men = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('products.status', '<>', 5)->where('categories.gender_product', '=', $gender)->orderBy('products.id', 'DESC')->paginate(18);
        // $men = Cache::remember('men', 900, function () use($gender) {
        //     return DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status')->where('products.status', '<>', 5, 'and', 'categories.gender_product', '=', $gender)->orderBy('products.id', 'DESC')->paginate(18);
        // });
        // $cart = Cart::count();
        return view('User/pages/product.men-product', [
            'data' => $men,
            // 'count' => $cart,
            'gender' => $gender,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailWomen = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.category_id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.description', 'categories.name_cate', 'brands.name_brand')->where('products.id', '=', $id)->get()->toArray();
        if(!empty($detailWomen)){
            $detailSize = DB::table('detail_sizes')->select('detail_sizes.id', 'detail_sizes.name_size', 'detail_sizes.quantity')->where('detail_sizes.product_id', '=', $id)->get()->toArray();
    
            $detailImage = DB::table('detail_images')->select('detail_images.id', 'detail_images.sub_image')->where('detail_images.product_id', '=', $id)->get()->toArray();
            
            $comments = Comment::select('comments.*', 'members.avatar', 'members.name AS member_name', 'members.email AS member_email')->leftJoin('members', 'members.id', '=', 'comments.member_id')->where('product_id', '=', $id)->orderBy('id', 'DESC')->paginate(3);
            
            // $cart = Cart::count();
            return view('User/pages/product.detail-product',[
                'detailWomen' => $detailWomen,
                'detailSize' => $detailSize,
                'detailImage' => $detailImage,
                // 'count' => $cart,
                'dataComment' => $comments,
            ]);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detailWomen = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.description', 'categories.name_cate', 'brands.name_brand')->where('products.id', '=', $id)->get()->toArray();

        $detailSize = DB::table('detail_sizes')->select('detail_sizes.id', 'detail_sizes.name_size', 'detail_sizes.quantity')->where('detail_sizes.product_id', '=', $id)->get()->toArray();

        $detailImage = DB::table('detail_images')->select('detail_images.id', 'detail_images.sub_image')->where('detail_images.product_id', '=', $id)->get()->toArray();
        // $cart = Cart::count();
        
        return view('User/pages/product.modal-product',[
            'detailWomen' => $detailWomen,
            'detailSize' => $detailSize,
            'detailImage' => $detailImage,
            // 'count' => $cart
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->views += 1;
        $product->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
