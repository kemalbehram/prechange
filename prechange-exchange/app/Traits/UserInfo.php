<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\UserBtcAddress;
use App\UserLtcAddress;
use App\UserEthAddress;
use App\UserDogcoinAddress;
use App\UserDogcoinTransaction;

use App\UserBtcTransaction;
use App\UserEthTransaction;
use App\UserLtcTransaction;
use App\UserLinearTransaction;
use App\UserUsdtTransaction;
use App\UserXrpTransaction;
use App\UserXrpAddressTable;

use App\Models\UserWallet;
use App\Models\Commission;
use App\User;


trait UserInfo {

    public function btcAddress()
    {
        $btcAddress = UserBtcAddress::where('user_id',Auth::id())->first();

        if(is_object($btcAddress)){
                return $btcAddress->address;
        }else{
            return 'No Address';    
        }
    }

    public function ethAddress()
    {
        $ethAddress = UserEthAddress::where('user_id',Auth::id())->first();      
        if(is_object($ethAddress)){
                return $ethAddress->address;
        }else{ 
            return 'No Address';    
        }
        
    }

     public function ltcAddress()
    {
        $ltcAddress = UserLtcAddress::where('user_id',Auth::id())->first();

        if(is_object($ltcAddress)){
                return $ltcAddress->address;
        }else{
            return 'No Address';    
        }
    }

    public function xrpAddress()
    {
        $ltcAddress = UserXrpAddressTable::where('user_id',Auth::id())->first();

        if(is_object($ltcAddress)){
                return $ltcAddress->address;
        }else{
            return 'No Address';    
        }   
    }

    public function dogeAddress()
    {
        $ltcAddress = UserDogcoinAddress::where('user_id',Auth::id())->first();

        if(is_object($ltcAddress)){
                return $ltcAddress->address;
        }else{
            return 'No Address';    
        }   
    }

    public function userBalance($coin)
    {
        $userBalance = UserWallet::where('user_id',\Auth::id())->where('currency',$coin)->first(); 

        if(!isset($userBalance->balance))
        {
            $userBalance = 0.00000000;
        }
        else
        {
            $userBalance = number_format($userBalance->balance,8,'.','');
        }

        return $userBalance;
    }

    public function commission($coin)
    {
        $commission = Commission::where('source',$coin)->first(); 

        return $commission;
    }

    public function assign_rand_value($num) { 
        switch($num) {
            case "1"  : $rand_value = "a"; break;
            case "2"  : $rand_value = "b"; break;
            case "3"  : $rand_value = "c"; break;
            case "4"  : $rand_value = "d"; break;
            case "5"  : $rand_value = "e"; break;
            case "6"  : $rand_value = "f"; break;
            case "7"  : $rand_value = "g"; break;
            case "8"  : $rand_value = "h"; break;
            case "9"  : $rand_value = "i"; break;
            case "10" : $rand_value = "j"; break;
            case "11" : $rand_value = "k"; break;
            case "12" : $rand_value = "l"; break;
            case "13" : $rand_value = "m"; break;
            case "14" : $rand_value = "n"; break;
            case "15" : $rand_value = "o"; break;
            case "16" : $rand_value = "p"; break;
            case "17" : $rand_value = "q"; break;
            case "18" : $rand_value = "r"; break;
            case "19" : $rand_value = "s"; break;
            case "20" : $rand_value = "t"; break;
            case "21" : $rand_value = "u"; break;
            case "22" : $rand_value = "v"; break;
            case "23" : $rand_value = "w"; break;
            case "24" : $rand_value = "x"; break;
            case "25" : $rand_value = "y"; break;
            case "26" : $rand_value = "z"; break;
            case "27" : $rand_value = "0"; break;
            case "28" : $rand_value = "1"; break;
            case "29" : $rand_value = "2"; break;
            case "30" : $rand_value = "3"; break;
            case "31" : $rand_value = "4"; break;
            case "32" : $rand_value = "5"; break;
            case "33" : $rand_value = "6"; break;
            case "34" : $rand_value = "7"; break;
            case "35" : $rand_value = "8"; break;
            case "36" : $rand_value = "9"; break;
        }
        return $rand_value;
    }


    public function get_rand_alphanumeric($length) {
        if ($length>0) {
            $rand_id="";
            for ($i=1; $i<=$length; $i++) {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,36);
                $rand_id .= $this->assign_rand_value($num);
            }
        }
        return $rand_id;
    }


    public function balanceUpdate($amount, $coin, $user)
    {
        $wallet = UserWallet::where('user_id',$user)->where('currency',$coin)->first();

        if(isset($wallet))
        {
            $wallet->balance = $wallet->balance + $amount;
            $wallet->save();
        }
        else
        {
            $balance = new UserWallet();
            $balance->user_id = $user;
            $balance->currency = $coin;
            $balance->balance = $amount;
            $balance->save();
        }
    }

    public function balanceDebit($amount, $coin, $user)
    {

        $wallet = UserWallet::where('user_id',$user)->where('currency',$coin)->first();
        $wallet->balance = $wallet->balance - $amount;
        $wallet->save();
    }

    public function netFee($coin)
    {
        // if($coin == 'BTC')
        // {
        //     return 0.00002;
        // }
        // elseif($coin == 'ETH')
        // {
        //     return 0.00042;
        // }
        // else
        // {
        //     return 0;
        // }

        $netfee = Commission::where('source',$coin)->value('net_fee');

        return $netfee;
    }

    public function UserPendingBalance($uid,$currency,$totalAmount)
    {

        $balance = $this->userBalance($currency);
        
        if($currency == 'BTC'){

                $pending_balance_check = UserBtcTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;

                if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }

        }elseif ($currency == 'ETH') {

                $pending_balance_check = UserEthTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;
        
                if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }
        }elseif ($currency == 'LTC') {

                $pending_balance_check = UserLtcTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;

                if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }
        }elseif ($currency == 'XRP') {
            
                $pending_balance_check = UserXrpTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;

                if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }

        }elseif ($currency == 'LINEAR') {
            
             $pending_balance_check = UserLinearTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;

               if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }

        }elseif ($currency == 'USDT') {

             $pending_balance_check = UserUsdtTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;

                if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }
        }elseif($currency == 'DOGE'){

                $pending_balance_check = UserDogcoinTransaction::where('user_id',$uid)->where('type','received')->where('status',1)->sum('amount');

                $pending_balance = $balance - $pending_balance_check;

                if($pending_balance < $totalAmount){
                   return 0;
                }else{
                    return 1;
                }

        }
               
    }

    
 }