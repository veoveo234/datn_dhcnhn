<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use Cart;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['*'], function ($view) {
            $count = Cart::count();

            $staff_curent = User::where('id',session('user_id'))->first();
            // dd(Auth::id());
            // dd($staff_curent);
            $view->with('count', $count)->with('staff_curent', $staff_curent);
        });
    }
}
