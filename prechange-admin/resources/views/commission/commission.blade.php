@extends('layouts.header')
@section('title', 'Commission Settings')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
          <h4 class="card-title">Commission Settings </h4>
            <div class="table-responsive">
           
              @if(count($commissions))
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <!-- <th>Withdraw Commission</th> -->
                    <!-- <th>Trade Buy Commission</th> -->
                    <th>Trade</th>
                    <!-- <th>Trade Sell Commission</th> -->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                @foreach($commissions as $key => $commission)
                    @if($commission->source == 'BTC' || $commission->source == 'ETH')
                        @php $decimal = 8; @endphp
                    @else
                        @php $decimal = 2; @endphp
                    @endif
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $commission->source }}</td>
                    <!-- <td>{{ number_format($commission->withdraw, $decimal, '.', '') }}</td> -->
                    <td>{{ number_format($commission->trade, $decimal, '.', '') }}</td>
                    <td>
                      @if($commission->status == 0)
                          Disable
                      @else
                          Enable
                      @endif
                    </td>
                    <td><a href="{{ url('/admin/commissionsettings', Crypt::encrypt($commission->id)) }}" class="btn btn-info">View / Edit</a></td>
                    
                  </tr>
                @endforeach
                </tbody>
              </table>
              {{ $commissions->links() }}
              @else
                {{ 'No Commissions Settings' }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection