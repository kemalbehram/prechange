<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Libraries\Demon;
use App\Traits\BtcConfig;
use App\Models\UserBtcAddress;
use App\User;
use App\Models\UserBtcTransaction;
use App\Models\UserWallet;
use App\BtcAdminAddress;
use App\Traits\UserInfo;
use App\Traits\Bitcoin;

trait BtcClass
{

    use BtcConfig, UserInfo, Bitcoin;

    function btcAddressCreate($saLabel)
    {
        
        $getDetails = $this->btcConfigDetails();
        $response = new Demon($getDetails);
        $address = $response->getnewaddress($saLabel);

        return $address;
    }

    public function btc_user_address_create($uid) {
        
    $user_address = UserBtcAddress::where('user_id',$uid)->first();

    if(!is_object($user_address))
    {
      $btc = $this->createaddress_btc();

      $address = $btc->address;
      $publickey = Crypt::encryptString($btc->publickey);
      $wif = Crypt::encryptString($btc->wif);
      $privatekey = Crypt::encryptString($btc->privatekey);
      $btcaddress = new UserBtcAddress;
      $credential = $publickey.','.$wif.','.$privatekey;
      $btcaddress->user_id = $uid;
      $btcaddress->address = $address;
      $btcaddress->narcanru = $credential;
      $btcaddress->balance = 0.00000000;
      $btcaddress->save();


    $check_wallet = UserWallet::where('user_id',$uid)->where('currency','BTC')->first();

      if(is_object($check_wallet)){
        $check_wallet->mukavari = $address;
        $check_wallet->save();
      }else{
        UserWallet::create([
          'user_id' => $uid,
          'mukavari' => $address,
          'balance' => 0,
          'currency' => 'BTC',
        ]);
      }

      return $address;
    }
    else{
      return $user_address->address;
    }

    }


    function userBtcAddress($saLabel)
    { 
        $address = UserBtcAddress::where('user_id', \Auth::id())->first();

        if(isset($address->address))
        { 
            return Crypt::decryptString($address->address);
        }
        else
        {
            $getAddress = $this->btcAddressCreate($saLabel);
            $security = User::where('id', \Auth::id())->first();
            $satctable = new UserBtcAddress;
            $satctable->user_id = $security->id;
            $satctable->address = Crypt::encryptString($getAddress['address']);
            $satctable->label = Crypt::encryptString($saLabel);
            $satctable->narcanru = Crypt::encryptString($getAddress['publickey']);  
            $satctable->save();

            return Crypt::decryptString($satctable->address);
        }
                

    }


    public function userBtcUpdate($id)
    {
        $user = UserBtcAddress::where('user_id',$id)->first();

        if(isset($user))
        {
            $address = Crypt::decryptString($user->address);
            $get_transaction = $this->getTransactions($address);

            if($get_transaction && isset($get_transaction->txs) && count($get_transaction->txs) > 0){
                foreach($get_transaction->txs as $transaction){
                    $tx_hash    = $transaction->txid;
                    $sender     = $transaction->vin[0]->addr;
                    $confirm    = $transaction->confirmations;
                    $fees       = $transaction->fees;
                    $time       = $transaction->time;
                    foreach($transaction->vin as $vin){
                        if($vin->addr === $address){
                            break;
                        }
                    }
                    foreach ($transaction->vout as $vout) {
                        if(in_array($address , $vout->scriptPubKey->addresses)){
                            $receiver = $address;
                            $total = $vout->value;
                            break;
                        }
                    }

                    $type = "send";

                    if(isset($receiver) && $receiver == $address)
                    {
                        $type = "received";
                    }
                    if(isset($receiver) && $receiver!= $sender)
                    {
                        
                        if($type == "received")
                        {
                            $is_txn = UserBtcTransaction::where('txid', $tx_hash)->count();

                            if($is_txn == 0)
                            {
                                $btctransaction = new UserBtcTransaction;
                                $btctransaction->user_id = $user->user_id;
                                $btctransaction->type = 'received';
                                $btctransaction->recipient = $receiver;
                                $btctransaction->sender = $sender;
                                $btctransaction->amount = $total;
                                $btctransaction->fees = 0; 
                                $btctransaction->confirmations = 100;
                                $btctransaction->txid = $tx_hash;
                                //$btctransaction->save();

                                $this->moveToAdmin($receiver,$total,$user->user_id); 
                                
                            }
                        }
                    }
                } 
            } 
        }
    }

    public function moveToAdmin($from, $amount, $user_id,$fee=0.00002)
    {
        
        $admin = BtcAdminAddress::first();
        $to = Crypt::decryptString($admin->address);
        $fee = 0.00002;
        $getDetails = $this->btcConfigDetails();
        $response = new Demon($getDetails); 
        $user = UserBtcAddress::where('user_id',$user_id)->first();
        $private = Crypt::decryptString($user->narcanru); 
        $sendAmount = floatval (bcsub(sprintf('%.10f', $amount), sprintf('%.10f', $fee), 8));
        //$txid = $response->sendBtc($from, $to, $amount);
        $txid = $this->send($to, $sendAmount, $from, $private, $fee);
        if(isset($txid))
        {
            $this->balanceUpdate($amount,'BTC',$user_id);
        }
    }


}