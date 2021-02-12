@extends('layouts.header')
@section('title', ' Trade History')
@section('content')
<section class="content">
	<div class="card">
		<div class="card-body conts">
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-uppercase maginf">Buy Trade History</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 tg-select-left">
					<select class="form-control custom-s-left" onchange="pageredirect(this)">
                        <option value="{{ url('admin/buy_tradehistory/'.$tradepair->coinone.'_'.$tradepair->cointwo.'/limit') }}" @if($order_type==1) selected @endif>Limit</option>
                        <option value="{{ url('admin/buy_tradehistory/'.$tradepair->coinone.'_'.$tradepair->cointwo.'/market') }}" @if($order_type==2) selected @endif>Market</option>
                    </select>
				</div>
				<div class="col-md-6 tg-select">
					
					<select onchange="location = this.value;" class="form-control custom-s">
                    @if(isset($pairs))
                        <option value="{{ url('admin/buy_tradehistory/'.$tradepair->coinone.'_'.$tradepair->cointwo.'/limit') }}">{{ $tradepair->coinone }} / {{ $tradepair->cointwo }}</option>
                        @foreach($pairs as $coinones) 
	                        @if($coinones->coinone.'_'.$coinones->cointwo != $tradepair->coinone.'_'.$tradepair->cointwo)
	                        	<option value="{{ url('admin/buy_tradehistory/'.$coinones->coinone.'_'.$coinones->cointwo.'/limit') }}">{{ $coinones->coinone }} / {{ $coinones->cointwo }}</option>
	                        @endif
                        @endforeach
                    @endif
                  </select>
				</div>
			</div>
			<div class="tab-content">
				<div id="buyo" class="tab-pane fade in active show">
					<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
					@if($buytrade->count())
						<table class="table" id="dows">
							<thead>
								<tr>
									<th>Date / Time</th>
									<th>User Name</th>
									<th>Price ({{ $tradepair->cointwo }})</th>
									<th>Amount ({{ $tradepair->coinone }}) </th>
									<th>Remaining ({{ $tradepair->cointwo }}) </th>
									<th>Cancelled ({{ $tradepair->coinone }}) </th>
									<th>Total ({{ $tradepair->cointwo }}) </th>
									<th>Trade Fee ({{ $tradepair->cointwo }}) </th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($buytrade as $trade)
								    @php $cancelled = 0.0000; $remaining = $trade->remaining; @endphp
                                    @if($trade->status == 2)
                                        @php $cancelled = $trade->remaining; $remaining = 0.0000 @endphp
                                    @endif
								<tr>
									<td>{{ date('d/m/Y H:i:s A', strtotime($trade->created_at)) }}</td>
									<td>{{ username($trade->uid) }}</td>
									@if($trade->order_type==2)
									<td>{{ number_format($price = markertBuyPrice($trade->id)->price, 8, '.', '') }}</td>
									@else
									<td>{{ number_format($price = $trade->price, 8, '.', '') }}</td>
									@endif
									<td>{{ number_format($trade->volume, 8, '.', '') }}</td>
									<td>{{ number_format($remaining, 8, '.', '') }}</td>
									<td>{{ number_format($cancelled, 8, '.', '') }}</td>
									<td>{{ number_format($price = $trade->value, 8, '.', '') }}</td>
									<td>{{ number_format($trade->fees, 8, '.', '') }}</td>
									<td>@if($trade->status == 0 ) Pending @elseif($trade->status == 2 ) Cancelled @else Completed  @endif</td>
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
                    @if($buytrade->count())
				    {{ $buytrade->links() }}
				@endif
                </div>
              </div>
				</div>
			</div>
		</div>
	</div>

@endsection
<script>
    function pageredirect(self){
	window.location.href = self.value;
}
</script>