<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserEthAddress;
use App\Models\CryptoTransactions;


class BalanceETHUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:eth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update ETH transaction for logged Users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {           
         
            $useraddress = UserEthAddress::get();

        if(count($useraddress) > 0){            
        foreach ($useraddress as $user) {
            $uid = $user->user_id;
            $useraddress = $user->address;
            if($useraddress){        
                $url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$useraddress."&startblock=0&endblock=99999999&sort=asc&apikey=CCUH3GDDJXE6CGYWU8XK1VAZI652YWIYRS";
                $balance = $this->cUrlss($url);
                $count = count($balance['result']);
                if($count > 0)
                {
                   $result_data = $balance['result'];
                    for($i = 0; $i < $count; $i++)
                    {
                        $data     = $result_data[$i];
                        $txid     = $data['hash'];
                        $confirm  = $data['confirmations'];
                        $from     = $data['from'];
                        $to       = $data['to'];               
                        $time     = date('Y-m-d H:i:s',$data['timeStamp']);               
                        $total    = self::weitoeth($data['value']);
                        $total = str_replace(',','',$total);
                        $total = (float)$total;
                        $order_no = TransactionString().$uid;
                        $amount   = ncMul($total,1,8);
                        if($to == $useraddress){
                            CryptoTransactions::createTransaction($uid,'ETH',$txid,$from,$to,$amount,$confirm,$time);
                        }
                    }
                }
            }
        }
    } 

        $this->info('ETH transaction updated to All Users');
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
    public function wei($amount){
        return number_format((1000000000000000000 * $amount), 0,'.','');
    }

    public function weitoeth($amount){
        return $amount / 1000000000000000000;
    }
}
