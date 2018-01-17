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

Route::get('users/search', 'UserAdminController@search')->name('users.search');

Route::patch('users/togglestaff/{id}', 'UserAdminController@toggleStaffStatus')->name('users.togglestaff');
Route::patch('users/toggleactive/{id}', 'UserAdminController@toggleActiveStatus')->name('users.toggleactive');

Route::resource('users', 'UserAdminController', ['only' => [
    'index', 'show', 'destroy', 'create', 'store'
]]);

Route::get('user/password_change/{id}/edit', 'UserController@editPassword')->name('user.password');
Route::patch('user/password_change/{id}', 'UserController@updatePassword')->name('user.passwordedit');

Route::resource('user', 'UserController', ['only' => [
    'edit', 'update'
]]);

Route::get('spaces/availability/{availability}', 'SpaceController@indexStat')->name('spaces.availability');

Route::get('spaces/search', 'SpaceController@search')->name('spaces.search');

Route::resource('spaces', 'SpaceController', ['except' => [
    'show', 
]]);

Route::get('orders-admin/status/{status}', 'OrderAdminController@indexStat')->name('orders-admin.status');
Route::get('orders-admin/search', 'OrderAdminController@search') ->name('orders-admin.search');

Route::resource('orders-admin', 'OrderAdminController', ['except' => [
    'destroy', 'create', 'store'
]]);

Route::post('cart', 'CartController@addToCart')->name('cart');
Route::get('cart', 'CartController@show');
Route::delete('cart/{id}', 'CartController@destroy')->name('cart.delete');

Route::post('checkout', 'CheckOutController@store')->name('checkout');

Route::get('order/{id}', 'OrderAdminController@show')->name('order');

Route::get('myorder', 'OrderUserController@index') ->name('myorder.index');

Route::get('myorder/{id}', 'OrderUserController@show') ->name('myorder.show');

Route::get('systemdate', 'SystemDateController@show')->name('systemdate');

Route::patch('systemdate', 'SystemDateController@update');

Route::get('reserve', 'PreRegisterController@show') -> name('reserve');
