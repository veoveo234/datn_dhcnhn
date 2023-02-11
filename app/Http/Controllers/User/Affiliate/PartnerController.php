<?php

namespace App\Http\Controllers\User\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Affiliate\PartnerRegisterRequest;
use App\Http\Requests\User\Affiliate\PartnerLoginRequest;
use App\Models\User\Affiliate\AffiliatePartner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    public function register(PartnerRegisterRequest $request)
    {
        $validated = $request->validated();
        $partner = AffiliatePartner::query()->where('email', $request->email)->where('phone', $request->phone)->first();
        if($partner == NULL){
            if($request->hasFile('avatar')){
                $image = $request->file('avatar')->hashName();
                Storage::putFile('public/images/affiliate', $request->file('avatar'));

                AffiliatePartner::create([
                    'avatar' => $image,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'profession' => $request->profession,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                AffiliatePartner::create([
                    'avatar' => "",
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'profession' => $request->profession,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]);
            }
            session()->flash('error', 'Đăng kí thành công - Tài khoản của bạn sẽ được phê duyệt từ 3 - 5 ngày!');
            return redirect()->route('affiliate.login');
        }else{
            session()->flash('error');
            return redirect()->back();
        }
    }

    public function login(PartnerLoginRequest $request)
    {
        $validated = $request->validated();
        $partner = AffiliatePartner::query()->where('email', $request->email)->first();
        if ($partner != NULL) {
            if(($partner->status) == 1){
                session()->flash('error', 'Tài khoản của bạn đang chờ phê duyệt.');
                return redirect()->back();
            }elseif(($partner->status) == 2){
                if (!Hash::check($request->password, $partner->password)) {
                    session()->flash('error', 'Mật khẩu không chính xác.');
                    return redirect()->back();
                } else {
                    session()->put('partner_id', $partner->id);
                    session()->put('partner_email', $partner->email);
                    return redirect()->route('affiliate.index');
                }
            }elseif(($partner->status) == 2){
                session()->flash('error', 'Tài khoản của bạn đang bị khóa.');
                return redirect()->back();
            }
        }else{
            session()->flash('error', 'Tài khoản không tồn tại.');
            return redirect()->back();
        }
    }

    
    public function logout()
    {
        if (session()->has('partner_id') && session()->has('partner_email')) {
            session()->forget('partner_id');
            session()->forget('partner_email');
            return redirect()->route('affiliate.index');
        }
    }
}
