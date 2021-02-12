<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

      public static function saveReview($request)
    {
    	$features = new Review();
    	$features->setConnection('mysql2');
        $features->name = $request->heading;
        $features->description = $request->description;
        $features->save(); 

        return true;
    }

    public static function edit($id)
    {
    	$faq = Review::on('mysql2')->where('id',$id)->first(); 

    	return $faq;
    }

    public static function faqUpdate($request)
    {
    	$features = Review::on('mysql2')->where('id',$request->id)->first();
        $features->name = $request->heading;
        $features->description = $request->description;
        $features->save(); 

        return $faq='Updated Successfully';
    }
}
