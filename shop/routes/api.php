<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('products', 'OurproductController@show');
Route::get('products/{id}', 'OurproductController@find');
Route::get('products_paging', 'OurproductController@paging');
Route::get('np', 'BuyController@apinp');

//Route::post('products', 'OurproductController@store');
//Route::put('products/{id}', 'OurproductController@update');
//Route::delete('products/{id}', 'OurproductController@delete');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware('auth:api')->get('get_products', 'CategoryController@get_product_with_characteristic');
Route::middleware('auth:api')->post('favorites','FavoriteController@apifavorites');
Route::middleware('auth:api')->post('boughts','BuyController@apiboughts');

//Route::post('register', '\App\Http\Controllers\Auth\RegisterController@register');
//Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');

//Route::middleware('auth:admin')->post('admin', 'CategoryController@get_product_with_characteristic');
Route::post('adminlogin','Auth\AdminController@login');
Route::middleware('admin')->post('adminlogout','Auth\AdminController@logout');