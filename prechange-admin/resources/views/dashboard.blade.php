@extends('layouts.header')
@section('title', 'Admin Dashboard')
@section('content') 
<section class="content">
    <header class="content__title">
        <h1>Dashboard</h1>
    </header>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Trade History</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Date / Time</th>
                    <th>User Name</th>
                    <th>Price </th>
                    <th>Amount  </th>
                    <th>Remaining  </th> 
                    <th>Total  </th>
                    <th>Trade Fee</th>
                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($history))
                                                @foreach($history as $trade)
                                                <tr>
                                                    <td>{{ date('d/m/Y', strtotime($trade->created_at)) }}</td>
                    <td>{{ username($trade->uid) }}</td>
                    <td>{{ number_format($trade->price, 8, '.', '') }}</td>
                    <td>{{ number_format($trade->volume, 8, '.', '') }}</td>
                    <td>{{ number_format($trade->remaining, 8, '.', '') }}</td> 
                    <td>{{ number_format($trade->value, 8, '.', '') }}</td>
                    <td>{{ number_format($trade->fees, 8, '.', '') }}</td>
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
                                                @else
                                                <tr><td colspan="6"> No Record Found!</td></tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                 
                        </div>
              
                    </div>
                </section>
@endsection