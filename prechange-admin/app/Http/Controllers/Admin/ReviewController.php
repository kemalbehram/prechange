<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function review()
    {
    	 $review = Review::on('mysql2')->get();

        return view('settings.review.review')->with('faq',$review);
    }

    public function review_add()
    {
    	 return view('settings.review.review_add');
    }

    public function review_save(ReviewRequest $request)
    { 

    	$faq = Review::saveReview($request);

        return redirect('admin/review')->with('success','Added Successfully');;
    }

    public function review_edit($id)
    {
    	 $faq = Review::edit($id);

        return view('settings.review.review_edit')->with('faq',$faq);
    }

    public function review_update(Request $request)
    { 
    	$faq = Review::faqUpdate($request); 

        return redirect('admin/review')->with('success',$faq);
    }

}
