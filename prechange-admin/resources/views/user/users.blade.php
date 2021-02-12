@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<h1>Users</h1>
	</header>
	<div class="card">
		<div class="card-body">
		    <form action="{{ url('/admin/users/search') }}" method="post" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-3">                
						<input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email">
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="{{ url('admin/users') }}"> Reset </a> 
					</div>
						<div class="col-md-3">
						<input type="button" id="btnExport" class="btn btn-success user_date" value="Export To Excel" />  

					</div>
				</div>
			</form>
			<br/>
			<br/>

			@if(session('status'))
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{ session('status') }}
				</div>
			@endif

			@if($details)
    			<h5> Total Users : {{ count($details) }} </h5>
    			<hr />
    		@endif
			<div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>Joining Date</th>
							<!-- <th>Full Name</th> -->
							<th>Email ID</th>
							<th>Email Verify</th>
							<th>Kyc Verify</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
					    @if(isset($details) > 0)
					@foreach($details as $user)
						<tr>
							<td>{{ date('Y/m/d h:i:s', strtotime($user->created_at)) }}</td>
							<!-- <td>{{ $user->name }}</td> -->
							<td>{{ $user->email }}</td>
							<td>@if($user->email_verify == 1) Yes @elseif($user->email_verify == 2) Waiting @else No @endif</td>
							<td>@if($user->kyc_verify == 1) Yes @elseif($user->kyc_verify == 2) Waiting @else No @endif</td>
							<td><a class="btn btn-success btn-xs" href="{{ url('/admin/users_edit/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-edit"></i> View </a>
							<!--@if($user->email_verify == 0)-->
							<!--	<a href="javascript:void(0)" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#remainder-email" data-href="{{ url('/admin/sendEmail/'.Crypt::encrypt($user->id)) }}">Send Verification Email</a>-->
							<!--@endif-->
						<!-- 	<a class="btn btn-success btn-xs" href="{{ url('/admin/users_wallet/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-edit"></i> Wallet </a> -->
							 <!-- <a class="btn btn-primary btn-xs" href="{{ url('/admin/addBalance/'.Crypt::encrypt($user->id)) }}"><i class="zmdi zmdi-plus"></i> Add Balance </a> --></td>
						</tr>
					@endforeach
					@else
					    <tr><td colspan="7"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                @if($details->count())
				    {{ $details->links() }}
				@endif
                </div>
              </div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade site-modal" id="remainder-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Send Verification Email</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				Are you sure, do you want to send verification link to user?
			</div>
			<div class="modal-footer">
				<a class="btn btn-success btn-ok">Yes</a>
				<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">  
$("#btnExport").click(function (e) {
    //getting values of current time for generating the file name
    var dt = new Date();
    var day = dt.getDate();
    var month = dt.getMonth() + 1;
    var year = dt.getFullYear();
    var hour = dt.getHours();
    var mins = dt.getMinutes();
    var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
    //creating a temporary HTML link element (they support setting file names)
    var a = document.createElement('a');
    //getting data from our div that contains the HTML table
    var data_type = 'data:application/vnd.ms-excel;charset=utf-8';
    
    var table_html = $('#dows')[0].outerHTML;
//    table_html = table_html.replace(/ /g, '%20');
    table_html = table_html.replace(/<tfoot[\s\S.]*tfoot>/gmi, '');
    
    var css_html = '<style>td {border: 0.5pt solid #c0c0c0} .tRight { text-align:right} .tLeft { text-align:left} </style>';
//    css_html = css_html.replace(/ /g, '%20');
    
    a.href = data_type + ',' + encodeURIComponent('<html><head>' + css_html + '</' + 'head><body>' + table_html + '</body></html>');
    
    //setting the file name
    a.download = 'Koboex_users' + postfix + '.xls';
    //triggering the function
    a.click();
    //just in case, prevent default behaviour
    e.preventDefault();
});
</script>  

@endsection




