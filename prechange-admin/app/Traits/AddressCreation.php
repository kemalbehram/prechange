<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\BtcClass;
use App\Traits\EthClass;
use App\Traits\XrpClass;

trait AddressCreation {

	use BtcClass, EthClass, XrpClass;

	public function userAddressCreation($id)
	{
		
		$btcAddress = $this->btc_user_address_create($id);
		$ethAddress = $this->create_user_eth($id);
		$xrpaddress = $this->create_user_xrp($id);

		if(isset($btcAddress) && isset($ethAddress) && isset($xrpaddress))
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
}