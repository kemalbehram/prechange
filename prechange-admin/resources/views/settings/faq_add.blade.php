@extends('layouts.header')
@section('title', 'FAQ - Admin')
@section('content')
<section class="content">
  <div class="">
    <header class="content__title">
      <h1>FAQ Settings</h1>
    </header>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ url('admin\faq_save') }}">
        {{ csrf_field() }} 
            <div class="row">

             <!--      <div class="col-md-3">
                <div class="form-group">
                  <label>Select your language</label>
                </div>
              </div> -->

        <div class="col-md-4"> 
          <div class="form-group">
         <!--  <select class="form-control" id="status" name="language">
            <option value="">select your language</option>
            <option value="en">English</option>
            <option value="loas">Loas</option>
            <option value="rus">Russian</option> 
            <option value="azn">Azerbaijani</option> 
          </select> -->
		    @if ($errors->has('language'))
                    <span class="help-block">
                          <strong>{{ $errors->first('language') }}</strong>
                      </span>
                  @endif
        </div>
          
        </div>
        </div>
 <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Heading</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="heading" class="form-control" >
                  <i class="form-group__bar"></i>
@if ($errors->has('heading'))
                    <span class="help-block">
                          <strong>{{ $errors->first('heading') }}</strong>
                      </span>
                  @endif
				  </div>
                  
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
                  <textarea name="description" class="form-control" style="line-height: 30px;" rows=5>
                  </textarea>
                   @if ($errors->has('description'))
                    <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                  @endif
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
               <button class="btn btn-md btn-warning" type="submit"> Add</button><br /><br />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
  