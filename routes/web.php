<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/plant/show/{id}', 'PlantController@show')->name('plant.show');
Route::get('/plant/buy/{id}', 'PlantController@buy')->name('plant.buy');
Route::get('/plant/category/{id}', 'PlantController@category')->name('plant.category');
Route::get('/cart', 'CartController@index')->name('cart.list');
Route::get('/cart/order', 'CartController@order')->name('cart.order');
Route::get('/orders', 'OrderController@index')->name('orders.list');
Route::get('/cart/delete/{id}', 'CartController@deleteItem')->name('cart.delete');
Route::get('/news', 'NewsController@index')->name('news.list');
Route::get('/news/show/{id}', 'NewsController@show')->name('news.show');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::get('/news', 'NewsController@newsList')->name('news.list-admin');
    Route::get('/news/edit/{id}', 'NewsController@edit')->name('news.edit');
    Route::get('/news/delete/{news}', 'NewsController@deleteNews')->name('news.delete');
    Route::get('/news/create', 'NewsController@create')->name('news.create');
    Route::post('/news/add', 'NewsController@store')->name('news.add');
    Route::get('/plants/create', 'PlantController@create')->name('plants.create');
    Route::post('/plants/add', 'PlantController@store')->name('plants.add');
});

Route::resource('plant', 'PlantController');
