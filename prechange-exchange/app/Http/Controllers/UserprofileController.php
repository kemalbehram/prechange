<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Country;
use App\Userprofile;
use App\User;
use App\Http\Requests\ChangePasswordRequest;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangePassword;
use App\Http\Requests\ProfileRequest;
use App\Bankuser;
use App\Http\Requests\UserBankRequest;


class UserprofileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
//
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $countries = Country::get(); 
    $userprofile = Userprofile::where('user_id', Auth::id())->first(); 
    $checkExists = Userprofile::where('user_id', Auth::id())->exists();
    $userBank = Bankuser::where('uid',\Auth::id())->first();
    $user = User::where('id', Auth::id())->first();
    if ($checkExists)
    {
        $mobile = $userprofile->mobile;
        $country = $userprofile->country;
    }
    else
    {
        $mobile = '';
        $country = '';
    }
    
    return view('userpanel.myprofile', [
        'country' => $country,
        'fname' => $user->fname,
        'lname' => $user->lname,
        'mobile' => $mobile,
        'countries' => $countries,
        'checkExists' => $checkExists,
        'userBank' => $userBank
        ]);
}     

public function saveAvatar(Request $request) {
    $image = $request->image;
    list($type, $image) = explode(';', $image);
    list(, $image) = explode(',', $image);
    $image = base64_decode($image);

    $dir = 'profile';
    $path = storage_path(). DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR.'public'. DIRECTORY_SEPARATOR. $dir;
    $location = 'public' . DIRECTORY_SEPARATOR .'storage'. DIRECTORY_SEPARATOR. $dir;
    if (! \File::exists(public_path().$path)) {
    \File::makeDirectory($path,$mode=0777,true,true);
    }
      
    $url = \Config::get('app.url');
    $image_name = str_replace('.','',microtime(true)).'.png';
    $dir = 'profile/';
    $path = 'storage' . DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR.'public'. DIRECTORY_SEPARATOR. $dir;
    $img = $url.'/'.$path.$image_name;

    $path = $path .'/'. $image_name;

    file_put_contents($path, $image);

    if ($image)
    {   
        
        $checkExists = Userprofile::where('user_id', Auth::id() )->exists(); 

        if ($checkExists)
        {
            $userprofile = Userprofile::where('user_id', Auth::id() )->first(); 
            $userprofile->profile_avatar = $img;
            $userprofile->save();
        }
        else
        {
            $userprofile = new Userprofile; 
            $userprofile->user_id = Auth::id();
            $userprofile->profile_avatar = $img;
            $userprofile->save();
        }

        session(['profileimage' => $image]);
        return back()->with('success', 'Profile picture changed successfully');            
    }
    else
    {
        return back()->with('fail', 'Profile picture changed failed!!!'); 
    } 
}

public function updatePassword(ChangePasswordRequest $request) 
{
    $user = User::find(Auth::id());
    $hashedPassword = $user->password;
    if (Hash::check($request->oldpassword, $hashedPassword)) {       
        $user->password = Hash::make($request->newpassword);
        $user->save();

        Mail::to($user->email)->queue(new ChangePassword()); 

        return back()->with('success', 'Password changed successfully');      
    } 
    else
    {
        return back()->with('fail', 'Old password mismatch!!!');          
    }       


} 

public function updatePersonalDetails(ProfileRequest $request) 
{
    $checkExists = Userprofile::where('user_id', Auth::id())->exists(); 

    if ($checkExists)
    {
        $userprofile = Userprofile::where('user_id', Auth::id() )->first(); 
        $userprofile->firstname = $request->fname;
        $userprofile->user_id = Auth::id();
        $userprofile->lastname = $request->lname;
        $userprofile->mobile = $request->mobile;
        $userprofile->country = $request->country;

        $user = User::where('id', Auth::id())->first(); 
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->save();

        if ($userprofile->save())
        {
            return back()->with('success', 'Personal details updated successfully');
        }
        else
        {
            return back()->with('fail', 'Personal details updated failed !!!');
        }

    }
    else
    {
        $userprofile = new Userprofile; 
        $userprofile->firstname = $request->fname;
        $userprofile->user_id = Auth::id();
        $userprofile->lastname = $request->lname;
        $userprofile->mobile = $request->mobile;
        $userprofile->country = $request->country;
        if ($userprofile->save())
        {
            return back()->with('success', 'Personal details updated successfully');
        }
        else
        {
            return back()->with('fail', 'Personal details updated failed!!!');
        }
    }

}


public function userbank(UserBankRequest $request)
{   
    $security = User::where('id', Auth::id())->first();

    $userBank = Bankuser::where('uid',Auth::id())->first();

    if(isset($userBank))
    {
        $userBank = Bankuser::where('uid',Auth::id())->first();
        $userBank->uid = \Auth::id();
        $userBank->account_name = $request->acc_name;
        $userBank->account_number = $request->acc_no;
        $userBank->bank_name = $request->bank_name;
        $userBank->bank_address = $request->bank_address;
        $userBank->swift_code = $request->swift_code;
        $userBank->bank_branch = $request->bank_branch;
        $userBank->save();
        return back()->with('success', 'Bank details updated successfully');

    }
    else
    { 
        $save = Bankuser::create([
            'uid' => $security->id,
            'account_name' => $request->acc_name,
            'account_number' => $request->acc_no,
            'bank_name' =>$request->bank_name,
            'bank_branch' =>$request->bank_branch,
            'bank_address' =>$request->bank_address,
            'swift_code' => $request->swift_code
            ]);
        return back()->with('success', 'Bank details updated successfully');
    } 

}


public function userbankdetails()
{
    $security = User::where('id', Auth::id())->first();
    $userbank= \DB::select("SELECT * FROM `user_bank`  where `uid`= $security->id order by id desc ");
    return view('/userpanel.user_bank',[
        'verfiyid' => $security,
        'userbank' => $userbank,
        ]);
}


public function imgvalidaion($img)

{
    $myfile = fopen($img, "r") or die("Unable to open file!");
    $value = fread($myfile,filesize($img));
    if (strpos($value, "<?php") !== false) {
        $img = 0;
    } 
    elseif (strpos($value, "<?=") !== false){
        $img = 0;
    }
    elseif (strpos($value, "eval") !== false) {
        $img = 0;
    }
    elseif (strpos($value,"<script") !== false) {
        $img = 0;
    }else{
        $img=1;
    }
    fclose($myfile);
    return $img;
}
}
