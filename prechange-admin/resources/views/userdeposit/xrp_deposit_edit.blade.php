@extends('layouts.header')
@section('title', 'Deposit History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>XRP Deposit History</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="{{ url('admin/deposits/XRP') }}"><i class="zmdi zmdi-arrow-left"></i> Back to withdraw history</a>
					<br /><br />
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> {{ session('status') }}
                        </div>
                    @endif
				     <form method="post" id="currency_form" action="{{ url('admin/xrp_deposit_update') }}" autocomplete="off" onsubmit="btn_update.disabled = true; return true;">
				     <input type="hidden" name="id" value="{{ $deposit->id }}">
				     <input type="hidden" name="user_id" value="{{ $deposit->user_id }}">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>User Name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="recipient" class="form-control" value="{{ username($deposit->user_id) }}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Recipient Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="recipient" class="form-control" value="{{ $deposit->recipient}}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Sender Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="recipient" class="form-control" value="{{ $deposit->sender }}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="amount" class="form-control" value="{{ $deposit->amount }}" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Status</label>
								</div>
							</div>
							@if($deposit->status == 1)
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="status">
										<option value="0">Waiting for approval</option>
										<option value="2">Approved</option>
										<option value="3">Rejected</option>
									</select>
								</div>
							</div>
							@else
							<div class="col-md-4">
								<div class="form-group">
									@if($deposit->status == 2)
										Approved 
									@else
										Rejected
									@endif
								</div>
							</div>
							@endif
							<p class="text text-info">NOTE : Once you update the status as "Approved / Rejected", you can't update status again!</p>
						</div>
						@if($deposit->status == 1)
							<div class="form-group">
								<button type="submit" name="edit" id="btn_update" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection