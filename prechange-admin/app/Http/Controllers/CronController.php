<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Crypt;
use App\Models\AdminBtcAddress;
use App\Models\AdminBtcTransaction;
use App\Models\AdminEthAddress;
use App\Models\AdminEthTransaction;
use App\Models\AdminXrpAddress;
use App\Models\AdminXrpTransaction;
use App\Models\AdminGncAddress;
use App\Models\UserBtcTransaction;
use App\Models\UserEthTransaction;
use App\Models\UserBtcAddress;
use App\Models\UserWallet;
use App\Models\UserEthAddress; 
use App\Models\UserXrpTransaction;
use App\Models\UserXrpAddress;
use App\Models\UserGncTransaction;
use App\Traits\Bitcoin;
use App\Traits\Ethereum;


class CronController extends Controller
{
	use Bitcoin, Ethereum;

	public function adminBtcTransactions()
	{
		$admin_address = AdminBtcAddress::first();
		$address = $admin_address->address;
		$get_transaction = $this->getTransactions($address);

		if($get_transaction && isset($get_transaction->txs) && count($get_transaction->txs) > 0){
			foreach($get_transaction->txs as $transaction){
				$tx_hash    = $transaction->txid;
				$sender     = $transaction->vin[0]->addr;
				$confirm    = $transaction->confirmations;
				$fees       = $transaction->fees;
				$time       = $transaction->time;
				foreach($transaction->vin as $vin){
					if($vin->addr === $address){
						break;
					}
				}
				foreach ($transaction->vout as $vout) {
					if(in_array($address , $vout->scriptPubKey->addresses)){
						$receiver = $address;
						$total = $vout->value;
						break;
					}
				}

				$type = "send";

				if(isset($receiver) && $receiver == $address)
				{
					$type = "received";
				}
				if(isset($receiver) && $receiver!= $sender)
				{
					
					$is_txn = AdminBtcTransaction::where('txid', $tx_hash)->count();

					if($is_txn == 0)
					{
						$btctransaction = new AdminBtcTransaction;
						$btctransaction->type = 'received';
						$btctransaction->recipient = $receiver;
						$btctransaction->sender = $sender;
						$btctransaction->amount = $total;
						$btctransaction->txid = $tx_hash;
						$btctransaction->save();
					}
				}
			} 
		} 
	}

	public function adminEthTransactions()
	{   
		$admin_address = AdminEthAddress::first();
		$address = $admin_address->address; 
		$balance = $this->getEthTransaction($address);

		if($balance)
		{
			$count = count($balance['result']);
			if($count > 0)
			{
				$result_data = $balance['result'];
				for($i = 0; $i < $count; $i++)
				{
					$data = $result_data[$i];
					$tx_hash = $data['hash'];
					$sender = $data['from'];
					$receiver = $data['to'];
					$total = $this->weitoeth($data['value']);
					$confirmations = $this->weitoeth($data['confirmations']);

					if($address == $sender)
					{
						$type = 'send';
					}
					else
					{
						$type = 'received'; 
					}

					$is_txn = AdminEthTransaction::where('txid', $tx_hash)->count();
					if($is_txn == 0)
					{	
						$his = new AdminEthTransaction; 
						$his->type = $type;
						$his->recipient = $receiver;
						$his->sender = $sender;
						$his->amount = $total; 
						$his->txid = $tx_hash; 
						$his->save();
					}   
				}
			} 
		}
	}

	public function adminXrpTransactions()
	{  
		$admin_address = AdminXrpAddress::first();
		$address = $admin_address->address; 
		$balance = $this->getXrpTransaction($address);
		if($balance)
		{
			foreach($balance as $trn)
			{
				$rcc_value = $trn['tx']['Amount']/1000000;
				$time = $trn['date'];
				$recive_address = $trn['tx']['Destination'];
				$type = $trn['tx']['TransactionType'];
				$send_address = $trn['tx']['Account'];
				$fee = $trn['tx']['Fee']/1000000;
				$DestinationTag = $trn['tx']['DestinationTag'];
				$txid = $trn['hash'];
				if($address != $recive_address)
				{
					$type = 'send';
				}
				else
				{
					$type = 'received';  
				}

				$is_txn = AdminXrpTransaction::where('txid',$txid)->where('type','received')->count();
				if($is_txn == 0)
				{ 
					$XrpTransaction = new AdminXrpTransaction;  
					$XrpTransaction->sender = $send_address;
					$XrpTransaction->recipient = $recive_address;
					$XrpTransaction->destination_tag = $DestinationTag;
					$XrpTransaction->amount = $rcc_value;
					$XrpTransaction->type = $type;
					$XrpTransaction->txid = $txid; 
					$XrpTransaction->save();
				}
				
			}
		} 
	}


	public function getXrpTransaction($address)
	{	
		$url = 'https://data.ripple.com/v2/accounts/'.$address.'/transactions';	
		$result = $this->cUrl_xrp($url);
		if($result['result']=='success' && $result['count'] > 0)
		{	
			return $result['transactions'];
		}
		else
		{
			return false;
		}
	}

	public function cUrl_xrp($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		$result = 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}

	public function sendBtcToAdmin()
	{
		$move_amount = UserBtcTransaction::on('mysql2')->where('type','received')->where('status',0)->orderBy('id','desc')->get();

		foreach ($move_amount as $key => $value) {
			$this->btcCron($value->id);
		}
	}

	public function btcCron()
	{
		$user = UserBtcTransaction::on('mysql2')->where('type','received')->where('status',0)->first(); 

		$admin = AdminBtcAddress::first();
		
		if(isset($user->user_id))
		{
			$amount = $user->amount;
			$from_address = $user->recipient;
	        $to_address = $admin->address;
	        $fee = 0.00002;  
	        $final_amount  = $amount - $fee ;
	        $user_details = UserBtcAddress::where('user_id',$user->user_id)->first();

	        $credential = explode(',',$user_details->credential);
            $pvtk = Crypt::decryptString($credential[2]);

            $send_to_admin = $this->send($to_address, $final_amount, $from_address, $pvtk, $fee);

            if($send_to_admin)
            {
            	
                $update = UserWallet::on('mysql2')->where('uid',$user->user_id)->where('currency','BTC')->first();  
                $update->site_balance = $update->site_balance + $user->amount;
                $update->balance = $update->balance + $user->amount;
                $update->save();

                $user->status = 2;
                $user->save();
            }
            else
            {
            	echo "Transaction Falied";
            }


		}
	}

	public function sendeEthToAdmin()
	{
		$move_amount = UserEthTransaction::on('mysql2')->where('type','received')->where('status','0')->orderBy('id','desc')->get();
		foreach ($move_amount as $key => $value) {
			$this->ethCron($value->id);
		}
	}

	public function ethCron($id)
	{
		$user = UserEthTransaction::on('mysql2')->where('id',$id)->where('type','received')->where('status','0')->first();

		$admin = AdminEthAddress::first();
	
		
		if(is_object($user)>0)
		{
			$user_details = UserEthAddress::where('user_id',$user->user_id)->first();
			
			

			if(isset($user_details->address))
			{	
				$eth_bal = $this->ethBalance($user_details->address);
				if($eth_bal >= $user->amount)
				{
					$fee = 0.00042;  
					$amount = $user->amount - $fee; 

					$from_address = $user->recipient;
			        $to_address = $admin->address;  
			        $credential = explode(',',$user_details->credential);
		            $pvtk = Crypt::decryptString($credential[0]);
		            $send_to_admin = $this->ethSendTransaction($from_address, $to_address, $amount, $pvtk);

		            if($send_to_admin->txid)
		            {
		                $update = UserWallet::on('mysql2')->where('uid',$user->user_id)->where('currency','ETH')->first();  
		                $update->site_balance = $update->site_balance + $user->amount;
		                $update->balance = $update->balance + $user->amount;
		                $update->save();

		                $user->status = 2;
		                $user->save();
		            }
	        	}
			}
		}
	}


	public function sendeGncToAdmin()
	{
		$move_amount = UserGncTransaction::on('mysql2')->where('type','received')->where('status','1')->orderBy('id','desc')->get();
		foreach ($move_amount as $key => $value) {
			$this->gncCron($value->id);
		}
	}

	public function gncCron($id)
	{

		$move_amount = UserGncTransaction::on('mysql2')->where('id',$id)->first();
		if($move_amount && $move_amount->count() > 0)
		{
			$user_id = $move_amount->user_id;	
			$admin = AdminGncAddress::first();
			$user_details = UserEthAddress::where('user_id',$user_id)->first();
			if(isset($user_details->address))
			{
				$get_user_address = $user_details->address;
				$find_real_amount = $this->ethBalance($get_user_address);
				if($find_real_amount >= 0.002)
				{
					if(count($user_details) > 0)
					{	
						$fee = 0.00080764155;
						$amount = $move_amount->amount;
						// $total_send_amount = bcsub(sprintf('%.10f',$amount), sprintf('%.10f',$fee), 8);
						$total_send_amount = $amount;
						$from_address = $get_user_address;
						$credential = explode(',',$user_details->narcanru);
		            	$pvtk = Crypt::decryptString($credential[0]);
						$to_address = $admin->address;

						if($to_address !='' && $to_address !=NULL)
						{	
							// $contract = "0xDe4D23E64EFC1fA200034bF1Fa834b786cF6507c";
							$contract = "0xeb09ee9f510d87ffdff43e16cc4683a8a6288534";
							
							$send_amount = $this->convert($total_send_amount);

							$send = $this->gncSendTransaction($from_address, $to_address, $send_amount, $pvtk);
							;
							if(isset($send) && $send->txid!='')
							{
								$update = UserWallet::on('mysql2')->where('uid',$user_id)->where('currency','GNC')->first();  
				                $update->site_balance = $update->site_balance +$amount;
				                $update->balance = $update->balance + $amount;
				                $update->save();

				                $transaction = UserGncTransaction::on('mysql2')->where('status',1)->where('type','received')->where('id',$move_amount->id)->first();
				                $transaction->status = 2;
				                $transaction->save();
							}
							else
							{
								echo $send ;
							}
						}
					}

				}
				else
				{
					$userBal = UserWallet::on('mysql2')->where('uid',$user_id)->where('currency','ETH')->first();
				//temporarily comment by client request
					// if( $userBal->balance > 0.00142)
					// {
						$send_from_admin = $this->sendFromAdminUser($get_user_address);

						// if($send_from_admin->txid)
			   //          { 
			   //            //  $userBal->site_balance = $userBal->site_balance;
			   //              $userBal->balance = $userBal->balance - 0.00142;
			   //              $userBal->save(); 
			   //          }
					//}
				}

			}
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

	public function convert($amount)
	{
		return 1000000000000000000 * $amount;
	}

	public function sendFromAdminUser($toaddress)
	{
		$user_details = UserEthAddress::where('user_id',70)->first();

		$fee = 0.00042;  
		$amount = 0.00242 - $fee; 
		$from_address = $user_details->address;
        $to_address = $toaddress;  

        $credential = explode(',',$user_details->narcanru);
        $pvtk = Crypt::decryptString($credential[0]);
        $send_to_admin = $this->ethSendTransaction($from_address, $to_address, $amount, $pvtk);

        return $send_to_admin;
	}

}