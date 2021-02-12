<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Commission;
use App\Models\History;
use App\Models\Faq;
use App\Models\CMS;
use App\Models\OurPartner;
use App\Models\Review;
use App\Mail\Contact;
use App\User;
use Carbon\Carbon;
use Mail;
use DB;


class PageController extends Controller
{
    public function homeIndex(Request $request)
    {

        $coinone = 'BTC';
        $cointwo = 'ETH';

        $coins_list = Commission::where('status',1)->get();

    	$six_digit_random_number = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 4);

    	$segment1 = $request->segment(1);

    	if($segment1 == 'login'){

    		return redirect('/')->with('fail','Please login.and try again')->with('errorstatus','true')->with('random', $six_digit_random_number);

    	}else{	
            
    		return view('welcome')->with('coinone',$coinone)
                ->with('cointwo',$cointwo)
                ->with('random', $six_digit_random_number)
                ->with('coins',$coins_list);
    	}
  
    }

    public function faq()
    {
    	$faq = Faq::get();
    	return view('faq')->with('faq',$faq);
    }

    public function terms()
    {
        $faq = CMS::first();
        return view('terms-condition')->with('terms',$faq->tc);
    }

    public function privacy()
    {
        $faq = CMS::first();
        return view('privacy-policy')->with('policy',$faq->privacy_policy);
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendcontactmail(Request $request)
    {

         request()->validate([
               'name' => 'required | string | max:15',
               'email' => 'required | email',
               'phone' => 'required',
               'subject' => 'required',
               'message' => 'required',
        ]);

         try {
                // Mail::to('sathishprabu447@gmail.com')->send(new Contact($request));
                Mail::to('prechange2020@outlook.com')->send(new Contact($request));
            } catch (Exception $e){
                dd($e);
            }
            
         return back()->with('success','Submitted Successfully');
    }
}
