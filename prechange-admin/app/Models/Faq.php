<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public static function saveFaq($request)
    {
    	$features = new Faq();
    	$features->setConnection('mysql2');
        $features->lang = 'en';
        $features->title = $request->heading;
        $features->description = $request->description;
        $features->save(); 

        return true;
    }

    public static function edit($id)
    {
    	$faq = Faq::on('mysql2')->where('id',$id)->first(); 

    	return $faq;
    }

    public static function faqUpdate($request)
    {
    	$features = Faq::on('mysql2')->where('id',$request->id)->first();
        $features->title = $request->heading;
        $features->description = $request->description;
        $features->save(); 

        return $faq='Updated Successfully';
    }
}
