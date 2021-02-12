<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\OurPartner;

class PartnerController extends Controller
{
    
    public function partner()
    {
    	 $review = OurPartner::on('mysql2')->get();

        return view('settings.ourpartner.ourpartner')->with('faq',$review);
    }

    public function partner_add()
    {
    	 return view('settings.ourpartner.ourpartner_add');
    }

    public function partner_save(PartnerRequest $request)
    {

     if(Input::hasFile('image')){ 
     	
            $dir = 'OurPartner/';
            $path = 'storage' . DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR.'public'. DIRECTORY_SEPARATOR. $dir;

            $fornt = Input::File('image');
            $fornt->move($path, $fornt->getClientOriginalName());
            $front_img = $path.'/'.$fornt->getClientOriginalName();

             	$save = new  OurPartner();
		    	$save->image = url($front_img);
		    	$save->save();

		    	return redirect('admin/partners')->with('success','Added Successfully');
        }else{
        	  return redirect('admin/partners')->with('fail','Added Failed');
        }
    }

    public function partner_delete($id)
    {
    	 $review = OurPartner::on('mysql2')->where('id',$id)->delete();

    	 return redirect('admin/partners')->with('success','Deleted Successfully');
    }

}
