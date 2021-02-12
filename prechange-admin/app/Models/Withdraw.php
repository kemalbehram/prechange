<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Withdraw extends Model
{
    protected $table = 'withdraw_request';

    public static function AdminFee($coin)
    {
  
    	$total = Withdraw::on('mysql2')->where('currency',$coin)->sum(DB::raw('admin_fee'));
    	
    	return $total;
    }
}
