<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\History;

class UserController extends Controller
{

	 public function __construct()
    {        
        $this->middleware(['auth']);
    }


   public function UserIndex()
   {
    	$user = User::where('id',\Auth::user()->id)->first();

    	$history = History::where('user_id', \Auth::user()->id)->get();
    	$completed_count = History::where('user_id', \Auth::user()->id)->where('status',1)->count();


   	    return view('profile')->with('user', $user)->with('tradehistory',$history)->with('completed_count', $completed_count);
   }
}
