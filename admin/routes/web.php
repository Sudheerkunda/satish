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

Route::get('/', function () {
    return view('index');
});

Route::post('login','LoginController@login');
Route::get('pending','HomeController@pending');

Route::get('completed/{id}','HomeController@order_completed');

Route::post('/view_detail','HomeController@view_details');

Route::get('logout','LoginController@logout');

Route::get('completed',function(){
    return view('completed');
});

Route::get('ProductsList', function () {
    return view('products_list');
});
Route::get('remove/{id}','HomeController@remove_product');

Route::get('add_product', function () {
    return view('add_product');
});

Route::post('addproduct','HomeController@addproduct');