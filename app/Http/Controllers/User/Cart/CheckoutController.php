<?php

namespace App\Http\Controllers\User\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Carbon\Carbon;
use App\Models\User\Member\Member;
use App\Models\User\ShoppingCart\Order;
use App\Models\User\ShoppingCart\OrderDetail;
use App\Models\User\ShoppingCart\Payment;
use App\Jobs\SendMailCheckout;
use App\Mail\MailCheckout;
use App\Models\Admin\Product\DetailSize;
use App\Models\User\Affiliate\ProgramSell;
use App\Models\User\Affiliate\Referal;
use App\Models\User\Affiliate\OrderReferal;
use App\Models\User\Affiliate\AffiliatePartner;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if(session()->has('member_id')){
            $id = session('member_id');
            $cart = Cart::content()->toArray();
            $count = Cart::count();
            $account = Member::find($id)->toArray();
            $checkout = Cart::discount();
            $total = Cart::priceTotal();

            return view('User/pages/shopping-cart.checkout',[
                'data' => $cart,
                'count' => $count,
                'account' => $account,
            ]);
        }else{
            session()->put('checkout-login', 1);
            return redirect()->route('login-view');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($request->all());

        if(session()->has('member_id')){
            $data = $request->except("_token");
            $user_id = session('member_id');
            $cart = Cart::content()->toArray();
            $payment = $request->payment;
            if($payment == 1 || $payment == 2){
                foreach($cart as $value){
                    $arr[] = ($value['price']) * ((100 - ($value['weight'])) / 100) * $value['qty'];
                }
                $total = array_sum($arr);
    
                $shipper_cart = $request->shipper_cart;
                if($shipper_cart == 1 || $shipper_cart == 2 || $shipper_cart == 3){
                    if($shipper_cart == 1){
                        $shipper = 0;
                    }elseif($shipper_cart == 2){
                        $shipper = 25000;
                    }elseif($shipper_cart == 3){
                        $shipper = 35000;
                    }
                    $into_money  = $total + $shipper;
                    if(session()->has('arrDiscount')){
                        $arrDiscount = session('arrDiscount');
                        if($arrDiscount['type_discount'] == 1){
                            $into_money = ($into_money) * ((100 - ($arrDiscount['discount'])) / 100);
                        }elseif($arrDiscount['type_discount'] == 2){
                            $into_money = $into_money - ($arrDiscount['discount']);
                        }elseif($arrDiscount['type_discount'] == 3){
                            $into_money = $into_money - ($arrDiscount['discount']);
                        }
                    }
                    if($payment == 1){
                        if($total >= 2000000){
                            if(session()->has('arrDiscount')){
                                $arrDiscount = session('arrDiscount');
                                if($arrDiscount['type_discount'] == 1){
                                    $total = ($total) * ((100 - ($arrDiscount['discount'])) / 100);
                                }elseif($arrDiscount['type_discount'] == 2){
                                    $total = $total - ($arrDiscount['discount']);
                                }elseif($arrDiscount['type_discount'] == 3){
                                    $total = $total - ($arrDiscount['discount']);
                                }
                            }
                            $deposits = ($total * 25) / 100;
                            $arrpay = [];
                            $arrpay['member_id'] = $user_id;
                            $arrpay['total_money'] = $deposits;
                            $arrpay['shipper_cart'] = $shipper_cart;
                            $arrpay['note'] = $request->description;
                            $arrpay['payment'] = 1;
                            $arrpay['created_at'] = Carbon::now();
                            session()->put('arrpay', $arrpay);
                            return view('User/pages/vnpay.index',[
                                'data' => $arrpay,
                            ]);
                        }else{
                            $order = new Order;
                            $order->member_id = $user_id;
                            $order->note = $request->description;
                            $order->total_money = $into_money;
                            $order->ship_method = $shipper_cart;
                            $order->payment_method = $payment;
                            $order->save();
                            $order_id = $order->id;
            
                            foreach($cart as $value){
                                $orderDetail = new OrderDetail;
                                $orderDetail->order_id =  $order_id;
                                $orderDetail->product_id =  $value['id'];
                                $orderDetail->name =  $value['name'];
                                $orderDetail->name_size = $value['options']['size'];
                                $orderDetail->quantity =  $value['qty'];
                                if($value['weight'] > 0){
                                    $total = ($value['price']) * ((100 - ($value['weight'])) / 100);
                                    $orderDetail->price =  $total;
                                    $total_money = $total * ($value['qty']);
                                }else{
                                    $orderDetail->price = $value['price'];
                                    $total_money = ($value['price']) * ($value['qty']);
                                }
                                $orderDetail->total_money =  $total_money;
                                $orderDetail->save();
            
                                $subtractQty = DetailSize::select('id', 'quantity')->where('product_id', '=', $value['id'])->where('name_size', '=', $value['options']['size'])->get()->toArray();
                                $totalQty = ($subtractQty[0]['quantity']) - $value['qty'];
            
                                DetailSize::where('id', '=', $subtractQty[0]['id'])->update(['quantity' => $totalQty]);
            
                                if (($request->hasCookie('cookie_url')) && ($request->hasCookie('cookie_partner')) && ($request->hasCookie('cookie_program')) && ($request->hasCookie('cookie_product'))) {
                                    if(($value['id']) == ($request->cookie('cookie_product'))){
                                        $checkOrder = Order::select('id')->where('member_id', '=', $user_id)->get()->toArray();
            
                                        $checkProgram = ProgramSell::select('id', 'rose_old', 'rose_new')->where('id', '=', $request->cookie('cookie_program'))->get()->toArray();
            
                                        $referal = Referal::select('id')->where('partner_id', '=', $request->cookie('cookie_partner'))->where('program_id', '=', $request->cookie('cookie_program'))->get()->toArray();
            
                                        if(empty($checkOrder)){
                                            $total_rose = $total * (($checkProgram[0]['rose_new']) / 100);
                                            if($total_rose > 70000){
                                                $total_rose = 70000;
                                            }else{}
                                            OrderReferal::create([
                                                'order_id' => $order_id,
                                                'product_id' => $request->cookie('cookie_product'),
                                                'referal_id' => $referal[0]['id'],
                                                'rose' => $checkProgram[0]['rose_new'],
                                                'total_rose' => $total_rose
                                            ]);
                                            
                                            $affPartner = AffiliatePartner::find($request->cookie('cookie_partner'));
                                            $affPartner->total_rose += $total_rose;
                                            $affPartner->save();
                                        }else{
                                            $total_rose = $total * (($checkProgram[0]['rose_old']) / 100);
                                            if($total_rose > 70000){
                                                $total_rose = 70000;
                                            }else{}
                                            OrderReferal::create([
                                                'order_id' => $order_id,
                                                'product_id' => $request->cookie('cookie_product'),
                                                'referal_id' => $referal[0]['id'],
                                                'rose' => $checkProgram[0]['rose_old'],
                                                'total_rose' => $total_rose
                                            ]);
            
                                            $affPartner = AffiliatePartner::find($request->cookie('cookie_partner'));
                                            $affPartner->total_rose += $total_rose;
                                            $affPartner->save();
                                        }
                                    }
                                }
                            }
                            SendMailCheckout::dispatch($order_id);

                            // $order_mail = Order::find($order_id);
                            // $user_mail = Member::find($order_mail->member_id);
                            // // dd($user);
                            // $order_detail_mail = OrderDetail::select('order_id', 'product_id', 'name_size', 'quantity')->where('order_id', '=', $order_mail->id)->get()->toArray();

                            // $email = new MailCheckout($order, $user_mail, $order_detail_mail);
                            // Mail::to($user_mail->email)->send($email);
                            // dd($order_id);
                            Cart::destroy();
                            if(session()->has('arrDiscount')){
                                session()->forget('arrDiscount');
                            }
                            return redirect()->route('index');
                        }
                    }elseif($payment == 2){
                        $arrpay = [];
                        $arrpay['member_id'] = $user_id;
                        $arrpay['total_money'] = $into_money;
                        $arrpay['shipper_cart'] = $shipper_cart;
                        $arrpay['note'] = $request->description;
                        $arrpay['payment'] = 2;
                        $arrpay['created_at'] = Carbon::now();
                        session()->put('arrpay', $arrpay);
                        return view('User/pages/vnpay.index',[
                            'data' => $arrpay,
                        ]);
                    }
                }else{
                    return redirect()->back();
                }
            }
        }else{
            session()->put('checkout-login', 1);
            return redirect()->route('login-view');
        }
        
    }


    public function createPayment(Request $request)
    {
            
        $check = Order::select('id')->get()->toArray();
        $order_id = count($check) + 1;
        if(session()->has('arrpay')){
            $arrpay = session('arrpay');
            $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = $request->order_desc;
            $vnp_OrderType = $request->order_type;
            $vnp_Amount = $arrpay['total_money'] * 100;
            $vnp_Locale = $request->language;
            $vnp_BankCode = $request->bank_code;
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => env('VNP_TMN_CODE'),
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => route('vnpay.return'),
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = env('VNP_URL') . "?" . $query;
            if (env('VNP_HASH_SECRET')) {
                $vnpSecureHash = hash('sha256', env('VNP_HASH_SECRET') . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        }
    }

    public function vnpayReturn(Request $request)
    {
        if(session()->has('arrpay')){
            $arrpay = session('arrpay');
            $user_id = $arrpay['member_id'];
            $cart = Cart::content()->toArray();
            $shipper_cart = $arrpay['shipper_cart'];
            $payment = 2;
            if($shipper_cart == 1 || $shipper_cart == 2 || $shipper_cart == 3){
                $order = new Order;
                $order->member_id = $user_id;
                $order->note = $arrpay['note'];
                $order->total_money = $arrpay['total_money'];
                $order->ship_method = $shipper_cart;
                $order->payment_method = $arrpay['payment'];
                $order->save();
                $order_id = $order->id;

                foreach($cart as $value){
                    $orderDetail = new OrderDetail;
                    $orderDetail->order_id =  $order_id;
                    $orderDetail->product_id =  $value['id'];
                    $orderDetail->name =  $value['name'];
                    $orderDetail->name_size = $value['options']['size'];
                    $orderDetail->quantity =  $value['qty'];
                    if($value['weight'] > 0){
                        $total = ($value['price']) * ((100 - ($value['weight'])) / 100);
                        $orderDetail->price =  $total;
                        $total_money = $total * ($value['qty']);
                    }else{
                        $orderDetail->price = $value['price'];
                        $total_money = ($value['price']) * ($value['qty']);
                    }
                    $orderDetail->total_money =  $total_money;
                    $orderDetail->save();

                    $subtractQty = DetailSize::select('id', 'quantity')->where('product_id', '=', $value['id'])->where('name_size', '=', $value['options']['size'])->get()->toArray();
                    $totalQty = ($subtractQty[0]['quantity']) - $value['qty'];

                    DetailSize::where('id', '=', $subtractQty[0]['id'])->update(['quantity' => $totalQty]);

                    if (($request->hasCookie('cookie_url')) && ($request->hasCookie('cookie_partner')) && ($request->hasCookie('cookie_program')) && ($request->hasCookie('cookie_product'))) {
                        if(($value['id']) == ($request->cookie('cookie_product'))){
                            $checkOrder = Order::select('id')->where('member_id', '=', $user_id)->get()->toArray();

                            $checkProgram = ProgramSell::select('id', 'rose_old', 'rose_new')->where('id', '=', $request->cookie('cookie_program'))->get()->toArray();
                            $referal = Referal::select('id')->where('partner_id', '=', $request->cookie('cookie_partner'))->where('program_id', '=', $request->cookie('cookie_program'))->get()->toArray();

                            if(empty($checkOrder)){
                                $total_rose = $total * (($checkProgram[0]['rose_new']) / 100);
                                if($total_rose > 70000){
                                    $total_rose = 70000;
                                }else{}
                                OrderReferal::create([
                                    'order_id' => $order_id,
                                    'product_id' => $request->cookie('cookie_product'),
                                    'referal_id' => $referal[0]['id'],
                                    'rose' => $checkProgram[0]['rose_new'],
                                    'total_rose' => $total_rose
                                ]);
                                
                                $affPartner = AffiliatePartner::find($request->cookie('cookie_partner'));
                                $affPartner->total_rose += $total_rose;
                                $affPartner->save();
                            }else{
                                $total_rose = $total * (($checkProgram[0]['rose_old']) / 100);
                                if($total_rose > 70000){
                                    $total_rose = 70000;
                                }else{}
                                OrderReferal::create([
                                    'order_id' => $order_id,
                                    'product_id' => $request->cookie('cookie_product'),
                                    'referal_id' => $referal[0]['id'],
                                    'rose' => $checkProgram[0]['rose_old'],
                                    'total_rose' => $total_rose
                                ]);

                                $affPartner = AffiliatePartner::find($request->cookie('cookie_partner'));
                                $affPartner->total_rose += $total_rose;
                                $affPartner->save();
                            }
                        }
                    }
                }

                $payment = Payment::create([
                    'order_id' => $order_id,
                    'member_id' => $user_id,
                    'total_money' => $arrpay['total_money'],
                    'note' => $request->vnp_OrderInfo,
                    'vnp_response_code' => $request->vnp_ResponseCode,
                    'code_vnpay' => $request->vnp_TransactionNo,
                    'code_bank' => $request->vnp_BankCode,
                    'card_type' => $request->vnp_CardType
                ]);
                $arrInto = [];
                $arrInto['order_id'] = $order_id;
                $arrInto['member_id'] = $user_id;
                $arrInto['total_money'] = $arrpay['total_money'];
                $arrInto['note'] = $request->vnp_OrderInfo;
                $arrInto['responseCode'] = $request->vnp_ResponseCode;
                $arrInto['transactionNo'] = $request->vnp_TransactionNo;
                $arrInto['bankCode'] = $request->vnp_BankCode;
                $arrInto['time'] = Carbon::now();

                SendMailCheckout::dispatch($order_id);
                Cart::destroy();
                if(session()->has('arrDiscount')){
                    session()->forget('arrDiscount');
                }
                session()->forget('arrpay');
                return view('User/pages/vnpay.vnpay_return',[
                    'data' => $arrInto
                ]);
            }
        }
    }

}
