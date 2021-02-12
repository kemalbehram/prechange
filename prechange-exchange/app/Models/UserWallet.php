<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Commission;

class UserWallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = ['user_id', 'currency','mukavari','balance',	'escrow_balance','created_at', 'updated_at' ];

    public static function getAddress($uid, $currency){
        $address = Wallet::where([['uid', '=', $uid], ['currency', '=', $currency]])->value('mukavari');
        return $address;
    }

    public static function debitAmount($uid, $currency, $amount, $decimal)
    {
        $userbalance = Wallet::where([['uid', '=', $uid], ['currency', '=', $currency]])->first();
        if($userbalance) {
            $total = ncSub($userbalance->balance, $amount, $decimal);
            $site_balance = 0;
            if($userbalance->site_balance > 0)
            {
                $site_balance = ncSub($userbalance->site_balance,$amount, $decimal);
            }
            $userbalance->balance = $total;
            $userbalance->site_balance = $site_balance;
            $userbalance->updated_at = date('Y-m-d H:i:s',time());
            $userbalance->save();
            return $userbalance;
        }else{
        	return false;
        }
    }
    public static function creditAmount($uid, $currency, $amount, $decimal)
    {
        $userbalance = Wallet::where([['uid', '=', $uid], ['currency', '=',$currency]])->first();
        if($userbalance) {
            $total = ncAdd($amount, $userbalance->balance, $decimal);
            $site_balance = ncAdd($amount, $userbalance->site_balance, $decimal);
            $userbalance->balance = $total;
            $userbalance->site_balance = $site_balance;
            $userbalance->updated_at = date('Y-m-d H:i:s',time());
            $userbalance->save();
            return $userbalance;
        } else {        	
            Wallet::insert(['uid' => $uid, 'currency' => $currency, 'balance' => $amount, 'site_balance' => $amount, 'created_at' => date('Y-m-d H:i:s',time()), 'updated_at' => date('Y-m-d H:i:s',time())]);
        }
    }

    public static function checkEscrowbalance($uid, $currency){
        $userbalance = Wallet::where([['uid', '=', $uid], ['currency', '=',$currency]])->value('escrow_balance');        
        return $userbalance;
    }

    public static function createUserWallet($uid)
    {
        $commission = Commission::all();

        foreach ($commission as $key => $value) {
          $create_wallet =  Wallet::create([
            'uid'  => $uid,
            'currency' => $value->source,
            ]);         
        }

        return $create_wallet;
    }
}
