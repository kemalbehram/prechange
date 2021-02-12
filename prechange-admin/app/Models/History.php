<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history'; 
    protected $connection = 'mysql2';


    public static function HistorySearch($request)
    { 
        if($request->status != 'All')
        {
            if(isset($request->email))
            { 
                $history = History::on('mysql2')->where('status', $request->status)->orderBy('id', 'desc')->paginate(10);

                $total = History::on('mysql2')->where('status', $request->status)->orderBy('id', 'desc')->get();

            }
            else
            {
                $history = History::on('mysql2')->where('status', $request->status)->orderBy('id', 'desc')->paginate(10);

                $total = History::on('mysql2')->where('status', $request->status)->orderBy('id', 'desc')->get();
            }
            
        }
        else
        {
            if(isset($request->email))
            {
                $history = History::on('mysql2')->where('uid', useremail($request->email)->id)->whereBetween('created_at',[$request->from,$request->to])->orderBy('price', 'desc')->paginate(10);

                $total = History::on('mysql2')->where('uid', useremail($request->email)->id)->whereBetween('created_at',[$request->from,$request->to])->orderBy('created_at', 'desc')->get();
            }
            else
            {
                $history = History::on('mysql2')->whereBetween('created_at',[$request->from,$request->to])->orderBy('created_at', 'desc')->paginate(10);

                $total = History::on('mysql2')->whereBetween('created_at',[$request->from,$request->to])->orderBy('created_at', 'desc')->get();
            }
        }
    	 
    	return array(
            'history'=>$history,
            'total'=>$total
        );
    }
}
