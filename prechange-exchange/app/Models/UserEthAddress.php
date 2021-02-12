<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEthAddress extends Model
{

    public function ethdetails()
	{
	  return $this->belongsTo('App\User', 'user_id');
	}
}
