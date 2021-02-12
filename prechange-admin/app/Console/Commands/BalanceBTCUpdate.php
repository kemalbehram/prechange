<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\CryptoTransactions;
use App\Models\UserBtcAddress;


class BalanceBTCUpdate extends Command
{
/**
* The name and signature of the console command.
*
* @var string
*/
protected $signature = 'update:btc';

/**
* The console command description.
*
* @var string
*/
protected $description = 'Update BTC transaction for logged Users';

/**
* Create a new command instance.
*
* @return void
*/
public function __construct()
{
  parent::__construct();
}

/**
* Execute the console command.
*
* @return mixed
*/
public function handle()
{
  $users = UserBtcAddress::get();
  if(count($users) > 0){            
    foreach ($users as $user) {
      $uid = $user->user_id;
      $uid = 1;
      $address = $user->address;
      if($address){
        $url = 'https://chain.so/api/v2/get_tx_received/BTC/'.$address;
        $get_transaction = $this->exe_btc_transaction($url, $address);
        dd($get_transaction);
        if(isset($get_transaction)){
          if($get_transaction['status'] == 'success' && count($get_transaction['data']['txs']) > 0)
          {
            foreach($get_transaction['data']['txs'] as $transaction_data){
              $tx_hash = $transaction_data['txid'];
              $btc_url_datas = "https://chain.so/api/v2/get_tx/BTC/".$tx_hash;
              $confirm=$transaction_data['confirmations'];
              $time=$transaction_data['time'];
              $transaction = $this->exe_btc_transaction($btc_url_datas, $address);
              if(isset($transaction))
              {
                if($transaction['status'] == 'success')
                {
                  $sender = $receiver = NULL;
                  $total = 0;
                  $time = $transaction['data']['time'];

                  foreach($transaction['data']['inputs'] as $vin){
                    if(isset($vin['address'])){
                      $sender = $vin['address'];
                    }
                  }

                  $count = count($transaction['data']['outputs']);
                  for($i = 0; $i < $count; $i++)
                  {
                    if($address == $transaction['data']['outputs'][$i]['address'])
                    {
                      $receiver = $address;
                      $total = $transaction['data']['outputs'][$i]['value'];
                    }
                  }

                  if($sender != $address)
                  {
                    UserBtcTransaction::createTransaction($uid,'BTC',$tx_hash,$sender,$receiver,$total,$confirm,$time);
                  }
                }
              }
            }
          }
        }



//   if($tran){      
//   if(count($tran->txs) > 0){
//     foreach($tran->txs as $addr){
//       $order_no   = TransactionString().$uid;
//       $txid       = $addr->txid;
//       $sender     = $addr->vin[0]->addr;
//       $confirm    = $addr->confirmations;
//       $fees       = $addr->fees;
//       $time       = $addr->time;
//       foreach ($addr->vout as $vout) {
//         if(in_array($useraddress , $vout->scriptPubKey->addresses)){
//           $receiver = $useraddress;
//           $amount = $vout->value;
//           $amount = str_replace(',','',$amount);
//           $amount = (float)$amount;
//           break;
//         }else{
//           $receiver = "";
//         }                 
//       }
//       if($receiver == $useraddress)
//       {
//         CryptoTransactions::createTransaction($uid,'BTC',$txid,$sender,$receiver,$amount,$confirm,$time);
//       }
//     }
//   }
// }            
      }
    }
  }

  $this->info('BTC transaction updated to All Users');
}

// public function crul($url){
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     $headers = array();
//     $headers[] = "Accept: application/json, text/plain";
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     if (curl_errno($ch)) {
//         echo $result = 'Error:' . curl_error($ch);
//     } else {
//         $result = curl_exec($ch);
//     }
//     curl_close($ch);
//     return $result;
// }

public function exe_btc_transaction($btc_exec_url, $address)
{
  $url = $btc_exec_url;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $headers = array();
  $headers[] = "Accept: application/json, text/plain";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  if (curl_errno($ch)) {
    echo $result = 'Error:' . curl_error($ch);
  } else {
    $result = curl_exec($ch);
  }
  curl_close($ch);

  dd($result);
  return json_decode($result, true);
}
}
