<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\OrderController@index');

Route::get('/summary', function () {
    return view('orders.summary');
});

Route::get('orders.create', function(){
    return view('orders.create');
})->name('create');

Route::post('orders.store', 'App\Http\Controllers\OrderController@store')->name('store');

Route::post('orders.pay', 'App\Http\Controllers\OrderController@pay')->name('pay');

Route::get('/order/{id}', 'App\Http\Controllers\OrderController@order')->name('order');
