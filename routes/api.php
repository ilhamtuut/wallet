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
Route::post('login', 'Api\LoginController@login');
Route::post('register', 'Api\RegisterController@register');
Route::post('password/reset', 'Api\ResetPasswordController@sendResetLinkEmail');
Route::group(['middleware' => ['auth:api'], 'namespace'=> 'Api'], function() {
	// user
   	Route::group(['prefix' => 'user'], function() {
		Route::get('profile', 'UserController@profile');
		Route::post('password/update', 'UserController@updatePassword');
	});

	// glp
   	Route::group(['prefix' => 'glp'], function() {
		Route::post('create', 'WalletController@createWallet');
		Route::get('balance/{address}', 'WalletController@myBalance');
		Route::get('myWallet', 'WalletController@myWallet');
		Route::post('sendCoin', 'WalletController@sendCoin');
		Route::get('transaction', 'WalletController@transaction');
	});
});
