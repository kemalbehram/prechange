<?php
namespace App\Traits;
use Illuminate\Http\Request;
use App\UserBtcTransaction;
use App\UserLtcTransaction;

trait Liquidity
{
	public $apiKey = '584a85fe-735c-4ab9-887e-3a5167073187';
	public $secret = 'N0wDAyM8eXCMbryfLoQz9LVPqhu0WtMlu1yJpIHIrf6h0rdu9zzOJQR1x8SROb9LwRUOh3aZeVJFsPPQEFAcew==';

	// public $apiKey = '46504171-631c-4559-b72e-8d8cb010ea9a';
	// public $secret = '1eix5sKvu6H+FNkDkLgMQTWyWElVGhoI4Nvr5zVIBY76fmU4pRDlRm2cRD6v2h/rrBEak74ZzFq8KCyhqxm1tQ';


	public function orderBookLtc()
	{

		$url = "https://api.crex24.com/v2/public/orderBook?instrument=LTC-BTC";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		if (curl_errno($ch)) {
			$result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		
		return json_decode($result);
		
	}

	public function buyTradeLtc()
	{
		$buyTradeLtc = $this->orderBookLtc();

		return $buyTradeLtc->buyLevels;
	}

	public function sellTradeLct()
	{
		$buyTradeLtc = $this->orderBookLtc(); 
		
		return $buyTradeLtc->sellLevels;
	}

	public function withdraw($param,$path)
	{
		$baseUrl = 'https://api.crex24.com';
		$apiKey = $this->apiKey;
		$secret = $this->secret;

		$path = $path;
		$body = $param;
		$nonce = round(microtime(true) * 1000);

		$key = base64_decode($secret);
		$message = $path . $nonce . $body;
		$signature = base64_encode(hash_hmac('sha512', $message, $key, true));

		$curl = curl_init($baseUrl . $path);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
		    'Content-Length:' . strlen($body),
		    'X-CREX24-API-KEY:' . $apiKey,
		    'X-CREX24-API-NONCE:' . $nonce,
		    'X-CREX24-API-SIGN:' . $signature
		]);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$responseBody = curl_exec($curl);
		$responseStatusCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE); 
		curl_close($curl); 
		return json_decode($responseBody);
	}

	public function withdrawStatusUpdate()
	{

		$baseUrl = 'https://api.crex24.com';
		$apiKey = $this->apiKey;
		$secret = $this->secret;

		$path = '/v2/account/moneyTransfers';
		$nonce = round(microtime(true) * 1000);

		$key = base64_decode($secret);
		$message = $path . $nonce;
		$signature = base64_encode(hash_hmac('sha512', $message, $key, true));

		$curl = curl_init($baseUrl . $path);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'X-CREX24-API-KEY:' . $apiKey,
		'X-CREX24-API-NONCE:' . $nonce,
		'X-CREX24-API-SIGN:' . $signature
		]);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$responseBody = curl_exec($curl);
		$responseStatusCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
		curl_close($curl);

		return json_decode($responseBody);
	}
	
	public function btcWithdrawUpdate()
	{
		$result = $this->withdrawStatusUpdate();    
		foreach ($result as $key => $value) {
			$updateStatus = UserBtcTransaction::where('txid','')->where('order_id',$value->id)->first();
			if(count($updateStatus)>0 && $value->status ='success')
			{
				$updateStatus->txid = $value->txId;
				$updateStatus->save();
			}
		}

	}

	public function ltcWithdrawUpdate()
	{
		$result = $this->withdrawStatusUpdate();  
		foreach ($result as $key => $value) {
			$updateStatus = UserLtcTransaction::where('txid','')->where('order_id',$value->id)->first();
			if(count($updateStatus)>0 && $value->status ='success')
			{
				$updateStatus->txid = $value->txId;
				$updateStatus->save();
			}
		}
	}


	public function trade($path,$params)
	{
		$baseUrl = 'https://api.crex24.com';
		$apiKey = $this->apiKey;
		$secret = $this->secret;

		$path = $path;
		$body = $params;
		$nonce = round(microtime(true) * 1000);

		$key = base64_decode($secret);
		$message = $path . $nonce . $body;
		$signature = base64_encode(hash_hmac('sha512', $message, $key, true));

		$curl = curl_init($baseUrl . $path);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
		    'Content-Length:' . strlen($body),
		    'X-CREX24-API-KEY:' . $apiKey,
		    'X-CREX24-API-NONCE:' . $nonce,
		    'X-CREX24-API-SIGN:' . $signature
		]);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$responseBody = curl_exec($curl);
		$responseStatusCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE); 
		curl_close($curl); 
		return json_decode($responseBody);
	} 

	public function tradeUpdates($id)
	{

		$baseUrl = 'https://api.crex24.com';
		$apiKey = $this->apiKey;
		$secret = $this->secret;

		$path = '/v2/trading/orderStatus?id='.$id.'';
		$nonce = round(microtime(true) * 1000);

		$key = base64_decode($secret);
		$message = $path . $nonce;
		$signature = base64_encode(hash_hmac('sha512', $message, $key, true));

		$curl = curl_init($baseUrl . $path);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'X-CREX24-API-KEY:' . $apiKey,
		'X-CREX24-API-NONCE:' . $nonce,
		'X-CREX24-API-SIGN:' . $signature
		]);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$responseBody = curl_exec($curl);
		$responseStatusCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
		curl_close($curl);

		return json_decode($responseBody);
	}

	public function tradeStatus($val)
	{
		if($val == 'filled'){
                $status = 1;
        } elseif($val == 'partiallyFilledCancelled' && $val == 'unfilledCancelled') {
            $status = 100;
        } else {
            $status = 0;
        } 
        return $status;
	}

	public function basic($path)
	{
		$baseUrl = 'https://api.crex24.com';
		$apiKey = $this->apiKey;
		$secret = $this->secret;

		$path = $path;
		$nonce = round(microtime(true) * 1000);

		$key = base64_decode($secret);
		$message = $path . $nonce;
		$signature = base64_encode(hash_hmac('sha512', $message, $key, true));

		$curl = curl_init($baseUrl . $path);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'X-CREX24-API-KEY:' . $apiKey,
		'X-CREX24-API-NONCE:' . $nonce,
		'X-CREX24-API-SIGN:' . $signature
		]);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$responseBody = curl_exec($curl);
		$responseStatusCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
		curl_close($curl);

		return json_decode($responseBody);
	}
}