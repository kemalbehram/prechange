<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\BuyfeedEvent;
use App\Events\BuyUsdEthEvent;
use App\Events\BuyBtcLtcEvent;
use App\Events\BuyBtcEthEvent;
use App\Traits\LivefeedProcess;

class Buytrade extends Model
{
   protected $table = 'buytrades'; 

    

    public function buyTradeuser() 
    {
        return $this->belongsTo('App\User', 'uid', 'id');
    }

    
}
/**/