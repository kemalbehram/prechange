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



Route::get('login', 'PageController@homeIndex')->name('login');

Route::get('/', 'PageController@homeIndex');


Route::post('/priceget','CurlDataController@priceget');
Route::post('/exchangeamount','CurlDataController@getExchangeAmt');

Route::post('/addressvalidate','CurlDataController@validateaddress');


Route::post('userregister','Authcontoller@myformPost');
Route::post('userlogin','Authcontoller@userlogin');

Route::get('/logout', 'Authcontoller@logout');

Route::get('verify/{email}/{verifyToken}', 'Authcontoller@sendEmailDone')->name('sendEmailDone');


Route::get('profile', 'UserController@UserIndex');
Route::get('exchange', 'ExchangeController@exchangeind');
Route::get('checkout','ExchangeController@checkout');

Route::post('sessionsave','CurlDataController@sessionSave');
Route::get('confirm','ExchangeController@confirm');

Route::post('change-password', 'UserprofileController@updatePassword');

Route::get('terms-condition','PageController@terms');
Route::get('privacy-policy','PageController@privacy');
Route::get('contact','PageController@contact');
Route::post('sendcontactmail','PageController@sendcontactmail');
