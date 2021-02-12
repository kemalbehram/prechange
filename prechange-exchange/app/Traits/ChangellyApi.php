<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\UserWallet;
use App\Commission;
use App\User;


trait ChangellyApi {

    function getcurrency()
    {
        $apiKey = '986b0b5f818c4df996c96277177a9cb6';
        $apiSecret = 'da75d34dd384cfd8c724faea49f05e43432d5555c94d7eac38b799e4adc32436';
        $apiUrl = 'https://api.changelly.com';

        $message = json_encode(
            array('jsonrpc' => '2.0', 'id' => 1, 'method' => 'getCurrenciesFull', 'params' => array())
        );
        $sign = hash_hmac('sha512', $message, $apiSecret);
        $requestHeaders = [
            'api-key:' . $apiKey,
            'sign:' . $sign,
            'Content-type: application/json'
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
        // var_dump($response);
    }


    function getExchangeAmount($res)
    {
        $apiKey = '986b0b5f818c4df996c96277177a9cb6';
        $apiSecret = 'da75d34dd384cfd8c724faea49f05e43432d5555c94d7eac38b799e4adc32436';
        $apiUrl = 'https://api.changelly.com';

        // $param = array('from'=>$res->coinone,'to'=>$res->cointwo,'amount'=>1); 
        $param[0] = array('from'=>$res->coinone,'to'=>$res->cointwo,'amount'=>$res->amount); 
        // $param[1] = array('from'=>$res->coinone,'to'=>$res->cointwo,'amount'=>$res->amount); 


        $message = json_encode(
            array('jsonrpc' => '2.0', 'id' => 1, 'method' => 'getExchangeAmount', 'params' => $param)
        );
        $sign = hash_hmac('sha512', $message, $apiSecret);
        $requestHeaders = [
            'api-key:' . $apiKey,
            'sign:' . $sign,
            'Content-type: application/json'
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
        // var_dump($response);
    }


    function createTransaction($coinone,$cointwo,$address,$amount)
    {
        $apiKey = '986b0b5f818c4df996c96277177a9cb6';
        $apiSecret = 'da75d34dd384cfd8c724faea49f05e43432d5555c94d7eac38b799e4adc32436';
        $apiUrl = 'https://api.changelly.com';

   
        $param = array('from'=>$coinone,'to'=>$cointwo,'address'=>$address, 'amount' => $amount); 


        $message = json_encode(
            array('jsonrpc' => '2.0', 'id' => 1, 'method' => 'createTransaction', 'params' => $param)
        );
        $sign = hash_hmac('sha512', $message, $apiSecret);
        $requestHeaders = [
            'api-key:' . $apiKey,
            'sign:' . $sign,
            'Content-type: application/json'
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
        // var_dump($response);
    }


    
 }