<?php

namespace App\Http\Controllers;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;

use Illuminate\Support\Facades\Crypt;
use App\Traits\GoogleAuthenticator;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\User;

use App\Models\UserLogin;
use Mail;
use Auth;

class Authcontoller extends Controller
{

	use GoogleAuthenticator;


    /**
     * Display a listing of the myformPost.
     *
     * @return \Illuminate\Http\Response
     */
    public function myformPost(Request $request)
    {
       $rules = [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|different:email',
            'password_confirmation' => 'required|same:password',
            'originalcode' => 'required',
            'validcode' => 'required|same:originalcode',
        ];

        $message['first_name.required'] = 'First name field is required';  
        $message['first_name.regex'] = 'First name must contain letters';
        $message['first_name.min'] = 'Please enter in between 6 to 25';
        $message['first_name.max'] = 'Please enter in between 6 to 25';
        $message['first_name.string'] = 'First name is only string';

        $message['email.required'] = 'Email field is required';
        
        $message['password.required'] = 'Password field is required';
        $message['password.min'] = 'Password must be 6 letters'; 

        $message['password_confirmation.required'] = 'Confirm Password field is required';
        $message['validcode.same'] = 'Invalid code.';


               $validator = \Validator::make($request->all(), $rules, $message);

                if ($validator->fails()) {
                    return back()
                      ->withInput()
                    ->withErrors($validator);
                } 

    	$order_id = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
         // generate Secret
        $secret = $this->createSecret();

        $user = User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'reg_ip_addr' => \Request::ip(),
            'google2fa_secret'  => $secret,
            'verifyToken'       => Str::random(40),
            'client_id' => $order_id,
            'password' => bcrypt($request->password),
            'refrere_id' => ($request->referralid != '')?$request->referralid : '' ,
        ]);


        if ($user)
        {
            try {
                Mail::to($user->email)->send(new EmailVerification($user));
            } catch (Exception $e){
                dd($e);
            }
        } 

        \Session::flash('success', 'Register success!. Verify your email to activate your account');

        return redirect('/')->with('registerstatus','true')->with('success', 'Register success!. Verify your email to activate your account');

    }

    public function userlogin(Request $request)
    {
        $rules = [
          
            'loginemail' => 'required|email',
            'loginpassword' => 'required|string|min:8',
            'originalcode' => 'required',
            'logincode' => 'required|same:originalcode',
          
        ];

        $message['loginemail.required'] = 'Email field is required';
        $message['loginpassword.required'] = 'Password field is required';
        $message['logincode.same'] = 'Invalid code';


            $validator = \Validator::make($request->all(), $rules, $message);

                if ($validator->fails()) {
                    return back()
                      ->withInput()
                    ->withErrors($validator);
                } 

        $check_user = User::where('email',$request->loginemail)->first();

        if(is_object($check_user)){
                if($check_user->email_verify == '1'){

                    $email = $request->loginemail;
                    $password = $request->loginpassword;

                    $credentials = array('email' => $email, 'password' => $password);

                    if (Auth::attempt($credentials)) {
                        // Authentication passed...
                            $user = User::where('id',Auth::id())->first();
                            $user->login_status = 1;
                            $user->save();

                        return redirect('/');
                    }

                }else{
                    return redirect('/')->with('fail','Please verify your email.and try again')->with('errorstatus','true');
                }
        }else{
            return redirect('/')->with('fail','Oppes! You have entered invalid credentials')->with('errorstatus','true');
        }
        
         return redirect('/')->with('fail','Oppes! You have entered invalid credentials')->with('errorstatus','true');
        
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where('email', $email)->first();

         $userEmailVerifyUpdate = User::where(['email' => $email, 'verifyToken' => $verifyToken])->update(['email_verify'=>1, 'verifyToken' => NULL]);

         if($userEmailVerifyUpdate)
         {
            \Auth::logout();
            return redirect('/')->with('success','Email verified successfully')->with('errorstatus','true');;
          }
          else {
            \Auth::logout();
            return redirect('/')->with('success','Invalid Verification Code')->with('errorstatus','true');;
        } 
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = \Auth::user();
        $login_ip = \Request::ip();

        
            $user_login = new UserLogin();
            $user_login->user_id = \Auth::id();
            $user_login->login_ip = $login_ip;
            $user_login->process = 'Logout';
            $user_login->save();

        \Session::flush();       
        \Auth::logout();

        return redirect('/');
    }
}   
