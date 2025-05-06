<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Chia sẻ biến $cart với tất cả view
        View::composer('*', function ($view) {
            $cart = null;
            if (Auth::check()) {
                $cart = Cart::with('cartDetails')->where('user_id', Auth::id())->first();
            }
            $view->with('cart', $cart);
        });
    }
}
