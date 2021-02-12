<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\SellTrades;
use App\Models\BuyTrades;
use App\Models\Kyc;
use App\Models\UserProfile;
use App\Models\CompletedTrade;

use App\Models\Supportchat;
use App\Models\Tickets;
use App\Models\Withdraw;
use App\Models\UserBtcAddress;
use App\Models\UserEthAddress;
use App\Models\UserXrpAddress;
use App\Models\UserWallet;
use App\Models\UserBtcTransaction;
use App\Models\UserEthTransaction;

use Carbon\Carbon;

use Illuminate\Notifications\Notifiable;

class User extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'users';

    public static function dashboard()
    {
        $totalusers = User::on('mysql2')->count();
        $todayusers = User::on('mysql2')->whereDate('created_at',Carbon::today())->count();
        $deactivate_users = User::on('mysql2')->where('status',2)->count();
        $kyc_req = Kyc::on('mysql2')->where('status',2)->count();
        $kyc_complete_count = Kyc::on('mysql2')->where('status',1)->count();


        $completedtrade = CompletedTrade::on('mysql2')->count();
        $buytrade = BuyTrades::on('mysql2')->where('status',0)->count();
        $selltrade = SellTrades::on('mysql2')->where('status',0)->count();

        $btc_deposit = 0;
        $eth_deposit = 0;
        $fors_deposit = 0;

        $btc_withdraw = 0;
        $eth_withdraw = 0;
        $fors_withdraw = 0;

        $total_deposit = $btc_deposit+$eth_deposit+$fors_deposit;
        $total_withdraw = $btc_withdraw+$eth_withdraw+$fors_withdraw;

        $today_btc_transaction = 0;
        $today_eth_transaction = 0;
        $today_fors_transaction = 0;

        $total_transactions = $total_deposit+$total_withdraw;

        $chat = Tickets::on('mysql2')->count();
        $support_ticket = Tickets::on('mysql2')->orderBy('id','desc')->limit(10)->get();
        $kyc_users = Kyc::on('mysql2')->where('status',0)->orderBy('id','desc')->limit(10)->get();

        
        $today_transactions = $today_btc_transaction+$today_eth_transaction+$today_fors_transaction;

        $details = array(
            'totalusers' => $totalusers,
            'todayusers' => $todayusers,
            'deactivate_users' => $deactivate_users,
            'kyc_req' => $kyc_req,
            'total_deposit' => $total_deposit,
            'total_withdraw' => $total_withdraw,
            'total_transactions' => $total_transactions,
            'today_transactions' => $today_transactions,
            'completedtrade' => $completedtrade,
            'buytrade' => $buytrade,
            'selltrade' => $selltrade,
            'withdraw_request' => $selltrade,
            'chat' => $chat,
            'kyc_users' => $kyc_users,
            'support_ticket' => $support_ticket,
            'kycverify' => $kyc_complete_count
            );

        return $details;
    }

    public static function index()
    {
        $users = User::on('mysql2')->orderBy('id', 'desc')->paginate(15);

        return $users;
    }

    public static function find($id)
    {
        $user = User::on('mysql2')->where('id', '=', $id)->first();

        return $user;
    }

    public static function list_deactive_user()
    {
        $user = User::on('mysql2')->where("status" , 0)->orWhere('status' , 2)->paginate(15);

        return $user;
    }

    public static function list_today_user()
    {
        $user = User::on('mysql2')->whereDate('created_at', Carbon::today())->paginate(15);

        return $user;
    }

    public static function kyc_request_user()
    {        
        $user = Kyc::on('mysql2')->with('kycdetails')->where('status',2)->paginate(15);
        return $user;
    }

    public static function userUpdate($request)
    {
        $fname = $request->fname;
        $country = $request->country;
        $phone = $request->phone;
        $email = $request->email;
        $twofactor = $request->twofactor;
        $address = $request->address;
        $user_id = $request->id;

        if($twofactor == 'disable')
        {
            $update = User::on('mysql2')->where('id', $user_id)->update(['google2fa_secret' => NULL, 'email2fa_otp' => 0, 'email2fa_secret' => NULL]);
        }

        $update = User::on('mysql2')->where('id', $user_id)->update(['name' => $fname, 'phone' => $phone, 'country' => $country, 'email' => $email, 'address' => $address  ]);

        $user = User::on('mysql2')->where('id', '=', $user_id)->first();
        $crypt_id = Crypt::encrypt($user_id);

        return $crypt_id;
    }

    public static function userWalletDetails($id)
    {
        $btcAddress = UserBtcAddress::where('user_id',$id)->first();
        $ethAddress = UserEthAddress::where('user_id',$id)->first();

        $details = array(
            'BTC'=>$btcAddress,
            'ETH'=>$ethAddress
            );

        return $details;

    }


    public static function searchList($request)
    {
        $users_data = User::on('mysql2')->orderBy('id', 'desc')->get();
        $users = User::on('mysql2')->orderBy('id', 'desc')->paginate(15);
        $q = $request->searchitem;
        
        $searchValues = preg_split('/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY); 

        $btc = UserBtcAddress::where('address',$q)->first();
        $eth = UserEthAddress::where('address',$q)->first(); 

        if(isset($btc->user_id)){
            $user_id = $btc->user_id;
        } elseif(isset($eth->user_id)){
             $user_id = $eth->user_id;
        } 

        if(isset($user_id))
        {  
            
            $users = User::on('mysql2')->where('id',$user_id)->paginate(15);

        } 
        else
        {
            $users = User::on('mysql2')->where(function ($q) use ($searchValues) {
              foreach ($searchValues as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
                $q->orWhere('email', 'like', "%{$value}%"); 
              }
            })->orderBy('id', 'desc')->paginate(15);
        }

        return $users;
    }

    public static function userStatusChange($request)
    {
        $updateStatus = User::where('id',$request->user)->first();
        $updateStatus->status = $request->status;
        $updateStatus->save();

        return true;
    }

    public static function excelExport()
    {
        $instance = new User();
        $wallet_coin=array();
        $items = User::select('id','fname','lname','email','phone')->with('WalletDetails')->get();

                foreach ($items as $key => $value) {

                    $data[$key]['id'] = $value->id;
                    $data[$key]['first name'] = $value->fname;
                    $data[$key]['last name'] = $value->lname;
                    $data[$key]['email'] = $value->email;
                    $data[$key]['phone'] = $value->phone;              

                    $commission = Commission::on('mysql2')->get();                       
                    foreach ($commission as $comm_key => $comm_value) {

                        $data[$key]['Deposit_'.$comm_value->source] = '0.00000000';
                        $data[$key]['Trade_'.$comm_value->source] = '0.00000000';
                        $data[$key]['Total_'.$comm_value->source] = '0.00000000';
                        $wallet_coin[]=$comm_value->source;    
                    }
                        foreach ($value->WalletDetails as $user_wallet_key => $user_wallet_value) {
                            if (in_array($user_wallet_value->currency,$wallet_coin)){
                                $call=$user_wallet_value->currency.'DeopistAmount';
                                $data[$key]['Deposit_'.$user_wallet_value->currency] 
                                = $instance->$call($value->id);
                                $data[$key]['Trade_'.$user_wallet_value->currency] = '0.0000000';
                                $data[$key]['Total_'.$user_wallet_value->currency] = '0.0000000';
                            }else{
                                $data[$key]['Deposit_'.$user_wallet_value->currency] = '0.0000000';
                                $data[$key]['Trade_'.$user_wallet_value->currency] = '0.0000000';
                                $data[$key]['Total_'.$user_wallet_value->currency] = '0.0000000';
                            }               
                        }                 
                }               
         
        return $data;
    }


    public static function ETHDeopistAmount($uid){

        $balance=UserEthTransaction::on('mysql2')->where('user_id',$uid)->where('type','received')->where('status',2)->sum('amount');
        return $balance;
    }

    public static function BTCDeopistAmount($uid){

          $balance=UserBtcTransaction::on('mysql2')->where('user_id',$uid)->where('type','received')->where('status',2)->sum('amount');
        return $balance;

    }
    public static function JADAXDeopistAmount($uid){
          $balance=UserJadaxTransaction::on('mysql2')->where('user_id',$uid)->where('type','received')->where('status',2)->sum('amount');
        return $balance;

    }

    public static function commission_wallet(){

    $commission = Commission::on('mysql2')->get();
        foreach ($commission as $key => $value) {
            $wallet[$key] =$value->source;
        }
        return $wallet;
    }
    
    public static function getIndividualUser($uid)
    {
        $instance = new User();

      $user = User::on('mysql2')->where('id', $uid)->with('userBtcDetails','userEthDetails')->first();  

      $commission = Commission::on('mysql2')->get();

      $users['commission'] =$instance->commission_wallet();


      $users['id'] =$user->id;
      $users['first_nmae']=$user->fname;
      $users['last_nmae']=$user->lname;
      $users['email']=$user->email;
      $users['mobile_number']=$user->phone;
      $users['dob']='';

      $profile = UserProfile::on('mysql2')->where('id', $uid)->first();  

      if($profile){
        $users['profile_img'] = $profile->profile_avatar;  
      }else{
        $users['profile_img']='';
      }

      
      
      $users['BTC_address']   = $user->userBtcDetails->address;
      $users['ETH_address']   = $user->userEthDetails->address;
      $users['JADAX_address'] = $user->userEthDetails->address;

      $users['BTC_deposit_balance']=$instance->BTCDeopistAmount($uid);
      $users['ETH_deposit_balance']=$instance->ETHDeopistAmount($uid);
      $users['JADAX_deposit_balance']=$instance->JADAXDeopistAmount($uid);

      $users['BTC_trade_balance']=$instance->BTCDeopistAmount($uid);
      $users['ETH_trade_balance']=$instance->ETHDeopistAmount($uid);
      $users['JADAX_trade_balance']=$instance->JADAXDeopistAmount($uid);

      $users['BTC_escrow_balance']=$instance->BTCDeopistAmount($uid);
      $users['ETH_escrow_balance']=$instance->ETHDeopistAmount($uid);
      $users['JADAX_escrow_balance']=$instance->JADAXDeopistAmount($uid);

      $users['BTC_total_balance']=$instance->BTCDeopistAmount($uid);
      $users['ETH_total_balance']=$instance->ETHDeopistAmount($uid);
      $users['JADAX_total_balance']=$instance->JADAXDeopistAmount($uid);

      $users['BTC_deposit_history']=$instance->getUserBtcDeposithistory($uid);
      $users['ETH_deposit_history']=$instance->getUserETHDeposithistory($uid);
      $users['JADAX_deposit_history']=$instance->getUserJadaxDeposithistory($uid);

      $users['BTC_withdraw_history']=$instance->getUserBtcWithdrawhistory($uid);
      $users['ETH_withdraw_history']=$instance->getUserETHWithdrawhistory($uid);
      $users['JADAX_withdraw_history']=$instance->getUserJadaxWithdrawhistory($uid);
      
      $users['buy_trade']=$instance->getUserBuyTrade($uid);
      $users['sell_trade']=$instance->getUserSellTrade($uid);

        return $users;

    }

    public static function getUserBuyTrade($uid)
    {
        $buy = BuyTrades::on('mysql2')->where('uid',$uid)->get();
        return $buy;
    }

    public static function getUserSellTrade($uid)
    {

        $sell = SellTrades::on('mysql2')->where('uid',$uid)->get();
        return $sell;
    }

    public static function getUserBtcDeposithistory($uid)
    {

        $btc_deposit = UserBtcTransaction::on('mysql2')->where('user_id',$uid)->where('type','received')->get();
        foreach ($btc_deposit as $key => $btc_deposit_value) {
            $btc_deposit_value->coin='BTC';
        }
        return $btc_deposit;
    }

    public static function getUserETHDeposithistory($uid)
    {
        $eth_deposit = UserEthTransaction::on('mysql2')->where('user_id',$uid)->where('type','received')->get();

        foreach ($eth_deposit as $key => $eth_deposit_value) {
            $eth_deposit_value->coin='ETH';
        }

        return $eth_deposit;
    }

    public static function getUserJadaxDeposithistory($uid)
    {
        $jadax_deposit = UserJadaxTransaction::on('mysql2')->where('user_id',$uid)->where('type','received')->get();

        foreach ($jadax_deposit as $key => $jadax_deposit_value) {
            $jadax_deposit_value->coin='JADAX';
        }

        return $jadax_deposit;
    }

    public static function getUserBtcWithdrawhistory($uid)
    {
        $btc_withdraw = UserBtcTransaction::on('mysql2')->where('user_id',$uid)->where('type','send')->get();
        
        foreach ($btc_withdraw as $key => $btc_withdraw_value) {
            $btc_withdraw_value->coin='BTC';
        }
        
        return $btc_withdraw;
    }

    public static function getUserETHWithdrawhistory($uid)
    {
        $eth_withdraw = UserEthTransaction::on('mysql2')->where('user_id',$uid)->where('type','send')->get();

         foreach ($eth_withdraw as $key => $eth_withdraw_value) {
            $eth_withdraw_value->coin='ETH';
        }

        return $eth_withdraw;
    }

    public static function getUserJadaxWithdrawhistory($uid)
    {
        $jadax_withdraw = UserJadaxTransaction::on('mysql2')->where('user_id',$uid)->where('type','send')->get();

         foreach ($jadax_withdraw as $key => $jadax_withdraw_value) {
            $jadax_withdraw_value->coin='JADAX';
        }

        return $jadax_withdraw;
    }

    // relationship

    public function WalletDetails()
    {
         return $this->hasMany('App\Models\UserWallet', 'user_id', 'id');
         // return $this->hasOne('App\Models\UserWallet', 'user_id', 'id');
         // ->select(array('currency','balance'));
        //return $this->belongsTo('App\Models\UserWallet', 'user_id', 'id');
    }

     public function userBtcDetails()
    {
        return $this->hasOne('App\Models\UserBtcAddress', 'user_id', 'id');
    } 

    public function userEthDetails()
    {
        return $this->hasOne('App\Models\UserEthAddress', 'user_id', 'id');
    }

    public function kycDetails()
    {
        return $this->hasOne('App\Models\Kyc');
    } 
}