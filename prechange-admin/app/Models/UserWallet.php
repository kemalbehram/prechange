<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $table = 'user_wallets';
    protected $fillable = ['balance','currency','uid'];

    public static function walletUpdate($request)
    {
    	$wallet = UserWallet::on('mysql2')->where('currency',$request->coin)->where('user_id',$request->uid)->first(); 

    	if(is_object($wallet)){
    		$wallet->balance = $request->amount;
    		$wallet->save();	
    	}else{
    		UserWallet::on('mysql2')->create([
    			'uid'      => $request->uid,
    			'currency' => $request->coin,
    			'balance'  => $request->amount
    		]);
    	}
    	
    }
}
