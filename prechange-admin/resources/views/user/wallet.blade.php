@extends('layouts.header')
@section('title', ' BTC - Admin Wallet')
@section('content')
<section class="content">
	<header class="content__title">
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5>User Wallet Details</h5><br />
					@if(session('updated_status'))
					    <div class="alert alert-success">
                              {{ session('updated_status') }}
                        </div>
					@endif
					<form method="post" autocomplete="off" id="send_form" action="{{ url('admin/update_wallet') }}">
						{{ csrf_field() }}
						<input type="hidden" name="user_id" value="{{$uid}}" />
					@foreach($coins as $coin_list)		
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>{{$coin_list['source']}} Address</label>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<input type="text" name="from_address" class="form-control" value="{{ $address[$coin_list['source']] }}" ><i class="form-group__bar"></i> 
								</div>
							</div>
						</div> 
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>{{$coin_list['source']}} Available Balance</label>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<input type="text" name="{{$coin_list['source']}}_balance" class="form-control" value="{{ userBalance($uid,$coin_list['source']) }}" ><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						@endforeach
					<!-- 	<div class="form-group">
							<button type="submit" name="update_balance" class="btn btn-light"><i class=""></i> Update Balance</button>
						</div> -->
					</form>

					<h4>Balance Update</h4>
					<form action="{{ url('/admin/update_wallet') }}" method="POST">
					{{ csrf_field() }}

					</br>
					<div class="row">
						<div class="col-md-3">
						<div class="form-group">
						<label>Coin/Currency</label>
						</div>
						</div>
						<div class="col-md-5">
						<div class="form-group">

							<select class="form-control" name="coin">
								<option value="" >Select coin/currency</option>
								@foreach ($coins as $value)
								<option value="{{ $value->source }}">{{ $value->source }}</option>
								@endforeach
							</select>
						@if ($errors->has('coin'))
							<span class="help-block error-msg">
								<strong>{{ $errors->first('coin') }}</strong>
							</span>
							@endif
						</div>
						</div>
					</div>

							<div class="row">
						<div class="col-md-3">
						<div class="form-group">
						<label>Amount </label>
						</div>
						</div>
						<div class="col-md-5">
						<div class="form-group">

							<input type="number" name="amount" class="form-control" value="" step="0.00001" min="0" max="100000000"><i class="form-group__bar"></i>

							<input type="hidden" name="uid" value="{{$uid}}">



							@if ($errors->has('amount'))
							<span class="help-block error-msg">
								<strong>{{ $errors->first('amount') }}</strong>
							</span>
							@endif
						</div>
						</div>
					</div>
						<input class="btn btn-success btn-xs" type="submit" name="submit" value="Update">

					</form>


				</div>
			</div>
		</div>
	</div>
@endsection