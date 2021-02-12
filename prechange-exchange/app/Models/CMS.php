<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table = 'cms';


    public static function index()
    {
        $terms = CMS::on('mysql2')->where('id',1)->first();
        
        return $terms;
    }

    public static function updateTerms($request)
    {
    	$tc = $request->tc;
        $tc_azn = $request->tc_azn;
        $tc_ru = $request->tc_ru;
        if($tc !='')
        {
            // $update = CMS::on('mysql2')->where('id', 1)->update(['tc' => $tc,'tc_azn' => $tc_azn,'tc_ru' => $tc_ru]);
            $update = CMS::on('mysql2')->where('id', 1)->update(['tc' => $tc]);
            if($update)
            {
                $message = "Updated Successfully!";
            }
        } 
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }
        
         return $message;
    }
    
    public static function kycindex()
    {
        $kycaml = CMS::on('mysql2')->where('id',1)->first();
        
        return $kycaml;
    }

    public static function updateKycaml($request)
    {
        $kyc_aml = $request->kyc_aml;
        $kyc_aml_azn = $request->kyc_aml_azn;
        $kyc_aml_rus = $request->kyc_aml_rus;
        if($kyc_aml !='' && $kyc_aml_azn != '' && $kyc_aml_rus != '')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['kyc_aml' => $kyc_aml,'kyc_aml_azn' => $kyc_aml_azn,'kyc_aml_rus' => $kyc_aml_rus]);

            if($update)
            {
                $message = "Updated Successfully!";
            }
        } 
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }
       
        return $message;
    }

    public static function updatePrivacy($request)
    {
        $privacy_policy = $request->privacy;

        if($privacy_policy !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['privacy_policy' => $privacy_policy]);

            if($update)
            {
                $message = "Updated Successfully!"; 
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateAbout($request)
    {
    	$aboutus = $request->aboutus;

        if($aboutus !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['aboutus' => $aboutus]);
            if($update)
            {
                $message = "Updated Successfully!";
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateMeta($request){

        $title = $request->title;
        $keyword = $request->keyword;
        $desc = $request->desc;

        if($title != '' && $keyword != '' && $desc != ''){
            $update = CMS::on('mysql2')->where('id', 1)->update(['title' => $title, 'keyword'=> $keyword, 'desc'=> $desc]);
            $message = "Updated Successfully!";
        }else{
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;

        }

        
    }
