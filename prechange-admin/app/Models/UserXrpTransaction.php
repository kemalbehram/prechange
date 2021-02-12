<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class UserXrpTransaction extends Model
{

    public static function withdrawUpdate($request)
    {
    	$withdraw = UserXrpTransaction::on('mysql2')->where('id',$request->id)->first();
        if($request->status == 3)
        { 
            $balanceUpdate = UserWallet::on('mysql2')->where('user_id',$withdraw->user_id)->where('currency','XRP')->first(); 
            $balanceUpdate->balance = $balanceUpdate->balance + $withdraw->total_amount;
            $balanceUpdate->save(); 

            $withdraw->status = 3 ;
            $withdraw->save();

            $admin = AdminWallet::on('mysql2')->where('currency','XRP')->first();
            $admin->withdraw = $admin->withdraw - $withdraw->fees;
            $admin->save();

            $status = 'Cancel';

        }
        elseif($request->status == 2)
        {
            $withdraw->status = 2;
            $withdraw->save();
            
            $status = 'Accept'; 
        } 

        return 'Withdrawn status updated successfully';
    }


	public function UserXrpTransaction()
	{
	  return $this->belongsTo('App\User', 'user_id', 'id');
	}

         public static function AdminFee($coin)
    {
       $total = UserXrpTransaction::on('mysql2')->where('type','send')->sum('fee');

        return $total;
    }
}
