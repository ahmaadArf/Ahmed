<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Favourite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('global_carts', Cart::all());
        View::share('global_favorites', Favourite::all());
    }
}
