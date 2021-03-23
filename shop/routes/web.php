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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','HomeController@index');
Route::get('/profile','HomeController@profile');

Route::get('/favorits','FavoriteController@userfavorits');

Route::get('contact','Contact_usController@contact');
Route::post('addfeedback','Contact_usController@addfeedback');

Route::get('/products','OurproductController@ourproduct');
Route::get('/product/{id}','OurproductController@oneproduct');
Route::post('/product','OurproductController@addfavorite');

Route::get('/boughts','BuyController@showboughts');
Route::post('/buyform','BuyController@buypay');
Route::post('/confirm','BuyController@confirmpay');
Route::get('/bought/{id}','BuyController@singleBuy');
Route::get('/boughtanswer','BuyController@boughtanswer');
Route::post('/cancelbought','BuyController@cancelbought');
Route::get('/enter','BuyController@enterpay');
Route::post('/changedata','BuyController@changedata');

Route::get('/categories','CategoryController@categories');



Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@home')->name('home');
