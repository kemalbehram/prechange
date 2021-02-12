<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBtcAddress;
use App\Models\UserEthAddress;

use App\Models\UserBtcTransaction;
use App\Models\UserEthTransaction;
use App\Models\UserBpcTransaction;
use App\Models\UserWallet;
use App\Models\Commission;
use App\User;


trait BitstampAPi {


	public function Bit_livePrice($coinone,$cointwo)
	{
		$curl = curl_init();

		if($coinone == 'XRP' && $cointwo == 'BTC'){
            $url = "https://www.bitstamp.net/api/v2/ticker/xrpbtc/";
        }elseif($coinone == 'ETH' && $cointwo == 'BTC'){
            $url = "https://www.bitstamp.net/api/v2/ticker/ethbtc/";
        }

		curl_setopt( $curl, CURLOPT_USERAGENT, "My User Agent" );
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,

		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,		  
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "postman-token: a45a3119-e337-a453-a004-4b46ee31fe21"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		  echo $data['price'] = 0;
		} else {
		  return json_decode($response);
		}


		// return $result;
	}


	

}




