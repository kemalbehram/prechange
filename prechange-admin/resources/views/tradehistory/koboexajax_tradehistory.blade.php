<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
	@if(count($trades)>0)
		<table class="table" id="dows">
			<thead>
				<tr>
					<th>Date / Time</th>
					<th>User Name</th>
					<th>txid </th>
					<th>Changelly Fee  </th>
					<th>Payin Address  </th> 
					<th>Payout Address  </th>
					<th>Receive Amount </th>
					<th>Spend Amount</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($trades as $trade) 
				<tr>
					<td>{{ date('d/m/Y', strtotime($trade->created_at)) }}</td>
					<td>{{ username($trade->uid) }}</td>
				
					<td>{{ $trade->txid }}</td>
					<td>{{ $trade->changelly_fee }}</td>
					<td>{{ $trade->payin_Address }}</td>
					<td>{{ $trade->payout_address }}</td>
					<td>{{ $trade->amount_expected_from.' '.$trade->currency_from }}</td>
					<td>{{ $trade->amount_expected_to.' '.$trade->currency_to }}</td>
				
					<td>
						@if($trade->status == 0 ) 
							Pending 
						@elseif($trade->status == 100 ) 
							Cancelled
						@else 
							Completed 
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else 
			<div class="alert alert-info">Yet no trades available</div>
		@endif
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
<div class="pagination-tt clearfix">
    @if($trades->count())
    	{{ $trades->links() }}
	@endif
</div>
</div>