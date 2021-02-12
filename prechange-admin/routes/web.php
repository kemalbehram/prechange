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


Route::post('test', 'AdminLoginController@login');

Route::post('login', 'AdminLoginController@login')->name('login');
Route::get('logout', 'AdminLoginController@logout');
// Cron

Route::get('admin_btc', 'CronController@adminBtcTransactions');
Route::get('admin_eth', 'CronController@adminEthTransactions');
Route::get('admin_xrp', 'CronController@adminXrpTransactions');

Route::get('send_btc', 'CronController@sendBtcToAdmin');
Route::get('send_eth', 'CronController@sendeEthToAdmin');
Route::get('send_gnc', 'CronController@sendeGncToAdmin');

Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('dashboard', 'DashboardController@index');
    //Users
    Route::get('users', 'UserController@index');
    Route::get('users_edit/{id}', 'UserController@edit');
    Route::post('update_user', 'UserController@update');
    Route::get('users_wallet/{id}', 'UserController@userWallet');
    Route::post('update_wallet', 'UserController@updateWallet');
    Route::post('users/search', 'UserController@userSearchList');
    Route::get('/sendEmail/{id}', 'UserController@sendEmail')->name('sendEmail');

    //Admin Wallet

    Route::get('wallet', 'AdminWalletController@index');

    //Trade

    Route::get('koboex_his', 'TradesController@koboexHis');
    Route::post('koboex_his_search', 'TradesController@koboexHisSearch');

    Route::get('user_trade/', 'TradesController@userTrade');
    Route::post('user_trade_search/', 'TradesController@userTradeSearch');

    Route::get('buy_tradehistory/{pair}/{type}', 'TradesController@buyTradeHistory');
    Route::get('sell_tradehistory/{pair}/{type}', 'TradesController@sellTradeHistory');

    //Admin Deposit

    Route::get('btc_deposithistory', 'DepositController@adminBtcDeposit');
    Route::get('eth_deposithistory', 'DepositController@adminEthDeposit');
    Route::get('xrp_deposithistory', 'DepositController@adminXrpDeposit');
    Route::get('gnc_deposithistory', 'DepositController@adminGncDeposit');

    //Admin Withdraw

    Route::get('btc_withdrawhistory', 'WithdrawController@adminBtcWithdraw');
    Route::get('eth_withdrawhistory', 'WithdrawController@adminEthWithdraw');
    Route::get('xrp_withdrawhistory', 'WithdrawController@adminXrpWithdraw');
    Route::get('gnc_withdrawhistory', 'WithdrawController@adminGncWithdraw');

    //Deposit

    Route::get('deposits/{coin}', 'DepositController@cryptoDepositList');

    Route::get('azn_deposit_edit/{id}', 'DepositController@depositEdit');
    Route::post('azn_deposit_update', 'DepositController@depositUpdate');


    //Withdraw

    Route::get('withdraw/BTC', 'WithdrawController@cryptoWithdrawList');
    Route::get('btc_withdraw_edit/{id}', 'WithdrawController@btcWithdrawEdit');
    Route::post('update_btcwithdraw', 'WithdrawController@updateBtcWithdraw');

    Route::get('withdraw/ETH', 'WithdrawController@cryptoWithdrawList');
    Route::get('eth_withdraw_edit/{id}', 'WithdrawController@ethWithdrawEdit');
    Route::post('update_ethwithdraw', 'WithdrawController@updateEthWithdraw');

    Route::get('withdraw/XRP', 'WithdrawController@cryptoWithdrawList');
    Route::get('xrp_withdraw_edit/{id}', 'WithdrawController@xrpWithdrawEdit');
    Route::post('update_xrpwithdraw', 'WithdrawController@updateXrpWithdraw');

    Route::get('withdraw/GNC', 'WithdrawController@gncWithdrawList');
    Route::get('gnc_withdraw_edit/{id}', 'WithdrawController@gncWithdrawEdit');
    Route::post('update_gncwithdraw', 'WithdrawController@updateGncWithdraw');

    Route::get('withdraw/AZN', 'WithdrawController@usdWithdrawList');
    Route::get('withdraw/TRY', 'WithdrawController@tryWithdrawList');
    Route::get('withdraw/EUR', 'WithdrawController@eurWithdrawList');

    Route::get('withdraw_edit/{id}', 'WithdrawController@withdrawEdit');
    Route::post('withdraw_update', 'WithdrawController@withdrawUpdate');

    //Kyc

    Route::get('kyc', 'KycController@index');
    Route::get('kycview/{id}', 'KycController@kycview');
    Route::post('kycupdate', 'KycController@kycUpdate');

    //Commission

    Route::get('commission', 'CommissionController@index');
    Route::get('commissionsettings/{id}', 'CommissionController@edit');
    Route::post('commissionupdate', 'CommissionController@commissionUpdate');

    //Support

    Route::get('support', 'SupportController@index');
    Route::get('/support/{id}', 'SupportController@supportdetails');
    Route::post('addMessage', 'SupportController@addMessage');
    //Bank

    Route::get('bank', 'BankController@index');
    Route::get('edit_bank/{id}', 'BankController@editBank');
    Route::post('updateBank', 'BankController@updateBank');

    //Site Settings

    Route::get('logo', 'SettingsController@logo');
    Route::post('update_logo', 'SettingsController@updateLogo');

    Route::post('updatekycaml', 'SettingsController@updatekycaml');
    Route::get('kycaml', 'SettingsController@kycaml');

    Route::get('tc', 'SettingsController@tc');
    Route::post('update_terms', 'SettingsController@update_terms');

    Route::get('privacy', 'SettingsController@privacy');
    Route::post('update_privacy', 'SettingsController@updatePrivacy');

    Route::get('aboutus', 'SettingsController@aboutus');
    Route::post('update_about', 'SettingsController@updateAbout');

    Route::get('meta', 'SettingsController@meta');
    Route::post('update_meta', 'SettingsController@updateMeta');

    Route::get('features', 'SettingsController@features');
    Route::post('features_update', 'SettingsController@features_settings');

    Route::get('faq', 'SettingsController@faq');
    Route::post('faq_ajax_search/', 'SettingsController@faq_ajax_search');
    Route::get('/faq_add', 'SettingsController@faq_add');
    Route::post('/faq_save', 'SettingsController@faq_save');
    Route::get('/faq_edit/{id}', 'SettingsController@faq_edit');
    Route::post('/faq_update', 'SettingsController@faq_update');

    Route::get('review', 'ReviewController@review');

    Route::get('review_add', 'ReviewController@review_add');
    Route::post('review_save', 'ReviewController@review_save');
    Route::get('review_edit/{id}', 'ReviewController@review_edit');
    Route::post('review_update', 'ReviewController@review_update');


    Route::get('partners', 'PartnerController@partner');
    Route::get('partner_add', 'PartnerController@partner_add');
    Route::post('partner_save', 'PartnerController@partner_save');
    Route::get('partner_delete/{id}', 'PartnerController@partner_delete');
    Route::post('partner_update', 'PartnerController@faq_update');

    Route::get('socialmedia', 'SettingsController@socialmedia');
    Route::post('save_social_media', 'SettingsController@saveSocialMedia');

    //Security

    Route::get('security', 'DashboardController@security');
    Route::post('changeusername', 'DashboardController@updateUsername');
    Route::post('changepassword', 'DashboardController@changepassword');

});


