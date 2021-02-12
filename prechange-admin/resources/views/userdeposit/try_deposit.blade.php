@extends('layouts.header')
@section('title', 'Withdraw History')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>TRY Deposit History</h1>
	</header>
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>Date & Time</th>
							<th>User Name</th>
							<th>Deposited Amount (TRY)</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    @if(count($deposit) > 0)
						@foreach($deposit as $transactions)
						<tr>
							<td>{{ date('Y/m/d h:i:s', strtotime($transactions->created_at)) }}</td>
							<td>{{ username($transactions->uid) }}</td>
							<td>{{ number_format($transactions->amount, 2, '.', '') }}</td>
							<td>
							    @if($transactions->status == 0) Waiting for admin confirmation
                                @elseif($transactions->status == 2) Rejected by admin
                                @elseif($transactions->status == 3) Cancelled by user
                                @else Approved by admin @endif
							</td>
							<td>
							@if($transactions->status == 0)
							<a class="btn btn-success btn-xs" href="{{ url('admin/try_deposit_edit/'.Crypt::encrypt($transactions->id)) }}"><i class="zmdi zmdi-edit"></i> View </a> 
							@else
							 	--
							@endif
							</td>
						</tr>
					@endforeach
					@else
					    <tr><td colspan="7"> No record found!</td></tr>
					@endif
					</tbody>
				</table>
				@if(count($deposit) > 0)
				    {{ $deposit->links() }}
				@endif
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
@endsection