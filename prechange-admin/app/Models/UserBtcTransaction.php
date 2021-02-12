<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserWallet;
use App\Models\BtcAdminAddress;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositEmail;
use App\Mail\WithdrawEmail;
use Carbon\Carbon;
use App\Models\AdminWallet;
use Auth;

class UserBtcTransaction extends Model
{ 
    
	public static function history($request)
    {
    	 if($request->status == 0)
        {
            $history= UserBtcTransaction::on('mysql2')->where('type',$request->type)->whereBetween('created_at',[$request->from,$request->to])->orderBy('id','desc')->paginate(10);
        }
        else
        {   
            $history= UserBtcTransaction::on('mysql2')->where('type',$request->type)->where('status',$request->status)->whereBetween('created_at',[$request->from,$request->to])->orderBy('id','desc')->paginate(10);
        }  
        
        return $history;
    }

    public static function withdrawEdit($id)
    {
    	$withdraw = UserBtcTransaction::on('mysql2')->where('id',$id)->first();

    	return $withdraw;
    } 

    public static function withdrawUpdate($request)
    {
    	$withdraw = UserBtcTransaction::on('mysql2')->where('id',$request->id)->first();

        if($request->status == 2)
        { 

            $balanceUpdate = UserWallet::on('mysql2')->where('uid',$withdraw->user_id)->where('currency','BTC')->first();
            $balanceUpdate->balance = $balanceUpdate->balance + $withdraw->total_amount;
            $balanceUpdate->save(); 

            $withdraw->status = 2 ;
            $withdraw->save();

            $admin = AdminWallet::on('mysql2')->where('currency','BTC')->first();
            $admin->withdraw = $admin->withdraw - $withdraw->fees;
            $admin->save();

            $status = 'Cancel';

        }
        elseif($request->status == 1)
        {
            $withdraw->status = 1;
            $withdraw->save();
            
            $status = 'Accept'; 
        } 

        

        return 'Withdrawn status updated successfully';
    }

    public static function totalTransactions($type)
    {
        $total = UserBtcTransaction::on('mysql2')->where('type',$type)->count();

        return $total;
    }

    public static function today()
    {
        $today = UserBtcTransaction::on('mysql2')->whereDate('created_at',Carbon::today())->count();

        return $today;
    }



    public static function createTransaction($uid,$coin,$txid,$from,$to,$amount,$confirm=3,$time){
        
        $tran = UserBtcTransaction::on('mysql2')->where(['uid' => $uid, 'currency' => $coin,'txid' => $txid])->first();
        if(!$tran){
            $tran = new UserBtcTransaction();
            $tran->uid = $uid;
            $tran->currency = $coin;
            $tran->txtype = $uid;
            $tran->txid = $txid;
            $tran->from_addr = $from;
            $tran->to_addr = $to;
            $tran->amount = $amount;            
            $tran->status = 2;
            $tran->nirvaki_nilai = 0;
            $tran->created_at = $time;

            self::creditAmount_balance($uid, $coin, $amount, 8);

        }
        $tran->confirmation = $confirm;
        $tran->updated_at = date('Y-m-d H:i:s',time());
        $tran->save();
        return $tran;

    }

    public static function creditAmount_balance($uid, $currency, $amount, $decimal)
    {
        $userbalance = UserWallet::on('mysql2')->where([['uid', '=', $uid], ['currency', '=',$currency]])->first();

        if($userbalance) {
            $total = number_format($amount + $userbalance->balance, $decimal);
            $site_balance = number_format($amount + $userbalance->site_balance, $decimal);

            $total = str_replace(',', '', $total);
            $site_balance = str_replace(',', '', $site_balance);

            $userbalance->balance = $total;
            $userbalance->site_balance = $site_balance;
            $userbalance->updated_at = date('Y-m-d H:i:s',time());
            $userbalance->save();
            
            return $userbalance;

        } else {            
            UserWallet::insert(['uid' => $uid, 'currency' => $currency, 'balance' => $amount, 'site_balance' => $amount, 'created_at' => date('Y-m-d H:i:s',time()), 'updated_at' => date('Y-m-d H:i:s',time())]);
        }
    }

         public static function AdminFee($coin)
    {
       $total = UserBtcTransaction::on('mysql2')->where('type','send')->sum('fees');

        return $total;
    }
    
}
