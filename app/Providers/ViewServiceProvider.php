<?php

namespace App\Providers;

use App\Cart;
use App\Category;
use App\News;
use App\Plant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Using Closure based composers...
        View::composer(['sidebar.categories','plants.create'], function ($view) {
            $categories = Category::all();
            $view->with(['categories' => $categories]);
        });

        View::composer('layouts.footer', function ($view) {
            $count = Plant::all()->count();
            $idRand = rand(0, $count);
            $plantRand = Plant::query()->find($idRand);
            $view->with(['plantRand' => $plantRand]);
        });
        View::composer('layouts.content-bottom', function ($view) {
            $plants = Plant::query()->limit(3)->orderByDesc('id')->get();
            $view->with(['plants' => $plants]);
        });
        View::composer('layouts.header', function ($view) {
            $cartCount = Cart::query()->where('user_id', Auth::id())->count();
            $view->with(['cartCount' => $cartCount]);
        });
        View::composer('sidebar.news', function ($view) {
            $lastNews = News::query()->limit(3)->orderByDesc('id')->get();
            $view->with(['lastNews' => $lastNews]);
        });
    }
}
