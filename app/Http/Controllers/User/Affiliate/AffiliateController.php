<?php

namespace App\Http\Controllers\User\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;
use DB;
use App\Models\User\Affiliate\Referal;
use App\Models\User\Affiliate\OrderReferal;
use App\Models\User\Affiliate\ProgramSell;
use Cart;
use QrCode;
use App\Models\User\Affiliate\AffiliatePartner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class AffiliateController extends Controller
{
    public function introduce()
    {
        $introduce = DB::table('commission_rates')->join('categories', 'commission_rates.category_id', '=', 'categories.id')->select('commission_rates.id', 'categories.name_cate', 'commission_rates.rose_old', 'commission_rates.rose_new')->get()->toArray();
        return view('User/pages/affiliate/pages.introduce-affiliate', [
            'data' => $introduce
        ]);
    }

    public function directional()
    {
        if(session()->has('partner_id')){
            return redirect()->route('affiliate.index');
        }else{
            return view('User/pages/affiliate/pages.directional-affiliate');
        }
    }

    public function login()
    {
        if(session()->has('partner_id')){
            return redirect()->route('affiliate.index');
        }else{
            return view('User/pages/affiliate/pages.login-affiliate');
        }
    }

    public function register()
    {
        if(session()->has('partner_id')){
            return redirect()->route('affiliate.index');
        }else{
            return view('User/pages/affiliate/pages.register-affiliate');
        }
    }

    public function index()
    {
        if (session()->has('partner_id')) {
            $sumTotal = AffiliatePartner::select('total_rose')->where('id', '=', session('partner_id'))->get()->toArray();
            $data = DB::table('program_sells')->join('products', 'program_sells.product_id', '=', 'products.id')->join('categories', 'products.category_id', '=', 'categories.id')->select('program_sells.id', 'program_sells.product_id', 'program_sells.image', 'program_sells.title', 'program_sells.rose_old', 'program_sells.rose_new', 'program_sells.created_at', 'products.name', 'categories.gender_product')->paginate(10);
            // dd($data);
            return view('User/pages/affiliate/pages.program-affiliate', [
                'data' => $data,
                'total_money' => $sumTotal,
            ]);
            return view('User/pages/affiliate.index-affiliate');
        } else {
            return redirect()->route('affiliate.login');
        }
        
    }

    public function profileAccount()
    {
        if (session()->has('partner_id')) {
            $sumTotal = AffiliatePartner::select('total_rose')->where('id', '=', session('partner_id'))->get()->toArray();
            $data = AffiliatePartner::find(session('partner_id'));
            // dd($data->firstname);
            return view('User/pages/affiliate/pages.profile-account',[
                'data' => $data,
                'total_money' => $sumTotal,
            ]);
        } else {
            return redirect()->route('affiliate.login');
        }
    }

    public function changePassword(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'pass_old' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'password_confirm' => 'required|required_with:password|same:password',
            ]);
            if (session()->has('partner_id')) {
                $check = AffiliatePartner::query()->where('id', session('partner_id'))->first();
                if (Hash::check($request->pass_old, $check->password)) {
                    $partner = AffiliatePartner::find(session('partner_id'));
                    $partner->password = Hash::make($request->password);
                    $partner->save();
                    echo 'success';
                }else{
                    echo 'error';
                }
            }
        }
    }

    public function updateAffiliate(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
            'profession' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
        ]);
        if (session()->has('partner_id')) {
            $checkPhoneMail = AffiliatePartner::select('id', 'email', 'phone')->where('id', '=', session('partner_id'))->where('email', $request->email)->where('phone', $request->phone)->get()->toArray();
            if(!empty($checkPhoneMail)){
                $partner = AffiliatePartner::find(session('partner_id'));
                if($request->hasFile('avatar')){
                    $image = $request->file('avatar')->hashName();
                    Storage::putFile('public/images/affiliate', $request->file('avatar'));

                    $deleteAvatar = AffiliatePartner::select('avatar')->where('id', '=', session('partner_id'))->get()->toArray();
                    if(($deleteAvatar[0]['avatar']) != null){
                        $des_path = 'storage/images/affiliate/' . $deleteAvatar[0]['avatar'];
                        if (file_exists($des_path)) {
                            unlink($des_path);
                        }
                    }

                    $partner->avatar = $image;
                }else{
                    $partner->avatar = "";
                }
                $partner->firstname = $request->firstname;
                $partner->lastname = $request->lastname;
                $partner->email = $request->email;
                $partner->profession = $request->profession;
                $partner->address = $request->address;
                $partner->phone = $request->phone;
                $partner->save();
                session()->flash('success');
                return redirect()->back();
            }else{
                $check = AffiliatePartner::query()->where('id', '!=', session('partner_id'))->where('email', $request->email)->orWhere('phone', $request->phone)->first();
                if($check == NULL){
                    $partner = AffiliatePartner::find(session('partner_id'));
                    if($request->hasFile('avatar')){
                        $image = $request->file('avatar')->hashName();
                        Storage::putFile('public/images/affiliate', $request->file('avatar'));
    
                        $deleteAvatar = AffiliatePartner::select('avatar')->where('id', '=', session('partner_id'))->get()->toArray();
                        $des_path = 'storage/images/affiliate/' . $deleteAvatar[0]['avatar'];
                        if (file_exists($des_path)) {
                            unlink($des_path);
                        }
    
                        $partner->avatar = $image;
                    }else{
                        $partner->avatar = "";
                    }
                    $partner->firstname = $request->firstname;
                    $partner->lastname = $request->lastname;
                    $partner->email = $request->email;
                    $partner->profession = $request->profession;
                    $partner->address = $request->address;
                    $partner->phone = $request->phone;
                    $partner->save();
                    session()->flash('success');
                    return redirect()->back();
                }else{
                    session()->flash('error');
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->route('affiliate.login');
        }
    }

    //* show program affiliate
    public function showProgram(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->id) && is_numeric($request->id)) {
                $data = DB::table('program_sells')->join('products', 'program_sells.product_id', '=', 'products.id')->join('categories', 'products.category_id', '=', 'categories.id')->select('program_sells.id', 'program_sells.image', 'categories.name_cate', 'products.name', 'program_sells.title', 'program_sells.rose_old', 'program_sells.rose_new', 'program_sells.description', 'program_sells.created_at')->where('program_sells.id', '=', $request->id)->get()->toArray();

                return view('User/pages/affiliate/pages.detail-program', [
                    'data' => $data
                ]);
            }
        }
    }

    //* register program affiliate
    public function registerProgram(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->id) && is_numeric($request->id)) {
                if (session()->has('partner_id')) {
                    $partner_id = session('partner_id');
                    $check = Referal::select('id', 'partner_id', 'program_id')->where('partner_id', '=', $partner_id)->where('program_id', '=', $request->id)->get()->toArray();
                    $product = ProgramSell::select('product_id')->where('id', '=', $request->id)->get()->toArray();
                    if (empty($check)) {
                        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                        $code = 'http://127.0.0.1:8000/affiliate/' . substr(str_shuffle($permitted_chars), 0, 8) . 'Partner' . $partner_id . '' . substr(str_shuffle($permitted_chars), 0, 10) . '/' . substr(str_shuffle($permitted_chars), 0, 13) . 'Program' . $request->id . '' . substr(str_shuffle($permitted_chars), 0, 10) . '/' . substr(str_shuffle($permitted_chars), 0, 16) . '' . $product[0]['product_id'] . '' . substr(str_shuffle($permitted_chars), 0, 16) . '.html';

                        Referal::create([
                            'partner_id' => $partner_id,
                            'program_id' => $request->id,
                            'link_code' => $code
                        ]);
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                }
            }
        }
    }

    //* get link affiliate
    public function getLink(Request $request, $key)
    {
        $url = $request->fullurl();
        $arr = explode('/', $url);
        $partner_id = substr($arr[4], 15, -10);
        $program_id = substr($arr[5], 20, -10);
        $product_id = substr($arr[6], 16, -21);

        $cookieUrl = cookie('cookie_url', $url, time() + (604800));
        $cookiePartner = cookie('cookie_partner', $partner_id, time() + (604800));
        $cookieProgram = cookie('cookie_program', $program_id, time() + (604800));
        $cookieProduct = cookie('cookie_product', $product_id, time() + (604800));

        $detailWomen = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'products.main_image', 'products.price', 'products.sale', 'products.description', 'categories.name_cate', 'brands.name_brand')->where('products.id', '=', $product_id)->orderBy('products.id', 'DESC')->get()->toArray();

        $detailSize = DB::table('detail_sizes')->select('detail_sizes.id', 'detail_sizes.name_size', 'detail_sizes.quantity')->where('detail_sizes.product_id', '=', $product_id)->get()->toArray();

        $detailImage = DB::table('detail_images')->select('detail_images.id', 'detail_images.sub_image')->where('detail_images.product_id', '=', $product_id)->get()->toArray();
        $cart = Cart::count();


        if (($request->hasCookie('cookie_url')) && ($request->hasCookie('cookie_partner')) && ($request->hasCookie('cookie_program')) && ($request->hasCookie('cookie_product'))) {
            $deleteCookieUrl = \Cookie::forget('cookie_url');
            $deleteCookiePartner = \Cookie::forget('cookie_partner');
            $deleteCookieProgram = \Cookie::forget('cookie_program');
            $deleteCookieProduct = \Cookie::forget('cookie_product');

            return response()->view('User/pages/product.detail-product', [
                'detailWomen' => $detailWomen,
                'detailSize' => $detailSize,
                'detailImage' => $detailImage,
                'count' => $cart
            ])->withCookie($deleteCookieUrl)
                ->withCookie($deleteCookiePartner)
                ->withCookie($deleteCookieProgram)
                ->withCookie($deleteCookieProduct)
                ->withCookie($cookieUrl)
                ->withCookie($cookiePartner)
                ->withCookie($cookieProgram)
                ->withCookie($cookieProduct);
        } else {
            return response()->view('User/pages/product.detail-product', [
                'detailWomen' => $detailWomen,
                'detailSize' => $detailSize,
                'detailImage' => $detailImage,
                'count' => $cart
            ])->withCookie($cookieUrl)->withCookie($cookiePartner)->withCookie($cookieProgram)->withCookie($cookieProduct);
        }

        //* destroy cookie
        // $cookie = \Cookie::forget('cookie_product');
        // return response('view')->withCookie($cookie);

        // if($request->hasCookie('cookie_program')){
        //     echo $request->cookie('cookie_program');
        // }else{
        //     echo 123;
        // }
    }

    //* manage program
    public function manageProgram(Request $request)
    {
        if (session()->has('partner_id')) {
            $partner_id = session('partner_id');
            $sumTotal = AffiliatePartner::select('total_rose')->where('id', '=', $partner_id)->get()->toArray();
            $data = DB::table('program_sells')->join('products', 'program_sells.product_id', '=', 'products.id')->join('categories', 'products.category_id', '=', 'categories.id')->join('referals', 'program_sells.id', '=', 'referals.program_id')->select('program_sells.id', 'program_sells.product_id', 'program_sells.image', 'program_sells.title', 'program_sells.rose_old', 'program_sells.rose_new', 'program_sells.created_at', 'products.name', 'categories.gender_product', 'referals.link_code')->where('referals.partner_id', '=', $partner_id)->get()->toArray();

            return view('User/pages/affiliate/pages.manage-program', [
                'data' => $data,
                'total_money' => $sumTotal,
            ]);
        } else {
            return redirect()->route('affiliate.login');
        }
    }

    //* view qr code
    public function getLinkQr(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->id) && is_numeric($request->id)) {
                if (session()->has('partner_id')) {
                    $partner_id = session('partner_id');
                    $data = DB::table('program_sells')->join('referals', 'program_sells.id', '=', 'referals.program_id')->select( 'referals.link_code')->where('referals.partner_id', '=', $partner_id)->where('referals.program_id', '=', $request->id)->get()->toArray();
                    // $qrcode = QrCode::format('png')->size(300)->generate($data[0]->link_code);

                    return view('User/pages/affiliate/pages.view-linkqrcode', [
                        'data' => $data,
                        // 'qrcode' => $qrcode
                    ]);
                } else {
                    return redirect()->route('affiliate.login');
                }
            }
        }
    }

    public function manageRevenue() {
        if (request()->ajax()) {
            if (session()->has('partner_id')) {
                $presentYear = Carbon::now()->year;
                $dataSales = DB::table('order_referals')->join('referals', 'order_referals.referal_id', '=', 'referals.id')->select(DB::raw('SUM(order_referals.total_rose) as total'), DB::raw('MONTH(order_referals.created_at) as month'))->where('referals.partner_id', '=', session('partner_id'))->where('order_referals.created_at', 'LIKE', '%'.$presentYear.'%')->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
                $arrMonth = [0];
                $arrTotal = [0];
                foreach($dataSales as $value){
                    // array_push($arrMonth, $value->month);
                    $arrMonth[] = 'Tháng '.$value->month;
                    $arrTotal[] = $value->total;
                }
                // dd($arrMonth);
                return view('User/pages/affiliate/pages.manage-revenue', [
                    'arrMonth' => json_encode($arrMonth),
                    'arrTotal' => json_encode($arrTotal)
                ]);
            }
        }
    }

    public function loadDetailTabel(Request $request)
    {
        if (session()->has('partner_id')) {
            $partner_id = session('partner_id');
            if(request()->ajax()) {
                if(!empty($request->start_date) && !empty($request->end_date)) {
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;
                    if(($start_date) == ($end_date)){
                        $data = DB::table('order_referals')->join('products', 'order_referals.product_id', '=', 'products.id')->join('referals', 'order_referals.referal_id', '=', 'referals.id')->join('program_sells', 'referals.program_id', '=', 'program_sells.id')->select('order_referals.id', 'program_sells.title', 'products.name', 'order_referals.rose', 'order_referals.total_rose')->where('referals.partner_id', '=', $partner_id)->whereDate('order_referals.created_at', '=', $start_date)->get()->toArray();
                    }else{
                        $data = DB::table('order_referals')->join('products', 'order_referals.product_id', '=', 'products.id')->join('referals', 'order_referals.referal_id', '=', 'referals.id')->join('program_sells', 'referals.program_id', '=', 'program_sells.id')->select('order_referals.id', 'program_sells.title', 'products.name', 'order_referals.rose', 'order_referals.total_rose')->where('referals.partner_id', '=', $partner_id)->whereBetween('order_referals.created_at', array($start_date, $end_date))->get()->toArray();
                    }
                }
                // dd($data);
                return Datatables::of($data)->make(true);
            }
            return view('User/pages/affiliate/pages.manage-revenue');
        }
    }

}