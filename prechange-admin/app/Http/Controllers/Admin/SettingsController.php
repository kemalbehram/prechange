<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Features;
use App\Models\Faq;
use App\Models\SocialMedia;
use App\Http\Requests\FaqRequest;

class SettingsController extends Controller
{
    public function logo()
    {
        $terms = CMS::index();

        return view('settings.logo', ['logo' => $terms]);
    }

    public function tc()
    {
    	$terms = CMS::index();

    	return view('settings.tc', ['terms' => $terms]);
    }

   public function update_terms(Request $request)
    {
        // dd($request->tc_azn);
    	$update = CMS::updateTerms($request);
        
    	return back()->with('status',$update);
    }

    public function kycaml()
    {
        $kycaml = CMS::kycindex();

        return view('settings.kycaml', ['kycaml' => $kycaml]);
    }

    public function updatekycaml(Request $request)
    {
        // dd($request->tc_azn);
        $update = CMS::updateKycaml($request);
        
        return back()->with('status',$update);
    }

    public function privacy()
    {
        $terms = CMS::index();

        return view('settings.privacy', ['privacy' => $terms]);
    }

    public function updatePrivacy(Request $request)
    {

    	$update = CMS::updatePrivacy($request);

    	return back()->with('status',$update);
    }

    public function aboutus()
    {
        $aboutus = CMS::index();

        return view('settings.aboutus', ['aboutus' => $aboutus]);
    }

    public function updateAbout(Request $request)
    {

    	$update = CMS::updateAbout($request);

    	return back()->with('status',$update);
        
    }

    public function features()
    {
        $features = Features::on('mysql2')->get();

        return view('settings.features')->with('features',$features);
    }

    public function features_settings(Request $request)
    { 

        $features = Features::updateFeatures($request);

        return back()->with('status',$features);
    } 

    public function faq()
    { 
        $faq = Faq::on('mysql2')->get();

        return view('settings.faq')->with('faq',$faq);
    }

    public function faq_ajax_search(Request $request)
    {  
        if($request->status == 'All'){
            $faq = Faq::on('mysql2')->get();
        } else{
            $faq = Faq::on('mysql2')->where('lang',$request->status)->get();
        }  

        return view('settings.faqajax')->with('faq',$faq);
        
        // return view('tradehistory.ajax_tradehistory')->with('trades', $trade['history'])->with('total', $trade['total'])->with('tradepair', $pairs)->with('type', $request->type1)->render();
    }

    public function faq_add()
    {
        return view('settings.faq_add');
    }
    
    public function faq_save(FaqRequest $request)
    { 

    	$faq = Faq::saveFaq($request);

        return redirect('admin/faq')->with('success','Added Successfully');;
    }

    public function faq_edit($id)
    {
        $faq = Faq::edit($id);

        return view('settings.faq_edit')->with('faq',$faq);
    }

    public function faq_update(Request $request)
    { 
    	$faq = Faq::faqUpdate($request); 

        return redirect('admin/faq')->with('success',$faq);
    }

    public function socialMedia()
    {
        $socialMedia = SocialMedia::index();
        return view('settings.social_media')->with('link',$socialMedia);
    }

    public function saveSocialMedia(Request $request)
    {

        $socialMedia = SocialMedia::saveSocialMedia($request); 

        return back()->with('success', 'Social Media Setting Updated Successfully!');
    }

    public function meta(){
        $terms = CMS::index();

        return view('settings.meta', ['meta' => $terms]);
    }

    public function updateMeta(Request $request){

        $update = CMS::updateMeta($request);

    	return back()->with('status',$update);
    }

}