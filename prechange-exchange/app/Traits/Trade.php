<?php 
namespace App\Traits;
use Blockchain\Btc\Facades\Blockchain;
use App\Traits\BlockchainCredentials;
use App\Selltrade;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\CompleteTrade;
use App\TranstableBtc;
//use App\Traits\UserInfo;
use App\TranstableLtc;
use App\TranstableEth;
use App\Buytrade;


trait Trade {
  
  //use UserInfo;

    function buyBtcLtcProcess($pair, $insertid, $amount, $volume)
    {

                            $needed     = $volume;
                            $admins_addres = $this->ltcAdminAddress();
                            $admins_address = $admins_addres->address;

                            $admins_addres_btc = $this->btcAdminaddress();
                            $admins_address_btc = $admins_addres_btc->address;

                            $uid        = \Auth::id();    
                            $user_address_ltc = $this->getUserLtcAddress($uid);
                            $user_address_btc = $this->getUserBtcAddress($uid);
                            $actualbal  = $this->getUserBtcBalance();
                            $Ttl_BTC    = bcmul($volume,$amount,8);

            

                             $trades =  \DB::select("SELECT * FROM `selltrade` WHERE `uid` != ".\Auth::id()."  AND `remaining` != 0 AND (`price` = ".$amount." OR (`stop_limit` >= ".$amount." AND `price` <= ".$amount.")) ORDER BY price DESC");


                            // $trade = json_decode($myClass->dbSelectAll(SELL_TRADE_BTCETH." WHERE uid!=$uid  AND remaining!=0  AND (amount=$amount OR (stop_limit >= $amount AND amount <= $amount))",'ORDER BY amount DESC'));
                            if(count($trades) > 0){
                                foreach($trades as $cal_amount){
                                    $buy_price = $amount;
                                    $close_price = $amount;
                                    $start_volume = $cal_amount->remaining;
                                    $needed = $needed;
                                    if($start_volume >= $needed AND $needed!=0)
                                    {
                                        $salesAmount = bcmul($needed , $buy_price,8);


                                         $insert = new CompleteTrade;
                                           $insert->pair = $pair;
                                           $insert->order_type = 1;
                                           $insert->buy_id = $insertid;
                                           $insert->sales_id = $cal_amount->id;
                                           $insert->quantity = $needed;
                                           $insert->amount = $salesAmount;
                                           $insert->market_price = $close_price;
                                           $insert->save();
                                        
                                        $limit_ltc      = $needed;
                                        $limit_userid   = $cal_amount->uid;
                                        
                                        // update selltrade 
                                        $close_remain = bcsub($cal_amount->remaining, $needed, 8);
                                        $seller_address_org = $this->getUserLtcAddress($limit_userid);
                                        if($close_remain == 0)
                                        {

                                               $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                              $updatedata->remaining = $close_remain;
                                              $updatedata->status = 1;
                                              $updatedata->save();

                                            $adminCommission_ltc = $this->adminCommissionLtc($cal_amount->volume);
                                            $totalLtc = bcadd(bcadd($adminCommission_ltc , $limit_ltc ,8), 0.0001,8);
                                            //BTC SEND
                                            //seller address 
                                            
                                           $sended_LTC = new TranstableLtc;
                                           $sended_LTC->fromaddr = $seller_address_org;
                                           $sended_LTC->toaddr = $user_address_ltc;
                                           $sended_LTC->addminaddr = $admins_address;
                                           $sended_LTC->amount1 = $limit_ltc;
                                           $sended_LTC->amount2 = $adminCommission_ltc;
                                           $sended_LTC->status = 0;
                                           $sended_LTC->save();

                                            
                                            //LTC SEND
                                            //buyer address
                                            $from_address_org = $this->getUserBtcAddress($uid);
                                            $to_address_org = $this->getUserBtcAddress($limit_userid);
                                            $AmtRelased_BTC = bcmul($cal_amount->volume , $buy_price,8);
                                            $adminCommission_btc = $this->adminCommissionLtc($AmtRelased_BTC);

                                           $sendedBtc = new TranstableBtc;
                                           $sendedBtc->fromaddr = $from_address_org;
                                           $sendedBtc->toaddr = $to_address_org;
                                           $sendedBtc->addminaddr = $admins_addres_btc;
                                           $sendedBtc->amount1 = $AmtRelased_BTC;
                                           $sendedBtc->amount2 = $adminCommission_btc;
                                           $sendedBtc->status = 0;
                                           $sendedBtc->save();

                                        } 
                                        else 
                                        {

                                              $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                              $updatedata->remaining = $close_remain;
                                              $updatedata->save();
                                            
                                            $totalBtc = bcadd($limit_ltc , 0.0001,8);
                                            //$myClass->userbalanceupdatebtc($limit_userid,$totalBtc,'debit');
                                            //BTC SEND
                                          
                                           $sended_LTC = new TranstableLtc;
                                           $sended_LTC->fromaddr = $seller_address_org;
                                           $sended_LTC->toaddr = $user_address_ltc;
                                           $sended_LTC->addminaddr = '';
                                           $sended_LTC->amount1 = $limit_ltc;
                                           $sended_LTC->amount2 = 0;
                                           $sended_LTC->status = 0;
                                           $sended_LTC->save();


                                            //BTC SEND
                                            $from_address_org = $this->getUserBtcAddress($uid);
                                            $to_address_org = $this->getUserBtcAddress($limit_userid);
                                            $AmtRelased_BTC = bcmul($limit_ltc , $buy_price,8);

                                            // $insert = array(
                                            //     'fromaddr' => $myClass->encrypt($from_address_org, $setkey, $iv),
                                            //     'toaddr' => $myClass->encrypt($to_address_org, $setkey, $iv),
                                            //     'addminaddr' => '',
                                            //     'amount1' => $AmtRelased_LTC,
                                            //     'amount2' => 0,
                                            //     'status' => 0
                                            // );
                                            // $sended_LTC = $myClass->dbInsert(TRANSTABLE_ETH, $insert);

                                            $sendedBtc = new TranstableBtc;
                                           $sendedBtc->fromaddr = $from_address_org;
                                           $sendedBtc->toaddr = $to_address_org;
                                           $sendedBtc->addminaddr = '';
                                           $sendedBtc->amount1 = $AmtRelased_BTC;
                                           $sendedBtc->amount2 = 0;
                                           $sendedBtc->status = 0;
                                           $sendedBtc->save();
                                            
                                        }
                                        
                                        // $where = array('id' => $cal_amount->id);
                                        // $updatedata = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, $update1, $where);

                                     

                                        $limitcomplete = Buytrade::where('id', $cal_amount->id)->first();
                                        $limitcomplete->remaining = 0;
                                        $limitcomplete->remaining = 1;
                                        $limitcomplete->save();

                                        // $limitcomplete = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, array('remaining' => 0, 'status' => 1), array('id' => $insertid));
                                        
                                        $remaining  = $needed - $needed;



                                    }
                                    else if($start_volume < $needed AND $needed!=0) 
                                    {
                                        $remaining = bcsub($needed , $start_volume, 8);
                                        $buyAmount = bcmul($cal_amount->remaining , $buy_price,8);
                                        // $insert = array(
                                        //     'buy_id'    => $insertid,
                                        //     'sales_id'  => $cal_amount->id,
                                        //     'quantity'  => $cal_amount->remaining,
                                        //     'amount'    => $buyAmount,
                                        //     'market_price'  => $close_price,
                                        //     'created'   => date('Y-m-d H:i:s', time())
                                        // );
                                        // $insert         = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                                        $insert = new CompleteTrade;
                                        $insert->buy_id = $insertid;
                                        $insert->sales_id = $cal_amount->id;
                                        $insert->quantity = $cal_amount->remaining;
                                        $insert->amount = $buyAmount;
                                        $insert->market_price = $close_price;
                                        $insert->save();


                                        // $update         = array('remaining' => 0, 'status' => 1);
                                        // $where          = array('id' => $cal_amount->id);

                                        // $updatedata     = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, $update, $where);

                                        $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                        $updatedata->remaining = 0;
                                        $updatedata->status = 1;
                                        $updatedata->save();


                                        // $limitcomplete = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, array('remaining' => $remaining), array('id' => $insertid));

                                         $limitcomplete = Buytrade::where('id', $insertid)->first();
                                        $limitcomplete->remaining = $remaining;
                                        $limitcomplete->save();

                                       $limit_userid   = $cal_amount->uid;
                                        $limit_ltc      = $cal_amount->remaining;
                                        $seller_address_org = $this->getUserLtcAddress($limit_userid);
                                        $adminCommission = $this->adminCommissionLtc($cal_amount->volume);
                                        $totalLtc = bcadd(bcadd($adminCommission , $limit_ltc, 8) , 0.0001, 8);
                                        //$myClass->userbalanceupdatebtc($limit_userid,$totalBtc,'debit');
                                        //BTC SEND
                                        // $insert_BTC = array(
                                        //         'fromaddr' => $myClass->encrypt($seller_address_org, $setkey, $iv),
                                        //         'toaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                                        //         'addminaddr' => $myClass->encrypt($admins_address, $setkey, $iv),
                                        //         'amount1' => $limit_btc,
                                        //         'amount2' => $adminCommission,
                                        //         'status' => 0
                                        //     );
                                        // $sended_BTC = $myClass->dbInsert(TRANSTABLE_BTC, $insert_BTC);


                                           $insert_LTC = new TranstableLtc;
                                           $insert_LTC->fromaddr = $seller_address_org;
                                           $insert_LTC->toaddr = $user_address_ltc;
                                           $insert_LTC->addminaddr = $admins_address;
                                           $insert_LTC->amount1 = $limit_ltc;
                                           $insert_LTC->amount2 = $adminCommission;
                                           $insert_LTC->status = 0;
                                           $insert_LTC->save();


                                        //LTC SEND
                                        $from_address_org = $this->getUserBtcAddress($uid);
                                        $to_address_org = $this->getUserBtcAddress($limit_userid);
                                        $AmtRelased_BTC = bcmul($limit_ltc , $buy_price,8);
                                        $adminCommission_btc = $this->adminCommissionBtc($AmtRelased_BTC);
                                        
                                        // $insert_ETH = array(
                                        //         'fromaddr' => $myClass->encrypt($from_address_org, $setkey, $iv),
                                        //         'toaddr' => $myClass->encrypt($to_address_org, $setkey, $iv),
                                        //         'addminaddr' => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                                        //         'amount1' => $AmtRelased_LTC,
                                        //         'amount2' => $adminCommission_ltc,
                                        //         'status' => 0
                                        //     );
                                        // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_ETH);

                                        $sended_BTC = new TranstableBtc;
                                           $sended_BTC->fromaddr = $from_address_org;
                                           $sended_BTC->toaddr = $to_address_org;
                                           $sended_BTC->addminaddr = $admins_address_ltc;
                                           $sended_BTC->amount1 = $AmtRelased_BTC;
                                           $sended_BTC->amount2 = $adminCommission_btc;
                                           $sended_BTC->status = 0;
                                           $sended_BTC->save();
                                        
                                        //$remaining    = $needed - $cal_amount->remaining;
                                    }
                                    $needed = $remaining;
                                       $status = 0;
                                    if($needed == 0){
                                       $status = 1;
                                    } 
                                      $limitcomplete = Buytrade::where('id', $insertid)->first();
                                        $limitcomplete->remaining = $needed;
                                        $limitcomplete->status = $status;
                                        $limitcomplete->save();
  
                                }                                    
                                    
                            }                    

                                             

    }



    function buyBtcEthProcess($pair, $insertid, $amount, $volume)
    {

                            $needed     = $volume;
                            $admins_addres = $this->btcAdminAddress();
                            $admins_address = $admins_addres->address;

                            $admins_addres_eth = $this->ethAdminaddress();
                            $admins_address_eth = $admins_addres_eth->address;

                            $uid        = \Auth::id();    
                            $user_address_btc = $this->getUserBtcAddress($uid);
                            $user_address_eth = $this->getUserEthAddress($uid);
                            $actualbal  = $this->getUserEthBalance();
                            $Ttl_ETH    = bcmul($volume,$amount,8);

            

                             $trades =  \DB::select("SELECT * FROM `selltrade` WHERE `uid` != ".\Auth::id()."  AND `remaining` != 0 AND (`price` = ".$amount." OR (`stop_limit` >= ".$amount." AND `price` <= ".$amount.")) ORDER BY price DESC");


                            // $trade = json_decode($myClass->dbSelectAll(SELL_TRADE_BTCETH." WHERE uid!=$uid  AND remaining!=0  AND (amount=$amount OR (stop_limit >= $amount AND amount <= $amount))",'ORDER BY amount DESC'));
                            if(count($trades) > 0){
                                foreach($trades as $cal_amount){
                                    $buy_price = $amount;
                                    $close_price = $amount;
                                    $start_volume = $cal_amount->remaining;
                                    $needed = $needed;
                                    if($start_volume >= $needed AND $needed!=0)
                                    {
                                        $salesAmount = bcmul($needed , $buy_price,8);


                                         $insert = new CompleteTrade;
                                           $insert->pair = $pair;
                                           $insert->order_type = 1;
                                           $insert->buy_id = $insertid;
                                           $insert->sales_id = $cal_amount->id;
                                           $insert->quantity = $needed;
                                           $insert->amount = $salesAmount;
                                           $insert->market_price = $close_price;
                                           $insert->save();
                                        
                                        $limit_btc      = $needed;
                                        $limit_userid   = $cal_amount->uid;
                                        
                                        // update selltrade 
                                        $close_remain = bcsub($cal_amount->remaining, $needed, 8);
                                        $seller_address_org = $this->getUserBtcAddress($limit_userid);
                                        if($close_remain == 0)
                                        {

                                               $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                              $updatedata->remaining = $close_remain;
                                              $updatedata->status = 1;
                                              $updatedata->save();

                                            $adminCommission_btc = $this->adminCommissionBtc($cal_amount->volume);
                                            $totalBtc = bcadd(bcadd($adminCommission_btc , $limit_btc ,8), 0.0001,8);
                                            //BTC SEND
                                            //seller address 
                                            
                                           $sended_BTC = new TranstableBtc;
                                           $sended_BTC->fromaddr = $seller_address_org;
                                           $sended_BTC->toaddr = $user_address_btc;
                                           $sended_BTC->addminaddr = $admins_address;
                                           $sended_BTC->amount1 = $limit_btc;
                                           $sended_BTC->amount2 = $adminCommission_btc;
                                           $sended_BTC->status = 0;
                                           $sended_BTC->save();

                                            
                                            //LTC SEND
                                            //buyer address
                                            $from_address_org = $this->getUserLtcAddress($uid);
                                            $to_address_org = $this->getUserEthAddress($limit_userid);
                                            $AmtRelased_ETH = bcmul($cal_amount->volume , $buy_price,8);
                                            $adminCommission_eth = $this->adminCommissionLtc($AmtRelased_ETH);

                                           $sendedEth = new TranstableEth;
                                           $sendedEth->fromaddr = $from_address_org;
                                           $sendedEth->toaddr = $to_address_org;
                                           $sendedEth->addminaddr = $admins_addres_eth;
                                           $sendedEth->amount1 = $AmtRelased_Eth;
                                           $sendedEth->amount2 = $adminCommission_eth;
                                           $sendedEth->status = 0;
                                           $sendedEth->save();

                                        } 
                                        else 
                                        {

                                              $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                              $updatedata->remaining = $close_remain;
                                              $updatedata->save();
                                            
                                            $totalBtc = bcadd($limit_btc , 0.0001,8);
                                            //$myClass->userbalanceupdatebtc($limit_userid,$totalBtc,'debit');
                                            //BTC SEND
                                          
                                           $sended_BTC = new TranstableBtc;
                                           $sended_BTC->fromaddr = $seller_address_org;
                                           $sended_BTC->toaddr = $user_address_btc;
                                           $sended_BTC->addminaddr = '';
                                           $sended_BTC->amount1 = $limit_btc;
                                           $sended_BTC->amount2 = 0;
                                           $sended_BTC->status = 0;
                                           $sended_BTC->save();


                                            //BTC SEND
                                            $from_address_org = $this->getUserEthAddress($uid);
                                            $to_address_org = $this->getUserEthAddress($limit_userid);
                                            $AmtRelased_Eth = bcmul($limit_btc , $buy_price,8);

                                            // $insert = array(
                                            //     'fromaddr' => $myClass->encrypt($from_address_org, $setkey, $iv),
                                            //     'toaddr' => $myClass->encrypt($to_address_org, $setkey, $iv),
                                            //     'addminaddr' => '',
                                            //     'amount1' => $AmtRelased_LTC,
                                            //     'amount2' => 0,
                                            //     'status' => 0
                                            // );
                                            // $sended_LTC = $myClass->dbInsert(TRANSTABLE_ETH, $insert);

                                            $sendedEth = new TranstableEth;
                                           $sendedEth->fromaddr = $from_address_org;
                                           $sendedEth->toaddr = $to_address_org;
                                           $sendedEth->addminaddr = '';
                                           $sendedEth->amount1 = $AmtRelased_ETH;
                                           $sendedEth->amount2 = 0;
                                           $sendedEth->status = 0;
                                           $sendedEth->save();
                                            
                                        }
                                        
                                        // $where = array('id' => $cal_amount->id);
                                        // $updatedata = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, $update1, $where);

                                     

                                        $limitcomplete = Buytrade::where('id', $cal_amount->id)->first();
                                        $limitcomplete->remaining = 0;
                                        $limitcomplete->remaining = 1;
                                        $limitcomplete->save();

                                        // $limitcomplete = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, array('remaining' => 0, 'status' => 1), array('id' => $insertid));
                                        
                                        $remaining  = $needed - $needed;



                                    }
                                    else if($start_volume < $needed AND $needed!=0) 
                                    {
                                        $remaining = bcsub($needed , $start_volume, 8);
                                        $buyAmount = bcmul($cal_amount->remaining , $buy_price,8);
                                        // $insert = array(
                                        //     'buy_id'    => $insertid,
                                        //     'sales_id'  => $cal_amount->id,
                                        //     'quantity'  => $cal_amount->remaining,
                                        //     'amount'    => $buyAmount,
                                        //     'market_price'  => $close_price,
                                        //     'created'   => date('Y-m-d H:i:s', time())
                                        // );
                                        // $insert         = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                                        $insert = new CompleteTrade;
                                        $insert->buy_id = $insertid;
                                        $insert->sales_id = $cal_amount->id;
                                        $insert->quantity = $cal_amount->remaining;
                                        $insert->amount = $buyAmount;
                                        $insert->market_price = $close_price;
                                        $insert->save();


                                        // $update         = array('remaining' => 0, 'status' => 1);
                                        // $where          = array('id' => $cal_amount->id);

                                        // $updatedata     = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, $update, $where);

                                        $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                        $updatedata->remaining = 0;
                                        $updatedata->status = 1;
                                        $updatedata->save();


                                        // $limitcomplete = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, array('remaining' => $remaining), array('id' => $insertid));

                                         $limitcomplete = Buytrade::where('id', $insertid)->first();
                                        $limitcomplete->remaining = $remaining;
                                        $limitcomplete->save();

                                       $limit_userid   = $cal_amount->uid;
                                        $limit_btc      = $cal_amount->remaining;
                                        $seller_address_org = $this->getUserBtcAddress($limit_userid);
                                        $adminCommission = $this->adminCommissionBtc($cal_amount->volume);
                                        $totalBtc = bcadd(bcadd($adminCommission , $limit_btc, 8) , 0.0001, 8);
                                        //$myClass->userbalanceupdatebtc($limit_userid,$totalBtc,'debit');
                                        //BTC SEND
                                        // $insert_BTC = array(
                                        //         'fromaddr' => $myClass->encrypt($seller_address_org, $setkey, $iv),
                                        //         'toaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                                        //         'addminaddr' => $myClass->encrypt($admins_address, $setkey, $iv),
                                        //         'amount1' => $limit_btc,
                                        //         'amount2' => $adminCommission,
                                        //         'status' => 0
                                        //     );
                                        // $sended_BTC = $myClass->dbInsert(TRANSTABLE_BTC, $insert_BTC);


                                           $insert_BTC = new TranstableBtc;
                                           $insert_BTC->fromaddr = $seller_address_org;
                                           $insert_BTC->toaddr = $user_address_btc;
                                           $insert_BTC->addminaddr = $admins_address;
                                           $insert_BTC->amount1 = $limit_btc;
                                           $insert_BTC->amount2 = $adminCommission;
                                           $insert_BTC->status = 0;
                                           $insert_BTC->save();


                                        //LTC SEND
                                        $from_address_org = $this->getUserEthAddress($uid);
                                        $to_address_org = $this->getUserEthAddress($limit_userid);
                                        $AmtRelased_LTC = bcmul($limit_btc , $buy_price,8);
                                        $adminCommission_eth = $this->adminCommissionBtc($AmtRelased_LTC);
                                        
                                        // $insert_ETH = array(
                                        //         'fromaddr' => $myClass->encrypt($from_address_org, $setkey, $iv),
                                        //         'toaddr' => $myClass->encrypt($to_address_org, $setkey, $iv),
                                        //         'addminaddr' => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                                        //         'amount1' => $AmtRelased_LTC,
                                        //         'amount2' => $adminCommission_ltc,
                                        //         'status' => 0
                                        //     );
                                        // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_ETH);

                                        $sended_Eth = new TranstableEth;
                                           $sended_Eth->fromaddr = $from_address_org;
                                           $sended_Eth->toaddr = $to_address_org;
                                           $sended_Eth->addminaddr = $admins_address_btc;
                                           $sended_Eth->amount1 = $AmtRelased_ETH;
                                           $sended_Eth->amount2 = $adminCommission_eth;
                                           $sended_Eth->status = 0;
                                           $sended_Eth->save();
                                        
                                        //$remaining    = $needed - $cal_amount->remaining;
                                    }
                                    $needed = $remaining;
                                       $status = 0;
                                    if($needed == 0){
                                       $status = 1;
                                    } 
                                      $limitcomplete = Buytrade::where('id', $insertid)->first();
                                        $limitcomplete->remaining = $needed;
                                        $limitcomplete->status = $status;
                                        $limitcomplete->save();
  
                                }                                    
                                    
                            }                  
                            
    }

    function sellBtcEthProcess($pair, $insertid, $amount, $volume)
    {

            $admins_addres = $this->ethAdminaddress();
            $admins_address = $admins_addres->address;
            $admins_addres_btc = $this->btcAdminAddress();
            $admins_address_btc = $admins_addres_btc->address;
            $user_address_eth = $this->getUserEthAddress(\Auth::id());
            $user_address_btc = $this->getUserBtcAddress(\Auth::id());
            //dd($user_address_btc);

            // $trade = json_decode($myClass->dbSelectAll(SELL_TRADE_BTCETH." WHERE uid!=$uid  AND remaining!=0 AND (amount=$amount OR (stop_limit <= $amount AND amount >= $amount))",'ORDER BY amount ASC'));


            //dd($amount);


             $trades =  \DB::select("SELECT * FROM `buytrade` WHERE `uid` != ".\Auth::id()."  AND `remaining` != 0 AND (`price` = ".$amount." OR (`stop_limit` <= ".$amount." AND `price` >= ".$amount."))");

            //dd(count($trades));
            if(count($trades) > 0){         
            $recipients = array();
              foreach($trades as $cal_amount){
                $limit_userid = $cal_amount->uid;
              $buyer_address_org = $this->getUserBtcAddress($cal_amount->uid);
              //dd($buyer_address_org);
              $start_volume = $cal_amount->remaining;
              $start_volume = $start_volume;
              $close_price = $amount;
              $needed = $volume;
              if($start_volume >= $needed AND $needed!=0){
                $salesAmount = $needed;
                $salesBtc = bcmul($needed , $close_price, 8);         
                // $insert = array(
                //     'buy_id' => $cal_amount->id,
                //     'sales_id' => $insertid,
                //     'quantity' => $needed,
                //     'amount' => $salesBtc,
                //     'market_price'  => $close_price,
                //     'created' => date('Y-m-d H:i:s', time())
                //   );
                // $insert = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                $insert = new CompleteTrade;
                $insert->pair = $pair;
                $insert->order_type = 1;
                $insert->buy_id = $cal_amount->id;
                $insert->sales_id = $insertid;
                $insert->quantity = $needed;
                $insert->amount = $salesBtc;
                $insert->market_price = $close_price;
                $insert->save();

                $close_remain = bcsub($cal_amount->remaining , $needed, 8);
                if($close_remain == 0)
                {

                   $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                    $updatedata->remaining = $close_remain; 
                    $updatedata->status = 1;
                    $updatedata->save();

                   $AmtRelased_BTC = $needed;
                  $adminCommission_btc = $this->adminCommissionBtc($AmtRelased_BTC);

                  $sended = new TranstableBtc;
                  $sended->fromaddr = $user_address_btc;
                  $sended->toaddr = $buyer_address_org;
                  $sended->addminaddr = $admins_address_btc;
                  $sended->amount1 = $needed;
                  $sended->amount2 = $adminCommission_btc;
                  $sended->status = 0;
                  $sended->save();

                //ETH SEND
                //buyer address
                $from_address_org = $this->getUserEthAddress($limit_userid);
                $to_address_org = $this->getUserEthAddress(\Auth::id());

                $AmtRelased_eth = bcmul($needed , $close_price,8);
                $adminCommission_eth = $this->adminCommissionEth($AmtRelased_eth);
                
                // $insert_eth = array(
                //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                //   'amount1'     => $AmtRelased_ETH,
                //   'amount2'     => $adminCommission_eth,
                //   'status'    => 0
                // );
                // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                $sendedEth = new TranstableEth;
                $sendedEth->fromaddr = $from_address_org;
                $sendedEth->toaddr = $to_address_org;
                $sendedEth->addminaddr = $admins_address_btc;
                $sendedEth->amount1 = $AmtRelased_eth;
                $sendedEth->amount2 = $adminCommission_eth;
                $sendedEth->status = 0;
                $sendedEth->save();

                  // $update1 = array('remaining' => $close_remain, 'status' => 1);
                } 
                else 
                {

                   $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                    $updatedata->remaining = $close_remain; 
                    $updatedata->save();

                    $AmtRelased_BTC = $needed;

                $sended = new TranstableBtc;
                $sended->fromaddr = $user_address_btc;
                $sended->toaddr = $buyer_address_org;
                $sended->addminaddr = '';
                $sended->amount1 = $needed;
                $sended->amount2 = 0;
                $sended->status = 0;
                $sended->save();

                //ETH SEND
                //buyer address
                $from_address_org = $this->getUserEthAddress($limit_userid);
                $to_address_org = $this->getUserEthAddress(\Auth::id());

                $AmtRelased_eth = bcmul($needed , $close_price,8);
                
                // $insert_eth = array(
                //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                //   'amount1'     => $AmtRelased_ETH,
                //   'amount2'     => $adminCommission_eth,
                //   'status'    => 0
                // );
                // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                $sendedEth = new TranstableEth;
                $sendedEth->fromaddr = $from_address_org;
                $sendedEth->toaddr = $to_address_org;
                $sendedEth->addminaddr = '';
                $sendedEth->amount1 = $AmtRelased_eth;
                $sendedEth->amount2 = 0;
                $sendedEth->status = 0;
                $sendedEth->save();
                  // $update1 = array('remaining' => $close_remain);
                }
                // $where = array('id' => $cal_amount->id);
                // $updatedata = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, $update1, $where);

                // $limitcomplete = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, array('remaining' => 0, 'status' => 1), array('id' => $insertid));

                 $updatedata = Selltrade::where('id', $insertid)->first();
                    $updatedata->remaining = 0; 
                    $updatedata->status = 1;
                    $updatedata->save();

                
                //BTC SEND
                // $insert = array(
                //     'fromaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                //     'toaddr' => $myClass->encrypt($buyer_address_org, $setkey, $iv),
                //     'addminaddr' => $myClass->encrypt($admins_address, $setkey, $iv),
                //     'amount1' => $needed,
                //     'amount2' => $adminCommission,
                //     'status' => 0
                //   );
                // $sended = $myClass->dbInsert(TRANSTABLE_BTC, $insert);



                
                  
                  //Remaining Updated
                  $remaining = bcsub($needed , $needed);
                
                
              } else if($start_volume < $needed AND $needed!=0){
                $remaining = bcsub($needed , $start_volume, 8);
                $buyAmount = bcmul($cal_amount->remaining , $close_price, 8);
                // $insert = array(
                //   'buy_id'  => $cal_amount->id,
                //   'sales_id'  => $insertid,
                //   'quantity'  => $start_volume,
                //   'amount'  => $buyAmount,
                //   'market_price'  => $close_price,
                //   'created'   => date('Y-m-d H:i:s', time())
                // );
                // $insert = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                $insert = new CompleteTrade;
                $insert->pair = $pair;
                $insert->buy_id = $cal_amount->id;
                $insert->sales_id = $insertid;
                $insert->quantity = $start_volume;
                $insert->amount = $buyAmount;
                $insert->market_price = $close_price;
                $insert->save();


                $limit_userid     = $cal_amount->uid;
                $buyer_address_org  = $this->getUserLtcAddress($limit_userid);
                
                  // $insert = array(
                  //     'fromaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                  //     'toaddr' => $myClass->encrypt($buyer_address_org, $setkey, $iv),
                  //     'addminaddr' => '',
                  //     'amount1' => $start_volume,
                  //     'amount2' => 0,
                  //     'status' => 0
                  //   );
                  // $sended = $myClass->dbInsert(TRANSTABLE_BTC, $insert);

                $sended = new TranstableBtc;
                $sended->fromaddr = Crypt::encryptString($user_address_btc);
                $sended->toaddr = Crypt::encryptString($buyer_address_org);
                $sended->addminaddr = '';
                $sended->amount1 = $start_volume;
                $sended->amount2 = 0;
                $sended->status = 0;
                $sended->save();


                  //Ltc SEND
                  //buyer address
                  $from_address_org = $this->getUserEthAddress($limit_userid);
                  $to_address_org = $this->getUserEthAddress(\Auth::id());
                  $AmtRelased_eth = bcmul($start_volume , $close_price,8);
                  $adminCommission_eth = $this->adminCommissionLtc($AmtRelased_eth);
                  // $insert_eth = array(
                  //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                  //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                  //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                  //   'amount1'     => $AmtRelased_ETH,
                  //   'amount2'     => $adminCommission_eth,
                  //   'status'    => 0
                  // );
                  // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                  $sendedEth = new TranstableEth;
                  $sendedEth->fromaddr = Crypt::encryptString($from_address_org);
                  $sendedEth->toaddr = Crypt::encryptString($to_address_org);
                  $sendedEth->addminaddr = Crypt::encryptString($admins_address_eth);
                  $sendedEth->amount1 = $AmtRelased_eth;
                  $sendedEth->amount2 = $adminCommission_eth;
                  $sendedEth->status = 0;
                  $sendedEth->save();

                   $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                    $updatedata->remaining = 0; 
                    $updatedata->status = 1;
                    $updatedata->save();
                  

                   $updatedata = Selltrade::where('id', $insertid)->first();
                    $updatedata->remaining =  $remaining; 
                    $updatedata->status = 0;
                    $updatedata->save();

                 
              }
              $needed = $remaining;
                              
              }
            }


    }

    function sellBtcLtcProcess($pair, $insertid, $amount, $volume)
    {
            $admins_addres = $this->btcAdminaddress();
            $admins_address = Crypt::decryptString($admins_addres->address);
            $admins_addres_ltc = $this->ltcAdminAddress();
            $admins_address_ltc = Crypt::decryptString($admins_addres_ltc->address);
            $user_address_btc = $this->getUserBtcAddress(\Auth::id());
            $user_address_ltc = $this->getUserLtcAddress(\Auth::id());
            //dd($user_address_btc);

            // $trade = json_decode($myClass->dbSelectAll(SELL_TRADE_BTCETH." WHERE uid!=$uid  AND remaining!=0 AND (amount=$amount OR (stop_limit <= $amount AND amount >= $amount))",'ORDER BY amount ASC'));


            //dd($amount);


             $trades =  \DB::select("SELECT * FROM `buytrade` WHERE `uid` != ".\Auth::id()."  AND `remaining` != 0 AND (`price` = ".$amount." OR (`stop_limit` <= ".$amount." AND `price` >= ".$amount."))");

            //dd(count($trades));
            if(count($trades) > 0){ 
            //dd('check');        
            $recipients = array();
              foreach($trades as $cal_amount){
                $limit_userid = $cal_amount->uid;
              $buyer_address_org = $this->getUserLtcAddress($cal_amount->uid);
              //dd($buyer_address_org);
              $start_volume = $cal_amount->remaining;
              $start_volume = $start_volume;
              $close_price = $amount;
              $needed = $volume;
              if($start_volume >= $needed AND $needed!=0){
               // dd('1111');
                $salesAmount = $needed;
                $salesBtc = bcmul($needed , $close_price, 8);         
                // $insert = array(
                //     'buy_id' => $cal_amount->id,
                //     'sales_id' => $insertid,
                //     'quantity' => $needed,
                //     'amount' => $salesBtc,
                //     'market_price'  => $close_price,
                //     'created' => date('Y-m-d H:i:s', time())
                //   );
                // $insert = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                $insert = new CompleteTrade;
                $insert->pair = $pair;
                $insert->order_type = 1;
                $insert->buy_id = $cal_amount->id;
                $insert->sales_id = $insertid;
                $insert->quantity = $needed;
                $insert->amount = $salesBtc;
                $insert->market_price = $close_price;
                $insert->save();

                $close_remain = bcsub($cal_amount->remaining , $needed, 8);
                if($close_remain == 0)
                {

                   $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                    $updatedata->remaining = $close_remain; 
                    $updatedata->status = 1;
                    $updatedata->save();

                   $AmtRelased_LTC = $needed;
                  $adminCommission_ltc = $this->adminCommissionLtc($AmtRelased_LTC);

                  $sended = new TranstableLtc;
                  $sended->fromaddr = $user_address_ltc;
                  $sended->toaddr = $buyer_address_org;
                  $sended->addminaddr = $admins_address_ltc;
                  $sended->amount1 = $needed;
                  $sended->amount2 = $adminCommission_ltc;
                  $sended->status = 0;
                  $sended->save();

                //ETH SEND
                //buyer address
                $from_address_org = $this->getUserBtcAddress($limit_userid);
                $to_address_org = $this->getUserBtcAddress(\Auth::id());

                $AmtRelased_btc = bcmul($needed , $close_price,8);
                $adminCommission_btc = $this->adminCommissionBtc($AmtRelased_btc);
                
                // $insert_eth = array(
                //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                //   'amount1'     => $AmtRelased_ETH,
                //   'amount2'     => $adminCommission_eth,
                //   'status'    => 0
                // );
                // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                $sendedLtc = new TranstableBtc;
                $sendedLtc->fromaddr = $from_address_org;
                $sendedLtc->toaddr = $to_address_org;
                $sendedLtc->addminaddr = $admins_address_ltc;
                $sendedLtc->amount1 = $AmtRelased_btc;
                $sendedLtc->amount2 = $adminCommission_btc;
                $sendedLtc->status = 0;
                $sendedLtc->save();

                  // $update1 = array('remaining' => $close_remain, 'status' => 1);
                } 
                else 
                {

                   $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                    $updatedata->remaining = $close_remain; 
                    $updatedata->save();

                           $AmtRelased_LTC = $needed;

                $sended = new TranstableLtc;
                $sended->fromaddr = $user_address_ltc;
                $sended->toaddr = $buyer_address_org;
                $sended->addminaddr = '';
                $sended->amount1 = $needed;
                $sended->amount2 = 0;
                $sended->status = 0;
                $sended->save();

                //ETH SEND
                //buyer address
                $from_address_org = $this->getUserBtcAddress($limit_userid);
                $to_address_org = $this->getUserBtcAddress(\Auth::id());

                $AmtRelased_btc = bcmul($needed , $close_price,8);
                
                // $insert_eth = array(
                //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                //   'amount1'     => $AmtRelased_ETH,
                //   'amount2'     => $adminCommission_eth,
                //   'status'    => 0
                // );
                // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                $sendedLtc = new TranstableBtc;
                $sendedLtc->fromaddr = $from_address_org;
                $sendedLtc->toaddr = $to_address_org;
                $sendedLtc->addminaddr = '';
                $sendedLtc->amount1 = $AmtRelased_btc;
                $sendedLtc->amount2 = 0;
                $sendedLtc->status = 0;
                $sendedLtc->save();
                  // $update1 = array('remaining' => $close_remain);
                }
                // $where = array('id' => $cal_amount->id);
                // $updatedata = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, $update1, $where);

                // $limitcomplete = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, array('remaining' => 0, 'status' => 1), array('id' => $insertid));

                 $updatedata = Selltrade::where('id', $insertid)->first();
                    $updatedata->remaining = 0; 
                    $updatedata->status = 1;
                    $updatedata->save();

                
                //BTC SEND
                // $insert = array(
                //     'fromaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                //     'toaddr' => $myClass->encrypt($buyer_address_org, $setkey, $iv),
                //     'addminaddr' => $myClass->encrypt($admins_address, $setkey, $iv),
                //     'amount1' => $needed,
                //     'amount2' => $adminCommission,
                //     'status' => 0
                //   );
                // $sended = $myClass->dbInsert(TRANSTABLE_BTC, $insert);



                
                  
                  //Remaining Updated
                  $remaining = bcsub($needed , $needed, 8);
                
                
              } else if($start_volume < $needed AND $needed!=0){
               // dd('222');
                $remaining = bcsub($needed , $start_volume, 8);
               // dd($remaining);
                $buyAmount = bcmul($cal_amount->remaining , $close_price, 8);
                // $insert = array(
                //   'buy_id'  => $cal_amount->id,
                //   'sales_id'  => $insertid,
                //   'quantity'  => $start_volume,
                //   'amount'  => $buyAmount,
                //   'market_price'  => $close_price,
                //   'created'   => date('Y-m-d H:i:s', time())
                // );
                // $insert = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                $insert = new CompleteTrade;
                $insert->order_type = 1;
                $insert->pair = $pair;
                $insert->buy_id = $cal_amount->id;
                $insert->sales_id = $insertid;
                $insert->quantity = $start_volume;
                $insert->amount = $buyAmount;
                $insert->market_price = $close_price;
                $insert->save();


                $limit_userid     = $cal_amount->uid;
                $buyer_address_org  = $this->getUserLtcAddress($limit_userid);
                
                  // $insert = array(
                  //     'fromaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                  //     'toaddr' => $myClass->encrypt($buyer_address_org, $setkey, $iv),
                  //     'addminaddr' => '',
                  //     'amount1' => $start_volume,
                  //     'amount2' => 0,
                  //     'status' => 0
                  //   );
                  // $sended = $myClass->dbInsert(TRANSTABLE_BTC, $insert);

                $sended = new TranstableLtc;
                $sended->fromaddr = $user_address_ltc;
                $sended->toaddr = $buyer_address_org;
                $sended->addminaddr = '';
                $sended->amount1 = $start_volume;
                $sended->amount2 = 0;
                $sended->status = 0;
                $sended->save();


                  //Ltc SEND
                  //buyer address
                  $from_address_org = $this->getUserBtcAddress($limit_userid);
                  $to_address_org = $this->getUserBtcAddress(\Auth::id());
                  $AmtRelased_btc = bcmul($start_volume , $close_price,8);
                  $adminCommission_btc = $this->adminCommissionLtc($AmtRelased_btc);
                  // $insert_eth = array(
                  //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                  //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                  //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                  //   'amount1'     => $AmtRelased_ETH,
                  //   'amount2'     => $adminCommission_eth,
                  //   'status'    => 0
                  // );
                  // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                  $sendedLtc = new TranstableBtc;
                  $sendedLtc->fromaddr = $from_address_org;
                  $sendedLtc->toaddr = $to_address_org;
                  $sendedLtc->addminaddr = $admins_address;
                  $sendedLtc->amount1 = $AmtRelased_btc;
                  $sendedLtc->amount2 = $adminCommission_btc;
                  $sendedLtc->status = 0;
                  $sendedLtc->save();

                   $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                    $updatedata->remaining = 0; 
                    $updatedata->status = 1;
                    $updatedata->save();
                  //dd($remaining);

                   $updatedata = Selltrade::where('id', $insertid)->first();
                    $updatedata->remaining =  $remaining; 
                    $updatedata->status = 0;
                    $updatedata->save();

                 
              }
              $needed = $remaining;
                              
              }
            }
            

    }

    function sellcalculateamount($volume, $pair, $fees)
     {
     
      $trade =  \DB::select("SELECT * FROM `selltrade` WHERE `uid` != ".\Auth::id()."  AND order_type = 1 AND `remaining` != 0 AND pair= ".$pair." ORDER BY price ASC");

      $amount = 0;
      $count=1;
      $needed = $volume;
      $remaining ='';
      if($trade){
       foreach($trade->result as $cal_amount){
        $start_volume = $cal_amount->remaining;
        if($start_volume >= $needed AND $needed!=0){
         $amount += bcmul($needed , $cal_amount->amount,8);
         $remaining = bcsub($needed , $needed,8);
        } else if($start_volume < $needed AND $needed!=0) {
         $remaining = bcsub($needed , $start_volume,8);
         $amount += bcmul($start_volume , $cal_amount->amount,8);
        }
        $needed = $remaining;
        $count++;
        if($needed == 0){
         break;
        } 
         
       }
       //$fee= bcmul($fees , $count, 8);
       //$amount = bcadd($amount , $fee, 8);
       return $amount;
      } else {
       return int(0);
      }  
     }
     function calculatecountbuy($volume, $pair)
     {

      $trade =  \DB::select("SELECT * FROM `selltrade` WHERE `uid` != ".\Auth::id()."  AND order_type = 1 AND `remaining` != 0 AND pair= ".$pair." ORDER BY price ASC");

      $count = 0;
      $avail_capacity = 0.00000000; 
      foreach($trade->result as $capacity){
       $avail_capacity+=$capacity->volume;
       if($avail_capacity < $volume){
        $count++;
       } else if($avail_capacity >= $volume) {
        $count = $count + 1;
         break;
       }
      }
      return $count;
     }

    function buyMarketBtcEthProcess($pair, $volume)
    {
                           $admins_addres = $this->btcAdminAddress();
                            $admins_address = $admins_addres->address;

                            $admins_addres_eth = $this->ethAdminaddress();
                            $admins_address_eth = $admins_addres_eth->address;

                            $uid        = \Auth::id();    
                            $user_address_btc = $this->getUserBtcAddress($uid);
                            $user_address_eth = $this->getUserEthAddress($uid);  

                            $actualbal  = $this->getUserEthBalance();
                             $trade =  \DB::select("SELECT * FROM `selltrade` WHERE `uid` != ".\Auth::id()."  AND `remaining` != 0 AND pair= ".$pair." ORDER BY price ASC");

                                //dd($trade);
                           
                            if(count($trade) > 0){


                                $avail_capacity=0;
                                $remaining='';
                                $needed = $volume;
                                
                                foreach($trade as $capacity){
                                  $avail_capacity += $capacity->remaining;
                                }
                                
                                if($avail_capacity >= $volume){

                                   $admins_addres_eth = $this->ethAdminaddress();
                                  $admins_address_eth = Crypt::decryptString($admins_addres_eth->address);



                                  $trade_amount1  = $this->sellcalculateamount($volume, $pair, $fees);
                                  $admin_commission = $this->adminCommissionEth($trade_amount1);
                                  $count = $this->calculatecountbuy($volume, $pair);
                                  $tranfee= $count * $fees;
                                  $trade_amount = $trade_amount1 + $admin_commission + $tranfee;
                                  if($trade_amount <= $actualbal)
                                  {
                                      $buyTrade = new Buytrade;
                                       $buyTrade->uid = Auth::id();
                                       $buyTrade->pair = 4;
                                       $buyTrade->ordertype = 2;
                                       $buyTrade->volume = $request->volume;
                                       $buyTrade->remaining = $request->volume;
                                       $buyTrade->status = 0;
                                       $buyTrade->save(); 
                                       
                                      $insertid = $buyTrade->id;
                                      $recipients = array();

                                      
                                    
        
                                        foreach($trades as $cal_amount){
                                    $buy_price = $amount;
                                    $close_price = $amount;
                                    $start_volume = $cal_amount->remaining;
                                    $needed = $needed;
                                    if($start_volume >= $needed AND $needed!=0)
                                    {
                                        $salesAmount = bcmul($needed , $buy_price,8);


                                         $insert = new CompleteTrade;
                                           $insert->pair = $pair;
                                           $insert->order_type = 1;
                                           $insert->buy_id = $insertid;
                                           $insert->sales_id = $cal_amount->id;
                                           $insert->quantity = $needed;
                                           $insert->amount = $salesAmount;
                                           $insert->market_price = $close_price;
                                           $insert->save();
                                        
                                        $limit_btc      = $needed;
                                        $limit_userid   = $cal_amount->uid;
                                        
                                        // update selltrade 
                                        $close_remain = bcsub($cal_amount->remaining, $needed, 8);
                                        $seller_address_org = $this->getUserBtcAddress($limit_userid);
                                        if($close_remain == 0)
                                        {

                                               $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                              $updatedata->remaining = $close_remain;
                                              $updatedata->status = 1;
                                              $updatedata->save();

                                            $adminCommission_btc = $this->adminCommissionBtc($cal_amount->volume);
                                            $totalBtc = bcadd(bcadd($adminCommission_btc , $limit_btc ,8), 0.0001,8);
                                            //BTC SEND
                                            //seller address 
                                            
                                           $sended_BTC = new TranstableBtc;
                                           $sended_BTC->fromaddr = $seller_address_org;
                                           $sended_BTC->toaddr = $user_address_btc;
                                           $sended_BTC->addminaddr = $admins_address;
                                           $sended_BTC->amount1 = $limit_btc;
                                           $sended_BTC->amount2 = $adminCommission_btc;
                                           $sended_BTC->status = 0;
                                           $sended_BTC->save();

                                            
                                            //LTC SEND
                                            //buyer address
                                            $from_address_org = $this->getUserLtcAddress($uid);
                                            $to_address_org = $this->getUserEthAddress($limit_userid);
                                            $AmtRelased_ETH = bcmul($cal_amount->volume , $buy_price,8);
                                            $adminCommission_eth = $this->adminCommissionLtc($AmtRelased_ETH);

                                           $sendedEth = new TranstableEth;
                                           $sendedEth->fromaddr = $from_address_org;
                                           $sendedEth->toaddr = $to_address_org;
                                           $sendedEth->addminaddr = $admins_addres_eth;
                                           $sendedEth->amount1 = $AmtRelased_Eth;
                                           $sendedEth->amount2 = $adminCommission_eth;
                                           $sendedEth->status = 0;
                                           $sendedEth->save();

                                        } 
                                        else 
                                        {

                                              $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                              $updatedata->remaining = $close_remain;
                                              $updatedata->save();
                                            
                                            $totalBtc = bcadd($limit_btc , 0.0001,8);
                                            //$myClass->userbalanceupdatebtc($limit_userid,$totalBtc,'debit');
                                            //BTC SEND
                                          
                                           $sended_BTC = new TranstableBtc;
                                           $sended_BTC->fromaddr = $seller_address_org;
                                           $sended_BTC->toaddr = $user_address_btc;
                                           $sended_BTC->addminaddr = '';
                                           $sended_BTC->amount1 = $limit_btc;
                                           $sended_BTC->amount2 = 0;
                                           $sended_BTC->status = 0;
                                           $sended_BTC->save();


                                            //BTC SEND
                                            $from_address_org = $this->getUserEthAddress($uid);
                                            $to_address_org = $this->getUserEthAddress($limit_userid);
                                            $AmtRelased_Eth = bcmul($limit_btc , $buy_price,8);

                                            // $insert = array(
                                            //     'fromaddr' => $myClass->encrypt($from_address_org, $setkey, $iv),
                                            //     'toaddr' => $myClass->encrypt($to_address_org, $setkey, $iv),
                                            //     'addminaddr' => '',
                                            //     'amount1' => $AmtRelased_LTC,
                                            //     'amount2' => 0,
                                            //     'status' => 0
                                            // );
                                            // $sended_LTC = $myClass->dbInsert(TRANSTABLE_ETH, $insert);

                                            $sendedEth = new TranstableEth;
                                           $sendedEth->fromaddr = $from_address_org;
                                           $sendedEth->toaddr = $to_address_org;
                                           $sendedEth->addminaddr = '';
                                           $sendedEth->amount1 = $AmtRelased_ETH;
                                           $sendedEth->amount2 = 0;
                                           $sendedEth->status = 0;
                                           $sendedEth->save();
                                            
                                        }
                                        
                                        // $where = array('id' => $cal_amount->id);
                                        // $updatedata = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, $update1, $where);

                                     

                                        $limitcomplete = Buytrade::where('id', $cal_amount->id)->first();
                                        $limitcomplete->remaining = 0;
                                        $limitcomplete->remaining = 1;
                                        $limitcomplete->save();

                                        // $limitcomplete = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, array('remaining' => 0, 'status' => 1), array('id' => $insertid));
                                        
                                        $remaining  = $needed - $needed;



                                    }
                                    else if($start_volume < $needed AND $needed!=0) 
                                    {
                                        $remaining = bcsub($needed , $start_volume, 8);
                                        $buyAmount = bcmul($cal_amount->remaining , $buy_price,8);
                                        // $insert = array(
                                        //     'buy_id'    => $insertid,
                                        //     'sales_id'  => $cal_amount->id,
                                        //     'quantity'  => $cal_amount->remaining,
                                        //     'amount'    => $buyAmount,
                                        //     'market_price'  => $close_price,
                                        //     'created'   => date('Y-m-d H:i:s', time())
                                        // );
                                        // $insert         = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                                        $insert = new CompleteTrade;
                                        $insert->buy_id = $insertid;
                                        $insert->sales_id = $cal_amount->id;
                                        $insert->quantity = $cal_amount->remaining;
                                        $insert->amount = $buyAmount;
                                        $insert->market_price = $close_price;
                                        $insert->save();


                                        // $update         = array('remaining' => 0, 'status' => 1);
                                        // $where          = array('id' => $cal_amount->id);

                                        // $updatedata     = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, $update, $where);

                                        $updatedata = Selltrade::where('id', $cal_amount->id)->first();
                                        $updatedata->remaining = 0;
                                        $updatedata->status = 1;
                                        $updatedata->save();


                                        // $limitcomplete = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, array('remaining' => $remaining), array('id' => $insertid));

                                         $limitcomplete = Buytrade::where('id', $insertid)->first();
                                        $limitcomplete->remaining = $remaining;
                                        $limitcomplete->save();

                                       $limit_userid   = $cal_amount->uid;
                                        $limit_btc      = $cal_amount->remaining;
                                        $seller_address_org = $this->getUserBtcAddress($limit_userid);
                                        $adminCommission = $this->adminCommissionBtc($cal_amount->volume);
                                        $totalBtc = bcadd(bcadd($adminCommission , $limit_btc, 8) , 0.0001, 8);
                                        //$myClass->userbalanceupdatebtc($limit_userid,$totalBtc,'debit');
                                        //BTC SEND
                                        // $insert_BTC = array(
                                        //         'fromaddr' => $myClass->encrypt($seller_address_org, $setkey, $iv),
                                        //         'toaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                                        //         'addminaddr' => $myClass->encrypt($admins_address, $setkey, $iv),
                                        //         'amount1' => $limit_btc,
                                        //         'amount2' => $adminCommission,
                                        //         'status' => 0
                                        //     );
                                        // $sended_BTC = $myClass->dbInsert(TRANSTABLE_BTC, $insert_BTC);


                                           $insert_BTC = new TranstableBtc;
                                           $insert_BTC->fromaddr = $seller_address_org;
                                           $insert_BTC->toaddr = $user_address_btc;
                                           $insert_BTC->addminaddr = $admins_address;
                                           $insert_BTC->amount1 = $limit_btc;
                                           $insert_BTC->amount2 = $adminCommission;
                                           $insert_BTC->status = 0;
                                           $insert_BTC->save();


                                        //LTC SEND
                                        $from_address_org = $this->getUserEthAddress($uid);
                                        $to_address_org = $this->getUserEthAddress($limit_userid);
                                        $AmtRelased_LTC = bcmul($limit_btc , $buy_price,8);
                                        $adminCommission_eth = $this->adminCommissionBtc($AmtRelased_LTC);
                                        
                                        // $insert_ETH = array(
                                        //         'fromaddr' => $myClass->encrypt($from_address_org, $setkey, $iv),
                                        //         'toaddr' => $myClass->encrypt($to_address_org, $setkey, $iv),
                                        //         'addminaddr' => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                                        //         'amount1' => $AmtRelased_LTC,
                                        //         'amount2' => $adminCommission_ltc,
                                        //         'status' => 0
                                        //     );
                                        // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_ETH);

                                        $sended_Eth = new TranstableEth;
                                           $sended_Eth->fromaddr = $from_address_org;
                                           $sended_Eth->toaddr = $to_address_org;
                                           $sended_Eth->addminaddr = $admins_address_btc;
                                           $sended_Eth->amount1 = $AmtRelased_ETH;
                                           $sended_Eth->amount2 = $adminCommission_eth;
                                           $sended_Eth->status = 0;
                                           $sended_Eth->save();
                                        
                                        //$remaining    = $needed - $cal_amount->remaining;
                                    }
                                    $needed = $remaining;
                                       $status = 0;
                                    if($needed == 0){
                                       $status = 1;
                                    } 
                                      $limitcomplete = Buytrade::where('id', $insertid)->first();
                                        $limitcomplete->remaining = $needed;
                                        $limitcomplete->status = $status;
                                        $limitcomplete->save();
  
                                }                            




                                      $data['msg'] = '<div class="alert alert-success" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Success!</strong> Buy order placed successfully </div>';

                                
                                }
                                 
                                
                                else{
                               


                                 $data['msg'] = '<div class="alert alert-success" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Insufficient!</strong> Insufficient Fund In your ETH Wallet! You have only upto  '.$actualbal.' ETH Wallet</div>';
                                }
                               

                                 }
                                     else{
                                     $data['msg'] = '<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Volume!</strong> No Trade Available on Sell order! Order available only upto '.$avail_capacity.' </div>';
                                  }                                        
                                    
                              }
                              else{
                                 
                                   $data['msg'] = '<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Trade!</strong> No Trade Available on Sell order!</div>';
                                }

                          return $data;
                                       
    }




    function sellMarketBtcEthProcess($pair, $volume)
    {
            $admins_addres = $this->ethAdminaddress();
            $admins_address = $admins_addres->address;
            $admins_addres_btc = $this->btcAdminAddress();
            $admins_address_btc = $admins_addres_btc->address;
            $user_address_eth = $this->getUserEthAddress(\Auth::id());
            $user_address_btc = $this->getUserBtcAddress(\Auth::id());
           

             $trade =  \DB::select("SELECT * FROM `buytrade` WHERE `uid` != ".\Auth::id()." AND ordertype = 1  AND `remaining` != 0 AND pair=".$pair." ORDER BY price DESC");

             

            //dd(count($trades));
            if(count($trade) > 0)
            { 
                $avail_capacity=0;
                $remaining='';
                $needed = $volume;
                foreach($trade->result as $capacity){
                  $avail_capacity+=$capacity->remaining;
                }
                if($avail_capacity >= $volume)
                {
                    $count = $tradeCoin->getTransactionCount($volume,$uid,$pair);
                    if($count != 0){
                      $fees = bcmul($count , $fees,8);
                    } else {
                      $fees = $fees;
                    }
                    $adminCommission = $tradeCoin->adminCommissionBtc($volume);
                    $needed_Btc = bcadd(bcadd($volume , $fees) , $adminCommission);
                    
                    if($needed_Btc <= $actualbal)
                    {  

                                      $sellTrade = new Selltrade;
                                       $sellTrade->uid = Auth::id();
                                       $sellTrade->pair = 4;
                                       $sellTrade->ordertype = 2;
                                       $sellTrade->volume = $request->volume;
                                       $sellTrade->remaining = $request->volume;
                                       $sellTrade->status = 0;
                                       $sellTrade->save(); 
                                       
                                      $insertid = $sellTrade->id;


           
                                $recipients = array();

                            foreach($trade as $cal_amount){


                              $limit_userid = $cal_amount->uid;
                            $buyer_address_org = $this->getUserBtcAddress($cal_amount->uid);
                            //dd($buyer_address_org);
                            $start_volume = $cal_amount->remaining;
                            $start_volume = $start_volume;
                            $close_price = $amount;
                            $needed = $volume;
                            if($start_volume >= $needed AND $needed!=0){
                              $salesAmount = $needed;
                              $salesBtc = bcmul($needed , $close_price, 8);         
                              // $insert = array(
                              //     'buy_id' => $cal_amount->id,
                              //     'sales_id' => $insertid,
                              //     'quantity' => $needed,
                              //     'amount' => $salesBtc,
                              //     'market_price'  => $close_price,
                              //     'created' => date('Y-m-d H:i:s', time())
                              //   );
                              // $insert = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                              $insert = new CompleteTrade;
                              $insert->pair = $pair;
                              $insert->order_type = 1;
                              $insert->buy_id = $cal_amount->id;
                              $insert->sales_id = $insertid;
                              $insert->quantity = $needed;
                              $insert->amount = $salesBtc;
                              $insert->market_price = $close_price;
                              $insert->save();

                              $close_remain = bcsub($cal_amount->remaining , $needed, 8);
                              if($close_remain == 0)
                              {

                                 $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                                  $updatedata->remaining = $close_remain; 
                                  $updatedata->status = 1;
                                  $updatedata->save();

                                 $AmtRelased_BTC = $needed;
                                $adminCommission_btc = $this->adminCommissionBtc($AmtRelased_BTC);

                                $sended = new TranstableBtc;
                                $sended->fromaddr = $user_address_btc;
                                $sended->toaddr = $buyer_address_org;
                                $sended->addminaddr = $admins_address_btc;
                                $sended->amount1 = $needed;
                                $sended->amount2 = $adminCommission_btc;
                                $sended->status = 0;
                                $sended->save();

                              //ETH SEND
                              //buyer address
                              $from_address_org = $this->getUserEthAddress($limit_userid);
                              $to_address_org = $this->getUserEthAddress(\Auth::id());

                              $AmtRelased_eth = bcmul($needed , $close_price,8);
                              $adminCommission_eth = $this->adminCommissionEth($AmtRelased_eth);
                              
                              // $insert_eth = array(
                              //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                              //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                              //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                              //   'amount1'     => $AmtRelased_ETH,
                              //   'amount2'     => $adminCommission_eth,
                              //   'status'    => 0
                              // );
                              // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                              $sendedEth = new TranstableEth;
                              $sendedEth->fromaddr = $from_address_org;
                              $sendedEth->toaddr = $to_address_org;
                              $sendedEth->addminaddr = $admins_address_btc;
                              $sendedEth->amount1 = $AmtRelased_eth;
                              $sendedEth->amount2 = $adminCommission_eth;
                              $sendedEth->status = 0;
                              $sendedEth->save();

                                // $update1 = array('remaining' => $close_remain, 'status' => 1);
                              } 
                              else 
                              {

                                 $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                                  $updatedata->remaining = $close_remain; 
                                  $updatedata->save();

                                  $AmtRelased_BTC = $needed;

                              $sended = new TranstableBtc;
                              $sended->fromaddr = $user_address_btc;
                              $sended->toaddr = $buyer_address_org;
                              $sended->addminaddr = '';
                              $sended->amount1 = $needed;
                              $sended->amount2 = 0;
                              $sended->status = 0;
                              $sended->save();

                              //ETH SEND
                              //buyer address
                              $from_address_org = $this->getUserEthAddress($limit_userid);
                              $to_address_org = $this->getUserEthAddress(\Auth::id());

                              $AmtRelased_eth = bcmul($needed , $close_price,8);
                              
                              // $insert_eth = array(
                              //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                              //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                              //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                              //   'amount1'     => $AmtRelased_ETH,
                              //   'amount2'     => $adminCommission_eth,
                              //   'status'    => 0
                              // );
                              // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                              $sendedEth = new TranstableEth;
                              $sendedEth->fromaddr = $from_address_org;
                              $sendedEth->toaddr = $to_address_org;
                              $sendedEth->addminaddr = '';
                              $sendedEth->amount1 = $AmtRelased_eth;
                              $sendedEth->amount2 = 0;
                              $sendedEth->status = 0;
                              $sendedEth->save();
                                // $update1 = array('remaining' => $close_remain);
                              }
                              // $where = array('id' => $cal_amount->id);
                              // $updatedata = $myClass->dbRowUpdate(BUY_TRADE_BTCETH, $update1, $where);

                              // $limitcomplete = $myClass->dbRowUpdate(SELL_TRADE_BTCETH, array('remaining' => 0, 'status' => 1), array('id' => $insertid));

                               $updatedata = Selltrade::where('id', $insertid)->first();
                                  $updatedata->remaining = 0; 
                                  $updatedata->status = 1;
                                  $updatedata->save();

                              
                              //BTC SEND
                              // $insert = array(
                              //     'fromaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                              //     'toaddr' => $myClass->encrypt($buyer_address_org, $setkey, $iv),
                              //     'addminaddr' => $myClass->encrypt($admins_address, $setkey, $iv),
                              //     'amount1' => $needed,
                              //     'amount2' => $adminCommission,
                              //     'status' => 0
                              //   );
                              // $sended = $myClass->dbInsert(TRANSTABLE_BTC, $insert);



                              
                                
                                //Remaining Updated
                                $remaining = bcsub($needed , $needed);
                              
                              
                            } else if($start_volume < $needed AND $needed!=0){
                              $remaining = bcsub($needed , $start_volume, 8);
                              $buyAmount = bcmul($cal_amount->remaining , $close_price, 8);
                              // $insert = array(
                              //   'buy_id'  => $cal_amount->id,
                              //   'sales_id'  => $insertid,
                              //   'quantity'  => $start_volume,
                              //   'amount'  => $buyAmount,
                              //   'market_price'  => $close_price,
                              //   'created'   => date('Y-m-d H:i:s', time())
                              // );
                              // $insert = $myClass->dbInsert(COMPLETE_TRADE_BTCETH, $insert);

                              $insert = new CompleteTrade;
                              $insert->pair = $pair;
                              $insert->buy_id = $cal_amount->id;
                              $insert->sales_id = $insertid;
                              $insert->quantity = $start_volume;
                              $insert->amount = $buyAmount;
                              $insert->market_price = $close_price;
                              $insert->save();


                              $limit_userid     = $cal_amount->uid;
                              $buyer_address_org  = $this->getUserLtcAddress($limit_userid);
                              
                                // $insert = array(
                                //     'fromaddr' => $myClass->encrypt($user_address_btc, $setkey, $iv),
                                //     'toaddr' => $myClass->encrypt($buyer_address_org, $setkey, $iv),
                                //     'addminaddr' => '',
                                //     'amount1' => $start_volume,
                                //     'amount2' => 0,
                                //     'status' => 0
                                //   );
                                // $sended = $myClass->dbInsert(TRANSTABLE_BTC, $insert);

                              $sended = new TranstableBtc;
                              $sended->fromaddr = Crypt::encryptString($user_address_btc);
                              $sended->toaddr = Crypt::encryptString($buyer_address_org);
                              $sended->addminaddr = '';
                              $sended->amount1 = $start_volume;
                              $sended->amount2 = 0;
                              $sended->status = 0;
                              $sended->save();


                                //Ltc SEND
                                //buyer address
                                $from_address_org = $this->getUserEthAddress($limit_userid);
                                $to_address_org = $this->getUserEthAddress(\Auth::id());
                                $AmtRelased_eth = bcmul($start_volume , $close_price,8);
                                $adminCommission_eth = $this->adminCommissionLtc($AmtRelased_eth);
                                // $insert_eth = array(
                                //   'fromaddr'    => $myClass->encrypt($from_address_org, $setkey, $iv),
                                //   'toaddr'    => $myClass->encrypt($to_address_org, $setkey, $iv),
                                //   'addminaddr'  => $myClass->encrypt($admins_address_eth, $setkey, $iv),
                                //   'amount1'     => $AmtRelased_ETH,
                                //   'amount2'     => $adminCommission_eth,
                                //   'status'    => 0
                                // );
                                // $sended_ETH = $myClass->dbInsert(TRANSTABLE_ETH, $insert_eth);

                                $sendedEth = new TranstableEth;
                                $sendedEth->fromaddr = Crypt::encryptString($from_address_org);
                                $sendedEth->toaddr = Crypt::encryptString($to_address_org);
                                $sendedEth->addminaddr = Crypt::encryptString($admins_address_eth);
                                $sendedEth->amount1 = $AmtRelased_eth;
                                $sendedEth->amount2 = $adminCommission_eth;
                                $sendedEth->status = 0;
                                $sendedEth->save();

                                 $updatedata = Buytrade::where('id', $cal_amount->id)->first();
                                  $updatedata->remaining = 0; 
                                  $updatedata->status = 1;
                                  $updatedata->save();
                                

                                 $updatedata = Selltrade::where('id', $insertid)->first();
                                  $updatedata->remaining =  $remaining; 
                                  $updatedata->status = 0;
                                  $updatedata->save();

                               
                            }
                            $needed = $remaining;
                                            
                            }

                            $data['msg'] = '<div class="alert alert-success" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Success!</strong> Buy order placed successfully </div>';

                    }
                    else
                    {
                      

                      $data['msg'] = '<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Insufficient!</strong>  Fund In your BTC Wallet! Yor Wallet balance is '.$actualbal.'<i class="fa fa-btc"></i>. You need minimum '.$needed_Btc.' <i class="fa fa-btc"></i> (Including fees)</div>';
                    }

                }

                else
                {
                 
                   $data['msg'] = '<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Volume!</strong> No Trade Available on Bid order! Order available only upto '.$avail_capacity.' <i class="fa fa-btc"></i></div>';
                }      
                
              
            }

            else{
             
              $data['msg'] = '<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Trade!</strong> No Trade Available on Bid order!</div>';
            }


            return $data;


    }

    
    function filter($string) 
    {
      $val = htmlspecialchars(trim(strip_tags(addslashes($string))),ENT_QUOTES);
      return $val;
    }
    
 }