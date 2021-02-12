<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\BtcClass;
use App\Traits\EthClass;



trait AddressCreation {

	use BtcClass, EthClass;

	public function userAddressCreation($id)
	{
 		$btcAddress = $this->btc_user_address_create($id);
 		$ethAddress = $this->create_user_eth($id);
 	        
		if(isset($btcAddress) && isset($ethAddress))
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
}