<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminBank extends Model
{
	protected $table = 'admin_bank_details';

    public static function index()
    {
    	$bank = AdminBank::on('mysql2')->orderBy('id', 'desc')->get();
    	
    	return $bank;
    }

    public static function edit($id)
    {
    	$bank = AdminBank::on('mysql2')->where('id',$id)->first(); 

    	return $bank;
    }

    public static function bankUpdate($request)
    {
    	$bank = AdminBank::on('mysql2')->where('id',$request->id)->first(); 
    	$bank->coin = $request->coin;
    	$bank->account = $request->company_bank;
    	$bank->save();
    }
}
