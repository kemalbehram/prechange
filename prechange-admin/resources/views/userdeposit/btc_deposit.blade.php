@extends('layouts.header')
@section('title', 'BTC List - Admin')
@section('content')
<section class="content">
	<header class="content__title">
		<h1>BTC Deposit History</h1>
	</header>
	<div class="card">
		<div class="card-body">
		<div class="table-responsive search_result">
				@if($depositList->count())
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>User Name</th>
							<th>Recipient</th>
							<th>Sender</th>
							<th>Amount</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody> 
					@foreach($depositList as $key => $histroy)
						<tr>
							<td>{{ $key+1 }}</td>
							<td>{{ date('m-d-Y', strtotime($histroy->created_at)) }}</td>
							<td><a href="{{ url('admin/users_edit/'.Crypt::encrypt($histroy->user_id)) }} ">{{ username($histroy->user_id) }}</a></td>
							<td>{{ $histroy->recipient }}</td>
							<td>{{ $histroy->sender }}</td>
							<td>{{ $histroy->amount }}</td>
							<td>
								@if($histroy->status == 1)
								  Pending
								@elseif($histroy->status == 2)
								   Success
								@else
									Waiting for user request
								@endif
							</td>
						</tr> 
					@endforeach
					</tbody>
				</table>
				@else 
					{{ 'No record found! ' }}
				@endif
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    @if($depositList->count())
				    {{ $depositList->links() }}
				@endif
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
@endsection


