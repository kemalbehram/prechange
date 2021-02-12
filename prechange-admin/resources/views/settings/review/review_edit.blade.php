@extends('layouts.header')
@section('title', 'FAQ - Admin')
@section('content')
<section class="content">
  <div class="">
    <header class="content__title">
      <h1>Review Settings</h1>
    </header>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ url('admin\review_update') }}">
        {{ csrf_field() }} 
        <input type="hidden" name="id" value="{{ $faq->id }}">
            <div class="row">

    <!--     <div class="col-md-3">
            <div class="form-group">
              <label>Select your language</label>
            </div>
         </div> -->


        </div>
  <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>Name</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="heading" class="form-control" value="{{ $faq->name }}">
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <textarea name="description" class="form-control" style="line-height: 30px;" rows=5>{{ $faq->description }}</textarea>
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>  
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-4">
               <button class="btn btn-md btn-warning" type="submit"> Update</button><br /><br />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
  