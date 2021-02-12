<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\BitstampAPi;
use App\Traits\ChangellyApi;
use App\Traits\Bitcoin;

class CurlDataController extends Controller
{
	use BitstampAPi , ChangellyApi, Bitcoin;

    public function priceget(Request $request)
    {
    	 $details = $this->getExchangeAmount($request);

        return response()->json($details);   	
    }

   public function getExchangeAmt(Request $request)
   {
        $details = $this->getExchangeAmount($request);

        return response()->json($details);

   }

  public function validateaddress(Request $request)
  {
      $details = $this->addressvalidate($request);

       return response()->json($details);
  }

  public function sessionSave(Request $request)
  {
      \Session::put('receiver_address',$request->receiver_address);
      \Session::put('cointwo',$request->cointwo);
      \Session::put('coinone',$request->coinone);
      \Session::put('cointwo_amount',$request->cointwo_amount);
      \Session::put('coinone_amount',$request->coinone_amount);
      \Session::put('network_fee',$request->network_fee);
      \Session::put('exchange_fee',$request->exchange_fee);

      return response()->json();

  }


}
