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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('addresses', 'AddressController', ['except' => [
    'show', 
]]);

Route::resource('phones', 'PhoneController');

Route::get('users/search', 'UserAdminController@search');

Route::patch('users/togglestaff/{id}', 'UserAdminController@toggleStaffStatus');
Route::patch('users/toggleactive/{id}', 'UserAdminController@toggleActiveStatus');

Route::resource('users', 'UserAdminController', ['only' => [
    'index', 'show', 'destroy', 'create', 'store'
]]);

Route::get('user/password_change/{id}/edit', 'UserController@editPassword');
Route::patch('user/password_change/{id}', 'UserController@updatePassword');

Route::resource('user', 'UserController', ['only' => [
    'edit', 'update'
]]);

Route::get('spaces/availability/{availability}', 'SpaceController@indexStat');

Route::get('spaces/search', 'SpaceController@search');

Route::resource('spaces', 'SpaceController', ['except' => [
    'show', 
]]);

Route::get('orders-admin/status/{status}', 'OrderAdminController@indexStat');
Route::get('orders-admin/search', 'OrderAdminController@search');

Route::resource('orders-admin', 'OrderAdminController', ['except' => [
    'destroy', 'create', 'store'
]]);

Route::post('/cart', 'CartController@addToCart');
Route::get('/cart', 'CartController@show');
Route::delete('cart/{id}', 'CartController@destroy');

Route::post('/checkout', 'CheckOutController@store');

Route::get('order/{id}', 'OrderAdminController@show');

Route::get('myorder', 'OrderUserController@index');

Route::get('myorder/{id}', 'OrderUserController@show');

Route::get('systemdate', 'SystemDateController@show');

Route::patch('systemdate', 'SystemDateController@update');

Route::get('reserve', 'PreRegisterController@show');
