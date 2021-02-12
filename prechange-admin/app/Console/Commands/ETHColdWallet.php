<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use App\Traits\EthClass;

class ETHColdWallet extends Command
{
     use EthClass;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coldwallet:eth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move ETH balance to admin cold wallet';

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
        $trans = CryptoTransactions::where(['nirvaki_nilai' => 0,'currency' => 'ETH'])->get();
        if(count($trans) > 0){
            foreach ($trans as $tran) {
                $uid    = $tran->uid;
                $amount = $tran->amount;
                $amount = 0.000564066;
                $fee    = 0.00042;
                $total  = ncSub($amount,$fee,8);
                $send   = $this->createUserEthTransaction($uid,$total);
                if($send){
                    CryptoTransactions::where(['id'=> $tran->id])->update(['nirvaki_nilai' => 100, 'updated_at' => date('Y-m-d H:i:s',time())]);
                }
            }
        }
        $this->info('ETH cold wallet updated to All Users');
    }
}
