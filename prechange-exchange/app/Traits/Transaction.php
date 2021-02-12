<?php 
namespace App\Traits;
use Blockchain\Btc\Facades\Blockchain;

use App\UserEthTransaction;
use App\Userethaddress;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\EthAdminAddress;
use App\EthAdminTransaction;
use App\LtcAdminAddress;
use App\LtcAdminTransaction;
use App\UserWallet;
use App\DashAdminTransaction;
use App\DashAdminAddress;
use App\Userdashaddress;
use App\UserDashTransaction;

trait Transaction {


	// function sendmanybtc($recipients,$address,$fee=NULL)
 //    {
 //        $btcapi = $this->BtcCredentials();
 //        Blockchain::setServiceUrl($btcapi['url']);
 //        Blockchain::credentials($btcapi['guid'], $btcapi['password']);       
 //        return Blockchain::sendMany($recipients, $address, $fee);
 //    }
    
 //    function sendbtc($to_address,$amount,$address,$fee=NULL)
 //    {
 //        $btcapi = $this->BtcCredentials();
 //        Blockchain::setServiceUrl($btcapi['url']);
 //        Blockchain::credentials($btcapi['guid'], $btcapi['password']); 
 //        return Blockchain::send($to_address, $amount, $from_address=null, $fee=null);
 //    }

    function creataEthUserTransaction($toaddress, $fromaddress, $amount)
    {
        $tokenblock = env('ETH_TOKEN_BLOCK');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.blockcypher.com/v1/eth/main/txs/new?token=$tokenblock");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"inputs\":[{\"addresses\": [\"$fromaddress\"]}],\"outputs\":[{\"addresses\": [\"$toaddress\"], \"value\": $amount}], \"gas_limit\" : 21000, \"gas_price\" : 20000000000 }");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $send = json_decode($result, true);

        //dd($send->errors);

        if ($send['errors'])
        {
            return Redirect::back()->with('fail', 'Insufficient Balance !!!');  
        } 
        elseif ($send['error'])
        {
            return Redirect::back()->with('fail', $send['error']);  
        } 
        elseif (!empty($send->tx))
        {
            $f_address = $fromaddress;
            $t_address = $toaddress;


            $from_addr = Crypt::encryptString($f_address);
            $to_addr = Crypt::encryptString($t_address);

            $private = Userethaddress::where('address', $from_addr)->first();

            if($private){
                
                $privatekey = Crypt::decryptString($private->private_key);
                $data = rtrim($result,"}");

                $tosign_count = count($send->tosign);
                $outputs = '';
                for($i = 0; $i < $tosign_count; $i++)
                {
                    $tosign = $send->tosign[$i];
                    $output = exec($dir."btcutils/signer/signer $tosign $privatekey 2>&1");
                    $outputs .= '"'.trim($output).'",';
                }
                $outputs = trim($outputs, ", ");
                $tx = $data.', "signatures" : ['.$outputs.' ] } ';
                $data = self::sendTransaction($tx);
                
                if($data->error){
                    return 'Transaction failed';
                } elseif($data->tx){
                $hash = $data->tx->hash;
                $total = $this->weitoeth($data->tx->total);
                $fees = $this->weitoeth($data->tx->fees);    

                $ethTransaction = new UserEthTransaction;
                $ethTransaction->uid = \Auth::id();
                $ethTransaction->recipient = $to_addr;
                $ethTransaction->sender = $from_addr;
                $ethTransaction->amount = $total;
                $ethTransaction->fees = $fees;
                $ethTransaction->confrim = 0;
                $ethTransaction->txnid = $hash;
                if($ethTransaction->save())
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        }
       
    }


    function creataEthAdminTransaction($toaddress, $fromaddress, $amount)
    {
        $tokenblock = env('ETH_TOKEN_BLOCK');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.blockcypher.com/v1/eth/main/txs/new?token=$tokenblock");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"inputs\":[{\"addresses\": [\"$fromaddress\"]}],\"outputs\":[{\"addresses\": [\"$toaddress\"], \"value\": $amount}], \"gas_limit\" : 21000, \"gas_price\" : 20000000000 }");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $send = json_decode($result);

        //dd($send['error']);

        if ($send['errors'])
        {
            return Redirect::back()->with('fail', 'Something went wrong!!!');  
        } 
        elseif ($send['error'])
        {
            return Redirect::back()->with('fail', $send['error']);  
        } 
        elseif (!empty($send->tx))
        {
            $f_address = $fromaddress;
            $t_address = $toaddress;


            $from_addr = Crypt::encryptString($f_address);
            $to_addr = Crypt::encryptString($t_address);

            $private = EthAdminAddress::where('address', $from_addr)->first();

            if($private){
                
                $privatekey = Crypt::decryptString($private->private_key);
                $data = rtrim($result,"}");

                $tosign_count = count($send->tosign);
                $outputs = '';
                for($i = 0; $i < $tosign_count; $i++)
                {
                    $tosign = $send->tosign[$i];
                    $output = exec($dir."btcutils/signer/signer $tosign $privatekey 2>&1");
                    $outputs .= '"'.trim($output).'",';
                }
                $outputs = trim($outputs, ", ");
                $tx = $data.', "signatures" : ['.$outputs.' ] } ';
                $data = self::sendTransaction($tx);
                
                if($data->error){
                    return 'Transaction failed';
                } elseif($data->tx){
                $hash = $data->tx->hash;
                $total = $this->weitoeth($data->tx->total);
                $fees = $this->weitoeth($data->tx->fees);    

                $ethTransaction = new EthAdminTransaction;
                $ethTransaction->uid = \Auth::id();
                $ethTransaction->recipient = $to_addr;
                $ethTransaction->sender = $from_addr;
                $ethTransaction->amount = $total;
                $ethTransaction->fees = $fees;
                $ethTransaction->confrim = 0;
                $ethTransaction->txnid = $hash;
                if($ethTransaction->save())
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        }
       
    }

    function wei($amount){
        return number_format((1000000000000000000 * $amount), 0,'.','');
    }

    function weitoeth($amount){
        return $amount / 1000000000000000000;
    }

    function createDashUserTransaction($toaddress, $fromaddress, $amount)
    {
        $tokenblock = env('ETH_TOKEN_BLOCK');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.blockcypher.com/v1/ltc/main/txs/new?token=$tokenblock");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"inputs\":[{\"addresses\": [\"$fromaddress\"]}],\"outputs\":[{\"addresses\": [\"$toaddress\"], \"value\": $amount}], \"gas_limit\" : 21000, \"gas_price\" : 20000000000 }");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $send = json_decode($result);

        //dd($send['error']);

        if ($send['errors'])
        {
            return Redirect::back()->with('fail', 'Something went wrong!!!');  
        } 
        elseif ($send['error'])
        {
            return Redirect::back()->with('fail', $send['error']);  
        } 
        elseif (!empty($send->tx))
        {
            $f_address = $fromaddress;
            $t_address = $toaddress;


            $from_addr = Crypt::encryptString($f_address);
            $to_addr = Crypt::encryptString($t_address);

            $private = Userdashaddress::where('address', $from_addr)->first();

            if($private){
                
                $privatekey = Crypt::decryptString($private->private_key);
                $data = rtrim($result,"}");

                $tosign_count = count($send->tosign);
                $outputs = '';
                for($i = 0; $i < $tosign_count; $i++)
                {
                    $tosign = $send->tosign[$i];
                    $output = exec($dir."btcutils/signer/signer $tosign $privatekey 2>&1");
                    $outputs .= '"'.trim($output).'",';
                }
                $outputs = trim($outputs, ", ");
                $tx = $data.', "signatures" : ['.$outputs.' ] } ';
                $data = self::sendTransaction($tx);
                
                if($data->error){
                    return 'Transaction failed';
                } elseif($data->tx){
                $hash = $data->tx->hash;
                $total = $this->weitoeth($data->tx->total);
                $fees = $this->weitoeth($data->tx->fees);    

                $ltcTransaction = new UserDashTransaction;
                $ltcTransaction->uid = \Auth::id();
                $ltcTransaction->recipient = $to_addr;
                $ltcTransaction->sender = $from_addr;
                $ltcTransaction->amount = $total;
                $ltcTransaction->fees = $fees;
                $ltcTransaction->confrim = 0;
                $ltcTransaction->txnid = $hash;
                if($ltcTransaction->save())
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        }
       
    }


     function creataDashAdminTransaction($toaddress, $fromaddress, $amount)
    {
        $tokenblock = env('ETH_TOKEN_BLOCK');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.blockcypher.com/v1/ltc/main/txs/new?token=$tokenblock");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"inputs\":[{\"addresses\": [\"$fromaddress\"]}],\"outputs\":[{\"addresses\": [\"$toaddress\"], \"value\": $amount}], \"gas_limit\" : 21000, \"gas_price\" : 20000000000 }");
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $send = json_decode($result);

        //dd($send->errors[0]);

        if ($send['errors'][0])
        {

            return Redirect::back()->with('fail', 'Something went problem !!!');  
        } 
        elseif ($send['error'])
        {
            return Redirect::back()->with('fail', $send['error']);  
        } 
        elseif (!empty($send->tx))
        {
            $f_address = $fromaddress;
            $t_address = $toaddress;


            $from_addr = Crypt::encryptString($f_address);
            $to_addr = Crypt::encryptString($t_address);

            $private = DashAdminAddress::where('address', $from_addr)->first();

            if($private){
                
                $privatekey = Crypt::decryptString($private->private_key);
                $data = rtrim($result,"}");

                $tosign_count = count($send->tosign);
                $outputs = '';
                for($i = 0; $i < $tosign_count; $i++)
                {
                    $tosign = $send->tosign[$i];
                    $output = exec($dir."btcutils/signer/signer $tosign $privatekey 2>&1");
                    $outputs .= '"'.trim($output).'",';
                }
                $outputs = trim($outputs, ", ");
                $tx = $data.', "signatures" : ['.$outputs.' ] } ';
                $data = self::sendTransaction($tx);
                
                if($data->error){
                    return 'Transaction failed';
                } elseif($data->tx){
                $hash = $data->tx->hash;
                $total = $this->weitoeth($data->tx->total);
                $fees = $this->weitoeth($data->tx->fees);    

                $ethTransaction = new DashAdminTransaction;
                $ethTransaction->uid = \Auth::id();
                $ethTransaction->recipient = $to_addr;
                $ethTransaction->sender = $from_addr;
                $ethTransaction->amount = $total;
                $ethTransaction->fees = $fees;
                $ethTransaction->confrim = 0;
                $ethTransaction->txnid = $hash;
                if($ethTransaction->save())
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        }
       
    }

    function userAvailBalance($uid, $currency){
        $select = array('user_id' => $uid, '' => $currency);
        $set = UserWallet::where($select)->first();
        $set->balance;
       return $set->balance;
    }


     function cancelBtcUserTrade($uid, $amount, $option=NULL)
     {
        $balance = json_decode($this->userAvailBalance($uid), 'BTC');
        dd($balance);
        $real = $balance->btc;
        if($option == 'debit'){
            $main = $real - $amount;
            $update = array(
                'balance'   => $main
            );
             $action=UserWallet::where(['user_id' => $uid])->update($update);
            }else{
            $main = $real + $amount;
            $update = array(
                'balance'   => $main
            );
            $action = UserWallet::where(['user_id' => $uid])->update($update);
        }
        return true;
    }

     function cancelEthUserTrade($uid, $amount, $option=NULL)
     {
        $balance = json_decode($this->userAvailBalance($uid));
        $real = $balance->btc;
        if($option == 'debit'){
            $main = $real - $amount;
            $update = array(
                'eth_mathipu'   => $main
            );
             $action = UserWallet::where(['user_id' => $uid])->update($update);
            }else{
            $main = $real + $amount;
            $update = array(
                'eth_mathipu'   => $main
            );
            $action = UserWallet::where(['user_id' => $uid])->update($update);
        }
        return true;
    }
    
    
 }