<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class UserBpcTransaction extends Model
{  

	protected $table = 'user_bpc_transactions';

	public static function deposit_history($request)
	{ 
		$uid = Auth::user()->id;
		if($request->status == 'All')
		{
			$history= UserBpcTransaction::where('user_id',$uid)->where('type',$request->type)->whereBetween('created_at',[$request->from,$request->to])->orderBy('id','desc')->paginate(10);
		}
		else
		{	
			$history= UserBpcTransaction::where('user_id',$uid)->where('type',$request->type)->where('status',$request->status)->whereBetween('created_at',[$request->from,$request->to])->orderBy('id','desc')->paginate(10);
		}  
        return $history;
	}

	public static function withdrawSave($request,$totalAmount,$adminFee,$from)
	{
		// $uid = \Session::get('user_id');
		$uid = Auth::user()->id;
		$withdraw = new UserBpcTransaction;
		$withdraw->user_id = $uid;
		$withdraw->type = 'send';
		$withdraw->recipient = $request->toaddress;
		$withdraw->sender = $from;
		$withdraw->amount = $request->amount;
		$withdraw->fees = $adminFee;
		$withdraw->total_amount = $totalAmount;
		$withdraw->status = 1;
		$withdraw->save();

		return true;
	}
}
