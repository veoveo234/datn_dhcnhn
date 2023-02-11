<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // $cart = Cart::count();
        
        $bestseller = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status', 'products.views', 'categories.gender_product')->where('products.status', '=', '3')->orderBy('products.views', 'DESC')->orderBy('products.id', 'DESC')->limit(12)->get()->toArray();
        // $bestseller = Cache::remember('bestseller', 900, function () {
        //     return DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status', 'products.views', 'categories.gender_product')->where('products.status', '=', '3')->orderBy('products.views', 'DESC')->orderBy('products.id', 'DESC')->limit(12)->get()->toArray();
        // });
        
        $shockingDiscount = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status', 'products.views', 'categories.gender_product')->where('products.status', '=', '4')->orderBy('products.views', 'DESC')->orderBy('products.id', 'DESC')->limit(15)->get()->toArray();
        
        // $shockingDiscount = Cache::remember('shockingDiscount', 900, function () {
        //     return DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.status', 'products.views', 'categories.gender_product')->where('products.status', '=', '4')->orderBy('products.views', 'DESC')->orderBy('products.id', 'DESC')->limit(15)->get()->toArray();
        // });

        $blog_news = DB::table('blogs')->select('main_image','description','content_blog','users.name','blogs.views','blogs.title','blogs.id')->join('users','users.id','blogs.user_id')->orderBy('blogs.id', 'DESC')->limit(3)->get()->toArray();

        $image_home = DB::table('image_home')->get()->toArray();
            // dd($blog_news);
        return view('User/pages/home.home',[
            // 'count' => $cart,
            'bestseller' => $bestseller,
            'discount' => $shockingDiscount,
            'blog_news' => $blog_news,
            'image_home' => $image_home,
        ]);
    }
}
