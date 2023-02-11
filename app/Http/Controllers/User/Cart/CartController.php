<?php

namespace App\Http\Controllers\User\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\User\ShoppingCart\CartUser;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\DetailSize;
use App\Models\Admin\Discount_code;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content()->toArray();
        $count = Cart::count();
        return view('User/pages/shopping-cart.view-cart',[
            'data' => $cart,
            'count' => $count,
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
        $cart = Cart::content()->toArray();
        $product = Product::find($id);
        $qty = request('quantity');
        $size = request('sizeProduct');
        $sizeDefault = request('sizeDefault');
        
        $detailSize = DetailSize::select('id', 'product_id', 'name_size', 'quantity')->where('product_id', '=', $id)->where('name_size', '=', $size)->get()->toArray();
        // dd($size);
        $pattern = '/^[0-9]{1,4}$/';
        $quantity = $detailSize[0]['quantity'];
        $checkProduct = 0;
        $error = 0;
        foreach($cart as $value){
            if(in_array($id, $value) && in_array($size, $value['options'])){
                $qty_old = $value['qty'];
                $rowId = $value['rowId'];
                if (preg_match($pattern, $qty)) {
                    $qty_new = $qty_old + $qty;
                    if($qty_new > 0 && $qty_new <= $quantity){
                        Cart::update($rowId, $qty_new);
                    }else{
                        echo $error = 1;
                    }
                }
                $checkProduct = 1;
                break;
            }
        }
        // echo $sizeDefault;
        if($checkProduct == 0){
            if($sizeDefault == 1){
                Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $qty, 'price' => $product->price, 'weight' => $product->sale, 'options' => ['size' => '1', 'image' => $product->main_image, 'category_id' => $product->category_id]]);
            }elseif($sizeDefault == 0){
                Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $qty, 'price' => $product->price, 'weight' => $product->sale, 'options' => ['size' => $size, 'image' => $product->main_image, 'category_id' => $product->category_id]]);
            }
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
        //
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
        // var_dump($request->quantity);
        if(($request->quantity) == 0 || ($request->quantity) == 1){
            $qtyRequest = request('quantity');
            $cart = Cart::get($id)->toArray();
            $product_id = $cart['id'];
            $size = $cart['options']['size'];
            $qty_old = $cart['qty'];

            $detailSize = DetailSize::select('quantity')->where('product_id', '=', $product_id)->where('name_size', '=', $size)->get()->toArray();
            $pattern = '/^[0-9]{1,4}$/';
            $quantity = $detailSize[0]['quantity'];

            if($qtyRequest == 1){
                $qty_new = $qty_old + 1;
            }elseif($qtyRequest == 0){
                $qty_new = $qty_old - 1;
            }
            
            if (preg_match($pattern, $qty_new)) {
                if($qty_new > 0 && $qty_new <= $quantity){
                    Cart::update($id, $qty_new);
                }
            }else{
                Cart::update($id, $qty_old);
            }
            
        }else{
            $cart = Cart::get($id)->toArray();
            $product_id = $cart['id'];
            $size = $cart['options']['size'];
            $qty_old = $cart['qty'];

            $qty = request('quantity');
            $detailSize = DetailSize::select('quantity')->where('product_id', '=', $product_id)->where('name_size', '=', $size)->get()->toArray();
            $pattern = '/^[0-9]{1,4}$/';
            $quantity = $detailSize[0]['quantity'];

            if (preg_match($pattern, $qty)) {
                $restQty = $quantity - $qty_old;
                if($qty > 0 && $qty <= $quantity){
                    Cart::update($id, $qty);
                }
            }else{
                Cart::update($id, $qty_old);
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(session()->has('arrDiscount')){
            $cart = Cart::content()->toArray();
            $arrDiscount = session('arrDiscount');
            if(($cart[$id]['options']['category_id']) == $arrDiscount['category_id']){
                session()->forget('arrDiscount');
            }
        }
        Cart::remove($id);
    }

    public function checkDiscount(Request $request)
    {
        if(request()->ajax()) {
            $request->validate([
                'discount' => 'required'
            ]);
            
            $check = Discount_code::select('*')->where('code', '=', $request->discount)->get()->toArray();
            if(!empty($check)){
                if($check[0]['status'] == 1 && $check[0]['quantity'] >= 1){
                    $timePresent = Carbon::now();
                    $created_at = $check[0]['created_at'];
                    $datediff = (strtotime($timePresent) - strtotime($created_at));
                    $time = floor($datediff / (60*60*24));
                    if($time <= $check[0]['time']){
                        $arr = [];
                        $cart = Cart::content()->toArray();
                        // dd($cart);
                        if($check[0]['category_id'] != null){
                            foreach($cart as $value){
                                $arr[] = $value['options']['category_id'];
                            }
                            if(in_array($check[0]['category_id'], $arr)){
                                // $discount_code = Discount_code::find($check[0]['id']);
                                // $discount_code->quantity = $check[0]['quantity'] - 1;
                                // $discount_code->save();

                                $arrDiscount = [];
                                $arrDiscount['id'] = $check[0]['id'];
                                $arrDiscount['category_id'] = $check[0]['category_id'];
                                $arrDiscount['type_discount'] = $check[0]['type_code'];
                                $arrDiscount['discount'] = $check[0]['price'];
                                session()->put('arrDiscount', $arrDiscount);
                                // dd(session('arrDiscount'));

                            }
                        }elseif($check[0]['category_id'] == null){
                            $arrDiscount = [];
                            $arrDiscount['id'] = $check[0]['id'];
                            $arrDiscount['type_discount'] = $check[0]['type_code'];
                            $arrDiscount['discount'] = $check[0]['price'];
                            session()->put('arrDiscount', $arrDiscount);
                            // dd(session('arrDiscount'));
                        }
                    }
                }
            }
        }
    }

}
