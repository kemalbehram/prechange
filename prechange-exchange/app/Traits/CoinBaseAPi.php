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


trait CoinBaseAPi {


	public function coinbase_liveprice($coinone,$cointwo)
	{
		$curl = curl_init();

		curl_setopt( $curl, CURLOPT_USERAGENT, "My User Agent" );
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.pro.coinbase.com/products/".$coinone."-".$cointwo."/ticker",
		  // CURLOPT_URL => "https://api.pro.coinbase.com/products/BTC-USD/ticker",

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




