@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
  <header class="content__title">
    <h1>FAQ</h1>   
  </header>
  @if ($message = Session::get('success'))
    <div class="alert alert-info">{{ $message }} </div><br />
  @endif
  <div class="card">
    <div class="card-body">
	<div class="row">
			  <div class="col-md-3 col-sm-8 col-12">                
			<!-- 	  <select class="form-control" id="status">
						<option value="All">select your language</option>
						<option value="en">English</option>
						<option value="loas">Loas</option>
						<option value="rus">Russian</option> 
						<option value="azn">Azerbaijani</option> 
				  </select> -->
			</div>
			 <div class="col-md-9 col-sm-4 col-12 rightbtnboxcard">   
			 <a href="{{ url('admin/faq_add') }}" class="addbtns btn btn-success">Add</a>
			 </div>
        </div>
      <div class="table-responsive search_result">

      <div class="tab-content">
        <div class="tab-pane fade in active show">
          <div id="history"></div>
        </div>
      </div>

 <!--        @if($faq->count())
        <table class="table" id="dows">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Language</th>
              <th>Header</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($faq as $key => $user)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $user->lang }}</td>
              <td>{{ $user->heading }}</td>
              <td><a class="btn btn-success btn-xs" href="{{ url('admin/faq_edit/'.$user->id) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else 
        {{ 'No record found! ' }}
        @endif -->
      </div>
    </div>
  </div>
</div>
</div>
</section>


<script type="text/javascript">
  $(document).ready(function() {
        history_search()
    });

  $('#status').on('change', function(event){ 
        history_search()
    });

  function history_search(){
      $.ajax({
      url: '{{ url("/admin/faq_ajax_search") }}',
      type: 'POST',
      data: {
        "_token": "{{ csrf_token() }}",
        "status": 'en'
      }, 
      success: function (data) {
        $('#history').html(data); 
      },
    }); 
  };
</script>

@endsection


