<?php
namespace App\Traits;
use App\Buytrade;
use App\CompleteTrade;
use App\TradeChart;
use App\Selltrade;
use App\User;
use App\Tradepair;
use Carbon\Carbon; 
use App\UserWallet;
use App\Commission;
use Auth;
use DB;

trait SiteData
{
    function currentPriceTrade($pair)
    {
          $data=array();
          $currentprice =0;
          $YesterdayClose = 0;
          switch($pair){  
            default:
            $currentprice = 12.25;
            $YesterdayClose = 13.47;
            $volume =25.78;
            break;    
          }
          $data['currentprice'] = $currentprice;
          $data['volume'] = $volume;
          $last = CompleteTrade::where('pair', $pair)->orderBy('id', 'DESC')->first();
          
          $quantity = \DB::select("SELECT SUM(volume) AS TotalQuantity FROM completedtrades WHERE pair = ".$pair." AND created_at >=(DATE_SUB(now(), INTERVAL 24 HOUR))");
          $yesterday = date('Y-m-d',strtotime("-1 days"));

          $yestclose = \DB::select("SELECT * FROM completedtrades WHERE pair = ".$pair." AND date(`created_at`) = '$yesterday' ORDER BY id DESC LIMIT 1");

          if(count($last) > 0){
           $currentprice = $last->price;
           $data['currentprice'] = $currentprice;
          }if($quantity[0]->TotalQuantity != ""){
          // $volume = $quantity->TotalQuantity;
           $data['volume'] = $quantity[0]->TotalQuantity;
          }
          if($yestclose){
           $YesterdayClose = $yestclose[0]->price;
          }
          $exchange = ((bcsub($currentprice, $YesterdayClose)) / $YesterdayClose) * 100;
         // dd($currentprice - $YesterdayClose);
          $data['exchange'] = number_format($exchange, 2);
          return $data;
     }

    public function getLivePairValue($val, $val1)
    {
        $data = file_get_contents("https://currencio.co/".$val."/".$val1."/");
        preg_match("/<span class=\"rate-value\">(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        return number_format(round($converted, 3),2);
    }

    function getChartData($pair)
    {
          $select_chart = TradeChart::where('pair', $pair)->get();
          if(count($select_chart) > 0)
           {
               $i = 1;
               foreach($select_chart as $list)
               {
                    $resultArray[$i]['date']  = strtotime($list->created_at);             
                    $resultArray[$i]['open']  = "".$list->open."";
                    $resultArray[$i]['high']  = "".$list->high."";
                    $resultArray[$i]['low']  = "".$list->low."";
                    $resultArray[$i]['close']  = "".$list->close."";
                   
                    $i++;                        
                } 
               $arrayResult = array_values($resultArray);
               $data = json_encode($arrayResult);
               return $data;
           }
          return 0;
     }

    function getDepthChartDeta($pair)
     {   

        $buy_order = Buytrade::where('pair' ,'=',$pair)->where('remaining','>','0')-> where('status','=','0')->get();
        $sell_order = Selltrade::where('pair' ,'=',$pair)->where('remaining','>','0')-> where('status','=','0')->get(); 
        $bid_data2 = array();
        $ask_data2 = array();
        if(count($buy_order) > 0)
        { 
            foreach($buy_order as $bid)
            { 
                $bid_data = array();
                $bid_data[] = $bid->price;
                $bid_data[] = $bid->volume;
                $bid_data2[] = $bid_data;
            }
            
        }
        if(count($sell_order) > 0)
        {
            foreach($sell_order as $ask)
            {
                $ask_data = array();
                $ask_data[] = $ask->price;
                $ask_data[] = $ask->volume;
                $ask_data2[] = $ask_data;   
            }           
        } 

        $bid_result['asks'] = $ask_data2;
        $bid_result['bids'] = $bid_data2;  

        
        $result = json_encode($bid_result,JSON_PRETTY_PRINT); 
            
        return $result;
    } 

    function lowestAsk($pairCount)
    {
        
        for($i=1;$i<=$pairCount;$i++)
        {
            $minAsk = Selltrade::where('pair',$i)->where('status',1)->min('price');

            $lowestAsk[] = $minAsk;

        }
        return $lowestAsk;
    }

    function hightesBid($pairCount)
    {
        for($i=1;$i<=$pairCount;$i++)
        {
            $maxBid = Buytrade::where('pair',$i)->where('status',1)->max('price');

            $hightesBid[] = $maxBid; 
        }
        return $hightesBid;  
    }

     public function hrExchange($pairCount)
      {   
        $price =0.000; 
        for($i=1;$i<=$pairCount;$i++)
        {
            $last = CompleteTrade::where('pair', $i)->orderBy('id', 'desc')->whereDate('created_at',Carbon::today())->first(); 
            $open = CompleteTrade::where('pair', $i)->where('created_at','>',Carbon::now()->subDay(1))->orderBy('id', 'asc')->first();  
            
            if(!empty($last)  && !empty($open))
            {
                
                if($last->count() < 0)
                {
                    $last->price = 0;
                }

                if($open->count() < 0)
                {
                    $open->price = 0;
                }

                $lastprice=$last->price; 
                $openprice=$open->price; 
                $price=(number_format($lastprice,8)- number_format($open->price,8))/ number_format($lastprice,8);  

                $hrExchange[] = number_format($price*100,0); 
            }
            else
            {
                $hrExchange[] = 0; 
            } 
             
        }
        return $hrExchange;  
    }

    public function hrVolume($pairCount)
    {
        $price =0.000;
        for($i=1;$i<=$pairCount;$i++)
        {
            $bid =CompleteTrade::where('pair', $i)->where('created_at','>',Carbon::now()->subDay(1))->orderBy('id', 'asc')->sum('volume'); 
            if($bid !=null)
            { 
                $hrVolume[] = $bid;
            }
            else
            {
                $hrVolume[] = 0;
            }
        }
        return $hrVolume;
    }


    public function last_Prices($pairCount)
    {
        for($i=1;$i<=$pairCount;$i++)
        {
            $lastPrice = CompleteTrade::where('pair',$i)->orderby('id','desc')->first();
            if(isset($lastPrice->price))
            { 
                $last_price[]=$lastPrice->price;            
            } 
            else    
            {
                $last_price[] = 0;
            }
        }
        return $last_price;
    }




    function buyFeeds($pair, $ordertype){

        $buyFeed = \App\Buytrade::select('price', \DB::raw('SUM(remaining) as remaining'))
                        ->where(['order_type' => $ordertype, 'pair' => $pair,'status' => 0])        
                        ->groupBy('price')
                        ->orderBy('price', 'desc')
                        ->limit(20)->get();
        return $buyFeed ;
    }

    function sellFeeds($pair, $ordertype){

        $sellFeeds = \App\Selltrade::select('price', \DB::raw('SUM(remaining) as remaining'))
                        ->where(['order_type' => $ordertype, 'pair' => $pair,'status' => 0])
                        ->orderBy('price', 'asc')
                        ->groupBy('price')
                        ->limit(20)->get();
        return $sellFeeds ;
    }

    function coinBalance ($coin)
    {
        $Balance = UserWallet::where([['user_id', \Auth::id()],['currency', $coin]])->first(); 
        if (isset($Balance)){
            return $Balance->balance;
        } else {
            return 0.00;
        } 
    }

    function lastPrice($pair){

        $lastPrice = CompleteTrade::where('pair',$pair)->orderby('id','desc')->first();
        if(isset($lastPrice->price))
        {  
            return $lastPrice->price ;
        } 
        else 
        {
           return 0 ;
        }
    }

    function myTrades($pair)
    {
        $buytrades = \DB::table('buytrades')->where('uid',\Auth::id())->where('pair',$pair)->where('remaining',0);

        $selltrades = \DB::table('selltrades')->where('uid',\Auth::id())->where('pair',$pair)->where('remaining',0)->unionAll($buytrades)->orderBy('created_at', 'desc')->get(); 

        if(count($selltrades)>0)
        {
            $mycomplete = $selltrades ;
            return $mycomplete ;
        } 

        
    }

    public function get_trade($pair,$ordertype)
    {
        $user = Auth::user();
        $buy = array();
        $sell = array();


        $completedtrade = \DB::table('completedtrades')->where(['pair' => $pair])->orderBy('id', 'desc')->limit(50)->get();

        // Buy Trade
        $buytrades = \App\Buytrade::select('price',DB::raw('SUM(remaining) as remaining'),DB::raw('group_concat(uid) as user_id'))
        ->where(['order_type' => $ordertype, 'pair' => $pair,'status' => 0])        
        ->groupBy('price')
        ->orderBy('price', 'desc')
        ->limit(50)->get();
        

        // Sell Trade
        $selltrades = \App\Selltrade::select('price', DB::raw('SUM(remaining) as remaining'),DB::raw('group_concat(uid) as user_id'))
        ->where(['order_type' => $ordertype, 'pair' => $pair,'status' => 0])
        ->orderBy('price', 'asc')
        ->groupBy('price')
        ->limit(50)->get();

        $tradespair = Tradepair::where(['id' => $pair])->first();
        $commission1 = Commission::where('source', $tradespair->coinone)->first();
        $commission2 = Commission::where('source', $tradespair->cointwo)->first();

        return $trade = [
                        'completedtrades' => $completedtrade,
                        'buytrades' => $buytrades,
                        'selltrades' => $selltrades,
                        'coinone'=>$tradespair['coinone'],
                        'cointwo' =>$tradespair['cointwo'],
                        'commissionone' => $commission1['buy_trade'],
                        'sellcommissionone' => $commission1['sell_trade'],
                        'sellcommissiontwo' => $commission2['sell_trade'],
                        'commissiontwo' => $commission2['buy_trade'],
                        'coinone_type' => $commission1['type'],
                        'cointwo_type' => $commission2['type']];
    }



    public function get_trade_socket($pair,$ordertype,$uid)
    {
        $uid = $uid; 
        $buy = array();
        $sell = array();   

        $result['cointwo_decimal'] =8;   
        $result['coinone_decimal'] =8;   

        $user = User::where('id',$uid)->first();

                $buy = $sell = $complet = $coinone_balance = $cointwo_balance = "";

       $completedtrade = \DB::table('completedtrades')->where(['pair' => $pair])->orderBy('id', 'desc')->limit(50)->get();

if(count($completedtrade) > 0){
       foreach($completedtrade as $res){
                $addClass = "red-t";
                if($res->type == 'Buy' || $res->type == "Buy Market")
                {
                    $addClass = "green-t";
                } 
                $complet.="<div class='table-tr'>";
                $complet.="<div class='table-td'><span class=".$addClass.">".number_format($res->price, 8, '.', '')."</span></div>";
                $complet.="<div class='table-td'>".number_format($res->volume, 8, '.', '')."</div>";
                $complet.="<div class='table-td'>".number_format($res->price*$res->volume, 8, '.', '')."</div>";
                $complet.="<div class='table-td'>".date('d-m-Y',strtotime($res->created_at))."</div>";
                $complet.="</div>";
            }
        } else{
                $complet="<div class='table-tr'>No Record Found</div>";
        }
        // Buy Trade
        $buytrades = \App\Buytrade::select('price',DB::raw('SUM(remaining) as remaining'),DB::raw('group_concat(uid) as user_id'))
        ->where(['order_type' => $ordertype, 'pair' => $pair,'status' => 0])        
        ->groupBy('price')
        ->orderBy('price', 'desc')
        ->get();



        if(count($buytrades) > 0){
            foreach($buytrades as $res){ 
                $buy.='<div class="table-tr" onclick="javascript:buyRow('.$res['price'].','.$res['remaining'].');">';
                $buy.="<div class='table-td'>".number_format($res['price'], 8, '.', '')."</div>";
                $buy.="<div class='table-td'>".number_format($res['remaining'], 8, '.', '')."</div>";
                $buy.="<div class='table-td'>".number_format($res['price']*$res['remaining'], 8, '.', '')."</div>";
                $buy.="</div>";
            }

        }else{
                $buy="<div class='table-tr'>No Record Found</div>";
        }

        // Sell Trade
        $selltrades = \App\Selltrade::select('price', DB::raw('SUM(remaining) as remaining'),DB::raw('group_concat(uid) as user_id'))
        ->where(['order_type' => $ordertype, 'pair' => $pair,'status' => 0])
        ->orderBy('price', 'asc')
        ->groupBy('price')
        ->get();

        if(count($selltrades) > 0){

        foreach($selltrades as $res){ 
                $sell.='<div class="table-tr" onclick="javascript:sellRow('.$res['price'].','.$res['remaining'].');">';
                $sell.="<div class='table-td'>".number_format($res['price'], 8, '.', '')."</div>";
                $sell.="<div class='table-td'>".number_format($res['remaining'], 8, '.', '')."</div>";
                $sell.="<div class='table-td'>".number_format($res['price']*$res['remaining'], 8, '.', '')."</div>";
                $sell.="</div>";
            }
        }else{
            $sell="<div class='table-tr'>No Record Found</div>";
        }


//Buy My trade
        $mybuy = DB::table('buytrades')
        ->join('tradepairs', 'buytrades.pair', '=', 'tradepairs.id')
        ->select('buytrades.*', 'tradepairs.coinone','tradepairs.cointwo')
        ->where([['buytrades.uid', '=', $uid]])
        ->where([['buytrades.remaining', '!=', 0]])
        ->where([['buytrades.status', '=', 0]])
        ->orderBy('buytrades.created_at', 'desc')
        ->get();
        $mysell = DB::table('selltrades')
        ->join('tradepairs', 'selltrades.pair', '=', 'tradepairs.id')
        ->select('selltrades.*', 'tradepairs.coinone','tradepairs.cointwo')
        ->where([['selltrades.uid', '=', $uid]])
        ->where([['selltrades.remaining', '!=', 0]])
        ->where([['selltrades.status', '=', 0]])
        ->orderBy('selltrades.created_at', 'desc')
        ->get();

        $tradespair = Tradepair::where(['id' => $pair])->first();
        $commission1 = Commission::where('source', $tradespair->coinone)->first();
        $commission2 = Commission::where('source', $tradespair->cointwo)->first();

        $wallet = UserWallet::where('user_id', '=', $uid)->get();
        if($wallet->count()){
            foreach($wallet as $balance){
                $currency[$balance->currency] = $balance->balance;
            }
        }else{
            $currency='';
        }

        return $trade = ['user' => $user, 'completedtrades' => $complet, 'buytrades' => $buytrades, 'selltrades' => $selltrades,'coinone'=>$tradespair['coinone'], 'cointwo' =>$tradespair['cointwo'],'commissionone' => $commission1['trade'],'sellcommissionone' => $commission1['sell'],'sellcommissiontwo' => $commission2['sell'], 'commissiontwo' => $commission2['trade'],'wallet'=>$currency,'mybuy'=>$mybuy,'mysell'=>$mysell, 'coinone_type' => $commission1['type'], 'cointwo_type' => $commission2['type'],'buy_trade' => $buy,'sell_trade'=>$sell];
    }


    function livePrice()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "https://api.coinmarketcap.com/v2/ticker/?convert=USD");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = array();
        $headers[] = "Content-Type : application/json";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $this->result = curl_exec($this->ch);
        if (curl_errno($this->ch)) {
            echo 'Error:' . curl_error($this->ch);
        }
        curl_close($this->ch);
        $result =json_decode($this->result,true);
        return $result['data'];
    }

    function CurrentUser()
    {
        $user = \Auth::user();
         return $user->id;
    }

    public function market_table($uid)
    {
        $pairCount =  Tradepair::count();
        $trade_pairs = Tradepair::get();
        $price = $this->last_Prices($pairCount);

        $hrExchange = $this->hrExchange($pairCount);       
        $hrVolume = $this->hrVolume($pairCount);       
        $table = "";

        for($i=0;$i<$pairCount;$i++)
        {
            $trade_pairs = Tradepair::where('id',$i+1)->first();
            if($hrExchange[$i] < 0){
                $arrow_class = 'red-down';
                $arrow_class_1 = 'fa fa-arrow-down';
            }
            else{
                $arrow_class = 'green-up';
                $arrow_class_1 = 'fa fa-arrow-up';
            }

            $table.= '<div class="table-tr">';
            if($uid!=0)
            {
                $app_url = config('app.url');
                $table.= '<div class="table-td"><a href="'.$app_url.'/myaccount/trade/'.$trade_pairs->coinone.'_'.$trade_pairs->cointwo.'">'.$trade_pairs->coinone.'/'.$trade_pairs->cointwo.'</a></div>';
            }
            else
            { 
                $app_url = config('app.url');                
                $table.= '<div class="table-td"><a href="'.$app_url.'/exchange/'.$trade_pairs->coinone.'_'.$trade_pairs->cointwo.'">'.$trade_pairs->coinone.'/'.$trade_pairs->cointwo.'</a></div>';
            }

            $table.= '<div  class="table-td" id="closed_price">'.number_format($price[$i],8).'</div>';
            $table.= '<div  class="table-td" id="changePercentage_data"><span class="'.$arrow_class.'"><i class="'.$arrow_class_1.'" aria-hidden="true"></i></span>'.$hrExchange[$i].'</div>';
            $table.= '<div  class="table-td" id="hrVolume_data">'.number_format($hrVolume[$i],8).'</div>';
            $table.= '</div>';
        }

        return $table;
    }

}

?>