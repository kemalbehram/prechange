<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Tradepair;
use App\Models\BuyTrades;
use App\Models\SellTrades;
use App\Models\History;

class TradesController extends Controller
{
    public function userTrade(Request $request)
    {

	    $pairs = Tradepair::pair();
	    
		$buytrade = BuyTrades::buyTradesHistory();

		return view('tradehistory.tradehistory', ['buytrade' => $buytrade,'pair'=>$pairs]);
    }

    public function koboexHis()
    {
        $history = History::get();
    
        return view('tradehistory.koboexhistory', ['history'=>$history]);
    }


        public function koboexHisSearch(Request $request)
    {

        $pairs = Tradepair::pair_id($request->tradepair);

        if($request->fromdate == ''){
            $request->from = '2019-01-01';
        }else{
            $request->from = new Carbon($request->fromdate);
        }

        if($request->todate == ''){
            $request->to = Carbon::now()->addDays(1);
        }else{
            $request->to = new Carbon(date('Y-m-d',strtotime($request->todate . "+1 days")));
        }
 
            $trade = History::HistorySearch($request);
       
        
        return view('tradehistory.koboexajax_tradehistory')->with('trades', $trade['history'])->with('total', $trade['total'])->with('tradepair', $pairs)->with('type', $request->type1)->render();
    }

    public function userTradeSearch(Request $request)
	{

		$pairs = Tradepair::pair_id($request->tradepair);

	    if($request->fromdate == ''){
            $request->from = '2019-01-01';
        }else{
            $request->from = new Carbon($request->fromdate);
        }

        if($request->todate == ''){
            $request->to = Carbon::now()->addDays(1);
        }else{
            $request->to = new Carbon(date('Y-m-d',strtotime($request->todate . "+1 days")));
        }

        if($request->type1 == 'Buy'){
            $trade = BuyTrades::buyTradesHistorySearch($request);
        } else{
            $trade = SellTrades::sellTradesHistory($request);
        }  
        
        return view('tradehistory.ajax_tradehistory')->with('trades', $trade['history'])->with('total', $trade['total'])->with('tradepair', $pairs)->with('type', $request->type1)->render();
	}
}
