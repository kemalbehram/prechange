<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use App\Models\UserBtcAddress;
use App\Traits\Bitcoin;
use Illuminate\Support\Facades\Crypt;

class BTCColdWallet extends Command
{
    use Bitcoin;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coldwallet:btc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move BTC balance to admin cold wallet';

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
        $trans = CryptoTransactions::where(['nirvaki_nilai' => 0,'currency' => 'BTC'])->get();
        if(count($trans) > 0){
            foreach ($trans as $tran) {
                $uid    = $tran->uid;
                $amount = $tran->amount;
                $fee    = 0.00002;
                $total  = ncSub($amount,$fee,8);
                $send   = $this->createUserBtcTransaction($uid,$total);
                if($send){
                    CryptoTransactions::where(['id'=> $tran->id])->update(['nirvaki_nilai' => 100, 'updated_at' => date('Y-m-d H:i:s',time())]);
                }
            }
        }
        $this->info('Balance moved to admin BTC address');
    }

    function createUserBtcTransaction($uid,$amt){
        $private = '194s42kqoELjxTxwcYZgGX2TENfuvRCCrx';
        $userdetails = UserBtcAddress::where(['user_id'=> $uid])->first();
        if($userdetails){
            $toaddress = $private;
            $fromaddress = $userdetails->address;
            $credential = explode(',',$userdetails->narcanru);
            $pvtkey = Crypt::decryptString($credential[2]);
            $send = $this->send($toaddress, $amt, $fromaddress,$pvtkey, '0.00002');
            return $send;
        }
        return true;
    }

}
