<?php

namespace App\Http\Controllers\User\MixFashion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;
use Yajra\Datatables\Datatables;

use App\Models\Admin\Product\Category;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\DetailSize;

class MixFashionController extends Controller
{
    public function index(){
        return view('User/pages/tomix-fashion.index-mixfashion');
    }

    public function directional($id){
        $cart = Cart::count();
        if($id == 1 || $id == 2){
            return view('User/pages/tomix-fashion/layout.mixfashion',[
                'count' => $cart,
                'id' => $id
            ]);
        }
    }

    public function loadCategory(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->items) && is_numeric($request->items) && !empty($request->gender) && is_numeric($request->gender)) {
                $data = Category::select('id', 'name_cate')->where('gender_product', '=', $request->gender)->where('items', '=', $request->items)->get()->toArray();
                return response()->json(['data' => $data]);
            }
        }
    }

    public function loadProduct(Request $request){
        if(request()->ajax()) {
            if(($request->id) != "" && is_numeric($request->id)){
                $cate_id = $request->id;
                $data = Product::select('id', 'name', 'main_image', 'price', 'sale')->where('category_id', '=', $cate_id)->get()->toArray();
                return Datatables::of($data)->make(true);
            }else{
                $data = Product::select('id', 'name', 'main_image', 'price')->get()->toArray();
                return Datatables::of($data)->make(false);
            }
        }
        return view('User/pages/tomix-fashion/layout.mixfashion');
    }

    public function detailProduct(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->id) && is_numeric($request->id)){
                $id = $request->id;
                $items = $request->items;
                $detailWomen = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.description', 'categories.name_cate', 'brands.name_brand')->where('products.id', '=', $id)->orderBy('products.id', 'DESC')->get()->toArray();

                $detailSize = DB::table('detail_sizes')->select('detail_sizes.id', 'detail_sizes.name_size', 'detail_sizes.quantity')->where('detail_sizes.product_id', '=', $id)->get()->toArray();

                $detailImage = DB::table('detail_images')->select('detail_images.id', 'detail_images.sub_image')->where('detail_images.product_id', '=', $id)->get()->toArray();
                // dd($detailSize);
                $cart = Cart::count();
                return view('User/pages/tomix-fashion/layout.load-detail',[
                    'detailWomen' => $detailWomen,
                    'detailSize' => $detailSize,
                    'detailImage' => $detailImage,
                    'count' => $cart,
                    'items' => $items
                ]);
            }
        }
    }
    
    public function addSuit(Request $request){
        $request->validate([
            'id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'sizeProduct' => 'required',
            'sizeDefault' => 'required|integer',
            'items' => 'required|integer|min:1|max:8',
        ]);
        // var_dump($request->all());
        $id = $request->id;
        $product = Product::select('id', 'category_id', 'name', 'main_image', 'price', 'sale')->where('id', '=', $id)->get()->toArray();
        $qty = $request->quantity;
        $size = $request->sizeProduct;
        $sizeDefault = $request->sizeDefault;
        $items = $request->items;

        $detailSize = DetailSize::select('id', 'product_id', 'name_size', 'quantity')->where('product_id', '=', $id)->where('name_size', '=', $size)->get()->toArray();
        $pattern = '/^[0-9]{1,4}$/';
        $quantity = $detailSize[0]['quantity'];
        $checkSuit = 0;
        $checkOther = 0;
        $arr = [];
        $arrOther = [];
        $key = 0;

        if($items == 7 || $items == 8){
            if(session()->has('suitOther')){
                $arrOther = session('suitOther');
                $count = count($arrOther);
                for($i = 0; $i < $count; $i++){
                    if($arrOther[$i]['id'] == $product[0]['id'] && $arrOther[$i]['size'] == $size && $arrOther[$i]['items'] == $items){
                        $checkOther = 0;
                        $key = $i;
                        break;
                    }elseif($arrOther[$i]['id'] != $product[0]['id'] && $arrOther[$i]['items'] == $items){
                        $checkOther = 1;
                        break;
                    }
                }
                
                if($checkOther == 0){
                    if (preg_match($pattern, $qty)) {
                        if($qty > 0 && $qty <= $quantity){
                            $arrOther[$key]['qty'] += $qty;
                        }else{
                            $arrOther[$key]['qty'] = 1;
                        }
                    }
                }elseif($checkOther == 1){
                    if($count == 1){
                        end($arrOther);
                        $key = key($arrOther) + 1;
                        $arrOther[$key] = $product[0];
                        if (preg_match($pattern, $qty)) {
                            if($qty > 0 && $qty <= $quantity){
                                $arrOther[$key]['qty'] = $qty;
                            }else{
                                $arrOther[$key]['qty'] = 1;
                            }
                        }
                        $arrOther[$key]['size'] = 1;
                        $arrOther[$key]['items'] = $items;
                    }
                }
                session()->put('suitOther', $arrOther);
            }else{
                $arrOther[0] = $product[0];
                if (preg_match($pattern, $qty)) {
                    if($qty > 0 && $qty <= $quantity){
                        $arrOther[0]['qty'] = $qty;
                    }else{
                        $arrOther[0]['qty'] = 1;
                    }
                }
                if($sizeDefault == 1){
                    $arrOther[0]['size'] = 1;
                }else{
                    $arrOther[0]['size'] = $size;
                }
                $arrOther[0]['items'] = $items;
                session()->put('suitOther', $arrOther);
            }
        }else{
            if(session()->has('suit')){
                $arr = session('suit');
                for ($i = 0; $i < count($arr); $i++) { 
                    if($arr[$i]['id'] == $product[0]['id'] && $arr[$i]['size'] == $size && $arr[$i]['items'] == $items){
                        $checkSuit = 0;
                        $key = $i;
                        break;
                    }elseif($arr[$i]['id'] == $product[0]['id'] && $arr[$i]['size'] != $size && $arr[$i]['items'] == $items){
                        $checkSuit = 1;
                        $key = $i;
                        break;
                    }elseif($arr[$i]['id'] != $product[0]['id'] && $arr[$i]['items'] == $items){
                        $checkSuit = 1;
                        $key = $i;
                        break;
                    }elseif($arr[$i]['id'] != $product[0]['id'] && $arr[$i]['items'] != $items){
                        $checkSuit = 2;
                    }
                }

                if($checkSuit == 0){
                    if (preg_match($pattern, $qty)) {
                        if($qty > 0 && $qty <= $quantity){
                            $arr[$key]['qty'] += $qty;
                        }else{
                            $arr[$key]['qty'] = 1;
                        }
                    }
                }elseif($checkSuit == 1){
                    var_dump($key);
                    $arr[$key] = $product[0];
                    if (preg_match($pattern, $qty)) {
                        if($qty > 0 && $qty <= $quantity){
                            $arr[$key]['qty'] = $qty;
                        }else{
                            $arr[$key]['qty'] = 1;
                        }
                    }
                    if($sizeDefault == 1){
                        $arr[$key]['size'] = 1;
                    }else{
                        $arr[$key]['size'] = $size;
                    }
                    $arr[$key]['items'] = $items;
                }elseif($checkSuit == 2){
                    if((count($arr)) <= 3){
                        end($arr);
                        $key = key($arr) + 1;
                        $arr[$key] = $product[0];
                        if (preg_match($pattern, $qty)) {
                            if($qty > 0 && $qty <= $quantity){
                                $arr[$key]['qty'] = $qty;
                            }else{
                                $arr[$key]['qty'] = 1;
                            }
                        }
                        if($sizeDefault == 1){
                            $arr[$key]['size'] = 1;
                        }else{
                            $arr[$key]['size'] = $size;
                        }
                        $arr[$key]['items'] = $items;
                    }
                }
                session()->put('suit', $arr);
            }else{
                $arr[0] = $product[0];
                if (preg_match($pattern, $qty)) {
                    if($qty > 0 && $qty <= $quantity){
                        $arr[0]['qty'] = $qty;
                    }else{
                        $arr[0]['qty'] = 1;
                    }
                }
                if($sizeDefault == 1){
                    $arr[0]['size'] = 1;
                }else{
                    $arr[0]['size'] = $size;
                }
                $arr[0]['items'] = $items;
                session()->put('suit', $arr);
            }
        }
    }

    public function loadSuit()
    {
        if(request()->ajax()) {
            $data = [];
            if(session()->has('suit')){
                $arr = session('suit');
                for ($i = 0; $i < count($arr); $i++) { 
                    $data[] = $arr[$i];
                }
            }
            if(session()->has('suitOther')){
                $arr = session('suitOther');
                for ($i = 0; $i < count($arr); $i++) { 
                    $data[] = $arr[$i];
                }
            }
            return view('User/pages/tomix-fashion/layout.load-suit',[
                'data' => $data
            ]);
        }else{
            return view('User/pages/tomix-fashion/layout.load-suit');
        }
    }

    public function addSuitCart()
    {
        if(request()->ajax()) {
            $data = [];
            if(session()->has('suit')){
                $arr = session('suit');
                if(count($arr) == 3){
                    for ($i = 0; $i < count($arr); $i++) { 
                        $data[] = $arr[$i];
                    }
                }else{
                    echo 'error';
                }
            }
            if(session()->has('suitOther')){
                $arr = session('suitOther');
                for ($i = 0; $i < count($arr); $i++) { 
                    $data[] = $arr[$i];
                }
            }

            $count = count($data);
            if($count >= 3 && $count <= 5){
                foreach($data as $value){
                    Cart::add(['id' => $value['id'], 'name' => $value['name'], 'qty' => $value['qty'], 'price' => $value['price'], 'weight' => $value['sale'], 'options' => ['size' => $value['size'], 'image' => $value['main_image']]]);
                }
                session()->forget('suit');
                session()->forget('suitOther');
                echo 'success';
            }
        }
    }

}
