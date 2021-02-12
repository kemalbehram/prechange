<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\User;
use App\Models\UserWallet;
use App\Models\EthAdminAddress;
use App\Models\UserEthAddressTable;
use App\Models\UserEthTransaction;
use App\EthAdminTransaction;
use App\Models\UserEthAddress;

trait EthClass
{
	public function ethcreate() {
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.blockcypher.com/v1/eth/main/addrs');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
		return json_decode($result);
	}

	public function create_user_eth($id)
   	{
        $user_address = UserEthAddress::where('user_id',$id)->first();
        if(!is_object($user_address))
        {
          $ethaddress = $this->ethcreate();
          if(isset($ethaddress->address)){
          $ethtable = new UserEthAddress;
          $ethtable->user_id = $id;
          $ethtable->address = "0x".$ethaddress->address;
          $pvtk = Crypt::encryptString($ethaddress->private);
          $pubk = Crypt::encryptString($ethaddress->public);
          $ethtable->narcanru = $pvtk.','.$pubk;
          $ethtable->balance = 0.00000000;
          $ethtable->save();


    $check_wallet = UserWallet::where('user_id',$id)->where('currency','ETH')->first();

      if(is_object($check_wallet)){
        $check_wallet->mukavari = "0x".$ethaddress->address;
        $check_wallet->save();
      }else{
        UserWallet::create([
          'user_id' => $id,
          'mukavari' => "0x".$ethaddress->address,
          'balance' => 0,
          'currency' => 'ETH',
        ]);
      }


      $check_wallet = UserWallet::where('user_id',$id)->where('currency','USDT')->first();

      if(is_object($check_wallet)){
        $check_wallet->mukavari = "0x".$ethaddress->address;
        $check_wallet->save();
      }else{
        UserWallet::create([
          'user_id' => $id,
          'mukavari' => "0x".$ethaddress->address,
          'balance' => 0,
          'currency' => 'USDT',
        ]);
      }

        
          return $ethaddress->address;
      }else{
        return 'No address';
      }
        }
        else{
          return $user_address->address;
        }
            
    }


    public function cUrlss($url, $postfilds=null){
         $this->url = $url;
         $this->ch = curl_init();
         curl_setopt($this->ch, CURLOPT_URL, $this->url);
         curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
         if(!is_null($postfilds)){
         curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postfilds);
         }
         if(strpos($this->url, '?') !== false){
         curl_setopt($this->ch, CURLOPT_POST, 1);
         }
         $headers = array('Content-Length: 0');
         $headers[] = "Content-Type: application/x-www-form-urlencoded";
         curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
         if (curl_errno($this->ch)) {
         $this->result = 'Error:' . curl_error($this->ch);
         } else {
         $this->result = curl_exec($this->ch);
         } 
         curl_close($this->ch);
         return json_decode($this->result, true);
    }
   

    function cron_user_credit_balance($uid,$amount){
    	$currency ='ETH';
        $userbalance = Wallet::where([['uid', '=', $uid], ['currency', '=',$currency]])->first();
        if($userbalance) {
          $total = bcadd($amount, $userbalance->balance,8);
          Wallet::where([['uid', '=', $uid], ['currency', '=', $currency]])->update(['balance' => $total], ['updated_at' => date('Y-m-d H:i:s',time())]);
        } else {
          Wallet::insert(['uid' => $uid, 'currency' => $currency, 'balance' => $amount, 'created_at' => date('Y-m-d H:i:s',time()), 'updated_at' => date('Y-m-d H:i:s',time())]);
        }
          return  true;
    }

}

?>