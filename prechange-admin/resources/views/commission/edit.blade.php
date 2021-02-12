@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>Commission Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/commission') }}"><i class="zmdi zmdi-arrow-left"></i> Back to Commission</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
					<form method="post" action="{{ url('admin/commissionupdate') }}" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" value="{{ $commission->id }}" name="id">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin / Currency</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="{{ $commission->source != NULL ? $commission->source : '0' }}" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
				<!-- 		<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Withdraw Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="withdraw" class="form-control" value="{{ $commission->withdraw != NULL ? $commission->withdraw : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('withdraw'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('withdraw') }}</strong>
					                    </span>
					                @endif
								</div>
							</div> 
						</div>  -->
								<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="buy" class="form-control" value="{{ $commission->trade != NULL ? $commission->trade : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('buy'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('buy') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div>
				<!-- 		<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade Buy Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="buy" class="form-control" value="{{ $commission->buy_trade != NULL ? $commission->buy_trade : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('buy'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('buy') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div> -->
					<!-- 	<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade Sell Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="sell" class="form-control" value="{{ $commission->sell_trade != NULL ? $commission->sell_trade : '0' }}"/><i class="form-group__bar"></i>
									@if ($errors->has('sell'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('sell') }}</strong>
					                    </span>
				                	@endif
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection