<?php
namespace App\Traits;

trait Bitcoin 
{  
	private $url = "https://insight.bitpay.com/api/";
	private function _call($params){
		$ch = curl_init(); 
		// curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8070");
		curl_setopt($ch, CURLOPT_URL, "http://167.71.152.74:8070");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result);
	}
	
	private function sathosi($amount){
		if(!empty($amount)){
			return 100000000 * $amount;
		}
	}
	
	private function sathositobtc($amount){
		if($amount != 0){
			if(!empty($amount)){
				return bcdiv($amount, 100000000, 8);
			}
		} else {
			return $amount;
		}
	}
	
	// create address
	public function createaddress_btc(){
		$params = array("method" => "create_address");
		if(!empty($params)){
			return $this->_call($params);
		}
	}
	
	public function createmsigaddress(){
		$params = array("method" => "create_multisig_address");
		if(!empty($params)){
			return $this->_call($params);
		}
	}
	
	// send bitcoin
	public function send($to, $amount, $from=null,$pvtkey, $fee=null){
		$utxo = self::utxo($from);
			if(!empty($utxo)){
			$params = array(
				"method" => "create_rawtx",
				"fromaddr" => $from,
				"privatekey" => $pvtkey,
				"toaddr" => $to,
				"amount" => self::sathosi($amount),
				"fee" => self::sathosi($fee),
				"utxo" => $utxo
			);
			if(!empty($params)){
				$rawtx = $this->_call($params);
				if(!empty($rawtx)){
					return $this->sendbtc($rawtx->rawtx);
				}
			}
		}
	}
	
	private function sendbtc($rawtx){
		if(!empty($rawtx)){
			$url = $this->url."tx/send";
			$ch = curl_init();
			$params = array("rawtx" => $rawtx);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			curl_setopt($ch, CURLOPT_POST, 1);
			$headers = array();
			$headers[] = "Accept: application/json, text/plain";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			if(curl_errno($ch)) {
				echo $result = 'Error:' . curl_error($ch);
			} else {
				$result = curl_exec($ch);
			}
			curl_close($ch); 
			 
			return json_decode($result);
		}
	}
	
	private function utxo($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/utxo?noCache=1";
			return $this->cUrl1($url);
		}
	}
	
	public function tx($txid){
		if(!empty($txid)){
			$url = $this->url."tx/$txid";
			return json_decode($this->cUrl1($url));
		}
	}

	
	public function getTransactions($address){
		if(!empty($address)){
			$url = $this->url."txs/?address=$address";
			return json_decode($this->cUrl1($url));
		}
	}
	
	public function getBalance($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/balance";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}else{
			return 0;
		}
	}
	
	public function totalReceived($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/totalReceived";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}
	}
	
	public function totalSent($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/totalSent";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}
	}
	
	public function unconfirmedBalance($address){
		if(!empty($address)){
			$url = $this->url."addr/$address/unconfirmedBalance";
			$balance = $this->cUrl1($url);
			return $this->sathositobtc($balance);
		}
	}

	public function addressvalidate($req)
	{
			$params = array(
				"method" => "create_rawtx",
				"address" => $req->address,
				"coin" => $req->coin,
			);
		return $this->_call($params);	
	}
	
	private function cUrl1($url){
		$ch = curl_init();
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
		return $result;
	}
	
}
?>