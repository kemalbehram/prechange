@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
  <header class="content__title">
    <h1>Review</h1>   
  </header>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }} </div><br />
  @endif
  <div class="card">
    <div class="card-body">
  <div class="row">
        <div class="col-md-3 col-sm-8 col-12">                
      <!--    <select class="form-control" id="status">
            <option value="All">select your language</option>
            <option value="en">English</option>
            <option value="loas">Loas</option>
            <option value="rus">Russian</option> 
            <option value="azn">Azerbaijani</option> 
          </select> -->
      </div>
       <div class="col-md-9 col-sm-4 col-12 rightbtnboxcard">   
       <a href="{{ url('admin/partner_add') }}" class="addbtns btn btn-success"><i class="zmdi zmdi-plus"></i> Add</a>
       </div>
        </div>
      <div class="table-responsive search_result">

      <div class="tab-content">
        <div class="tab-pane fade in active show">
          <div id="history"></div>
        </div>
      </div>

        @if($faq->count())
        <table class="table" id="dows">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($faq as $key => $user)
            <tr>
              <td>{{ $key+1 }}</td>
      
              <td><img src="{{ $user->image}}" width="65px" height="50px"></td>
              <td>
                <a class="btn btn-success btn-xs" href="{{ url('admin/partner_delete/'.$user->id) }}"><i class="zmdi zmdi-delete"></i> Delete </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else 
        {{ 'No record found! ' }}
        @endif
      </div>
    </div>
  </div>
</div>
</div>
</section>




@endsection


