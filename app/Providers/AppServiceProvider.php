<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        View::composer('layouts.header', function ($view) {
            if (Auth::guard('web')->check()) {
                $count_favorite = Auth::guard('web')->user()->favoriteProducts->count();
            } else {
                $count_favorite = 0;
            }

            $view->with('count_favorite', $count_favorite);
        });
    }
}
