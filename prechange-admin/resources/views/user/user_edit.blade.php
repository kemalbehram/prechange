@extends('layouts.header')
@section('title', 'Users List - Admin')
@section('content')
<section class="content">
	<header class="content__title"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<h1>View User Details</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/users') }}"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
					<br /><br />
					@if(session('updated_status'))
					    <div class="alert alert-success">
                              {{ session('updated_status') }}
                        </div>
					@endif
					<form method="post" action="{{ url('admin/update_user') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $userdetails->id }}" name="id">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Full Name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="fname" class="form-control" value="{{ $userdetails->name != NULL ? $userdetails->name : '' }}"/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Email ID</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="email" name="email" class="form-control" value="{{ $userdetails->email }}" /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="country">
									@if($userdetails->country == '')
										<option value=""></option> 
										@foreach(country() as $countrys)
										<option value="{{ $countrys->id }}" @if($countrys->id == $userdetails->country ) {{ selected }} @else {{ '' }}>{{ $countrys->name }}@endif</option> 
										@endforeach
									@else 
										@foreach(country() as $countrys)
											<option value="{{ $countrys->id }}" @if($countrys->id == $userdetails->country ) {{ "selected" }} @else {{ '' }}@endif>{{country_name($countrys->id)->name
											}}</option> 
										@endforeach
									@endif
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Phone No</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="phone" class="form-control" value="{{ $userdetails->phone }}" /><i class="form-group__bar"></i>
								</div>

							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								    <textarea class="form-control" rows="3" cols="10" name="address">{{ $userdetails->address }}</textarea>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Email Verified</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="form-group">
										<input type="text" name="emailcheck" class="form-control" value="{{ $userdetails->email_verify == 1 ? 'Verified' : 'Not Verified' }}" disabled/><i class="form-group__bar"></i>
									</div>										
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection