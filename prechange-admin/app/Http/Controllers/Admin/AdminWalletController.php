<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Commission;
use App\Models\UserWallet;
use App\Models\AdminBtcAddress;
use App\Models\AdminEthAddress;
use App\Models\AdminXrpAddress;
use App\Models\AdminGncAddress;
use App\Traits\Bitcoin;

class AdminWalletController extends Controller
{
	use Bitcoin;

	public function index()
	{ 
		$btc_address = AdminBtcAddress::first();	

		$eth_address = AdminEthAddress::first();		

		$xrp_address = AdminXrpAddress::first();
        
        
        

        if(is_object($btc_address)){
            $btc_address = $btc_address->address;
            $btc_balance = $this->btcBalance($btc_address);
        }else{
            $btc_address = 'no address';
            $btc_balance = 0;
        }

        if(is_object($eth_address)){
            $eth_address = $eth_address->address;
            $eth_balance = $this->ethBalance($eth_address);
        }else{
            $eth_address = 'no address';
            $eth_balance = 0;
        }


        if(is_object($xrp_address)){
            $xrp_address = $xrp_address->address;
            $xrp_balance = $this->xrpbalance($xrp_address);
        }else{
            $xrp_address = 'no address';
            $xrp_balance = 0;
        }  


		$address = array(
			'BTC'=>$btc_address,
			'ETH'=>$eth_address,
			'XRP'=>$xrp_address,
			'AZN'=>'',
			);

		$balance = array(
			'BTC'=>$btc_balance,
			'ETH'=>$eth_balance,
			'XRP'=>$xrp_balance,
			'AZN'=>'',
			);
		
		return view('wallet.list',[
			'address' => $address,
			'balance' => $balance
			]);
	} 

	public function btcBalance($address)
	{
		if(!empty($address)){
            $url_link = "https://chain.so/api/v2/get_address_balance/BTC/".$address;
            $balance = $this->execCurl($url_link);  
            return $balance['data']['confirmed_balance']; 
        }else{
            return 0;
        }
	}

	public function ethBalance($address)
	{
		$url = "https://api.etherscan.io/api?module=account&action=balance&address=".$address.'&apikey=CCUH3GDDJXE6CGYWU8XK1VAZI652YWIYRS';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        if (curl_errno($ch)) {
        $result = 'Error:' . curl_error($ch);
        } else {
        $result = curl_exec($ch);
        }
        curl_close($ch); 
        $dd = json_decode($result); 
        return $dd->result/1000000000000000000;
	}

	public function xrpbalance($address)
	{
		$url = "https://data.ripple.com/v2/accounts/".$address."/balances";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        if (curl_errno($ch)) {
        $result = 'Error:' . curl_error($ch);
        } else {
        $result = curl_exec($ch);
        }
        curl_close($ch); 
        $dd = json_decode($result);
        if(isset($dd->balances[0]->value))
        {
        	return $dd->balances[0]->value;
        }
        else
        {
        	return 0 ;
        }
	}

	public function gncbalance($address)
	{
		$url = "https://api.tokenbalance.com/balance/0xeb09ee9f510d87ffdff43e16cc4683a8a6288534/".$address;

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        if (curl_errno($ch)) {
        $result = 'Error:' . curl_error($ch);
        } else {
        $result = curl_exec($ch);
        }
        curl_close($ch); 
        $dd = json_decode($result);  
        return $dd;
	}

}