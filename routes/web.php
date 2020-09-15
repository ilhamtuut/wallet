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
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/blocks', 'HomeController@blocks')->name('blocks');
Route::get('/transactions', 'HomeController@transactions')->name('transactions');
Route::get('/api', ['as' => 'api.index', 'uses' => 'ApiController@index']);
Route::get('/tx/{hash}', ['as' => 'explorer.hash', 'uses' => 'ExplorerController@hash']);
Route::get('/block/{hash}', ['as' => 'explorer.block', 'uses' => 'ExplorerController@block']);
Route::get('/address/{address}', ['as' => 'explorer.address', 'uses' => 'ExplorerController@address']);
Route::get('/search', ['as' => 'explorer.search', 'uses' => 'ExplorerController@search']);

Route::group(['middleware' => ['auth','verified','block']], function() {
	Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function() {
	  	Route::get('/', ['as' => 'index', 'uses' => 'MyWalletController@index']);
	  	Route::get('/transaction', ['as' => 'transaction', 'uses' => 'MyWalletController@transaction']);
	  	Route::get('/send', ['as' => 'send', 'uses' => 'MyWalletController@send']);
	  	Route::get('/receive', ['as' => 'receive', 'uses' => 'MyWalletController@receive']);
	  	Route::post('/update/label/{id}', ['as' => 'update_label', 'uses' => 'MyWalletController@update_label']);
	  	Route::post('/sendCoin', ['as' => 'sendCoin', 'uses' => 'MyWalletController@sendCoin']);
	  	Route::post('/createWallet', ['as' => 'createWallet', 'uses' => 'MyWalletController@createWallet']);
	});

	Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
	  	Route::get('/setting', ['as' => 'setting', 'uses' => 'UserController@setting']);
	  	Route::post('/updateName', ['as' => 'updateName', 'uses' => 'UserController@updateName']);
	  	Route::post('/updatePassword', ['as' => 'updatePassword', 'uses' => 'UserController@updatePassword']);
	});

	// administrator
	Route::group(['prefix' => 'administrator', 'as' => 'administrator.','middleware' => ['role:developer|administrator']], function() {
		Route::group(['prefix' => 'users', 'as' => 'users.' ], function() {
		  	Route::get('/list', ['as' => 'list', 'uses' => 'UserController@index']);
		  	Route::get('/block/{id}', ['as' => 'block', 'uses' => 'UserController@block']);
		});

		Route::group(['prefix' => 'settings', 'as' => 'settings.' ], function() {
		  	Route::get('/', ['as' => 'index', 'uses' => 'SettingController@index']);
		  	Route::post('/update/{id}', ['as' => 'update', 'uses' => 'SettingController@update']);
		});

		Route::group(['prefix' => 'wallet', 'as' => 'wallet.' ], function() {
		  	Route::get('/list', ['as' => 'list', 'uses' => 'MyWalletController@list']);
		});
	});
});
