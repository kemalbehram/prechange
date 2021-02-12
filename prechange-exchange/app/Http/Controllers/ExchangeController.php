<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Traits\ChangellyApi;
use App\Models\History;

class ExchangeController extends Controller
{
    use ChangellyApi;

    public function __construct()
    {        
        $this->middleware(['auth']);
    }

    public function exchangeind()
    {
    	$coinone = 'btc';
    	$cointwo = 'eth';

    	$coins_list = Commission::where('status',1)->where('koboex_status','1')->get();
    	$percentage_trade = Commission::where('source',$cointwo)->value('trade');
    	$total_commission_percentage = $percentage_trade+0.25;

    	return view('exchange')->with('coinone',$coinone)
    			->with('total_commission_percentage',$total_commission_percentage)
    			->with('percentage_trade',$percentage_trade)
    			->with('cointwo',$cointwo)
    			->with('coins',$coins_list);

    }

    public function checkout()
    { 
    	return view('checkout')->with('coinone',\Session::get('coinone'))
    			->with('receiver_address',\Session::get('receiver_address'))    			
    			->with('cointwo_amount',\Session::get('cointwo_amount'))
    			->with('coinone_amount',\Session::get('coinone_amount'))
    			->with('network_fee',\Session::get('network_fee'))
    			->with('exchange_fee',\Session::get('exchange_fee'))
    			->with('cointwo',\Session::get('cointwo'));
    }

    public function confirm()
    {

        $response = $this->createTransaction(\Session::get('coinone'),\Session::get('cointwo'),\Session::get('receiver_address'),\Session::get('coinone_amount'));

        $history_update = new History();

        $history_update->user_id = \Auth::user()->id;
        $history_update->txid = $response->result->id;
        $history_update->api_extra_fee = $response->result->apiExtraFee;
        $history_update->changelly_fee = $response->result->changellyFee;
        $history_update->payin_Address = $response->result->payinAddress;
        $history_update->payin_extraid = $response->result->payinExtraId;
        $history_update->payout_address = $response->result->payoutAddress;
        $history_update->payout_extraid = (isset($response->result->payoutExtraId))?$response->result->payoutExtraId:'';
        $history_update->amount_expected_from = $response->result->amountExpectedFrom;
        $history_update->amount_expected_to = $response->result->amountExpectedTo;
        $history_update->status = $response->result->status;
        $history_update->currency_to = $response->result->currencyTo;
        $history_update->currency_from = $response->result->currencyFrom;
        $history_update->amount_to = $response->result->amountTo;
        // $history_update->created_at = $response->result->createdAt;
        $history_update->save();
     

        $transaction = $response->result->id;
        $payin_address = $response->result->payinAddress;
        $coinone = $response->result->currencyFrom;
        $cointwo = $response->result->currencyTo;
        $amountExpectedFrom = $response->result->amountExpectedFrom;

    	return view('confirm')->with('coinone',\Session::get('coinone'))
    			->with('cointwo',$cointwo)
    			->with('admin_address',$payin_address)
                ->with('txid',$transaction)
    			->with('coinone_amount',$amountExpectedFrom);
    }
}
