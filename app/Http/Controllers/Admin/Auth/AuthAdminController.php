<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckLoginAdminRequest;
use App\Http\Requests\Admin\user\UserStoreRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        if(session()->has('user_email')){
            return redirect()->route('home.index');
        }
        return view('admin.pages.auth.login');
    }

    public function create()
    {
        if(session()->has('user_email')){
            return redirect()->route('home.index');
        }
        return view('admin.pages.auth.register');
    }

    public function register(UserStoreRequest $request)
    {
        $user =  $this->userRepository->create($request);
        if($user)
        {
            return view('admin.pages.auth.login');
        }
        return redirect()->back();
    }

    public function checkLogin(CheckLoginAdminRequest $request)
    {
        $user =  $this->userRepository->checkLogin($request);
        if($user)
        {
            return redirect()->route('home.index');
        }
        return redirect()->back()->with('notify', 'Thông tin tài khoản hoặc mật khẩu không chính xác');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login');
    }
}
