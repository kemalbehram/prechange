<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\SellfeedEvent;
use App\Events\SellUsdEthEvent;
use App\Events\SellBtcLtcEvent;
use App\Events\SellBtcEthEvent;
use App\Traits\LivefeedProcess;

class Selltrade extends Model
{
   protected $table = 'selltrades'; 


    

    public function sellTradeuser() 
    {
        return $this->belongsTo('App\User', 'uid', 'id');
    }
}
