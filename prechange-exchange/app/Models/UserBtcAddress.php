<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBtcAddress extends Model
{

    public function btcdetails()
	{
	  return $this->belongsTo('App\User', 'user_id');
	}

}
