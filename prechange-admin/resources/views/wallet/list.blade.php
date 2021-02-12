@extends('layouts.header')
@section('title', 'Admin Dashboard')
@section('content') 
<section class="content">
    <header class="content__title">
        <h1>Admin Wallet</h1>
    </header>
    <div class="row quick-stats listview2">
        <div class="col-sm-6 col-md-6">
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    <h2 class="h2">Btc</h2>
                    <div class="walletinfo">
                    <h4 class="h4">Wallet Address : {{ $address['BTC']}}</h4> 
                     <h4 class="h4">Balance :{{ number_format($balance['BTC'],8)}}</h4> 
                     </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i><img src="{{ url('images/btc.png') }}" class="btcicon" /></i></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    <h2 class="h2">Eth</h2>
                    <div class="walletinfo">
                    <h4 class="h4">Wallet Address : {{ $address['ETH']}}</h4> 
                     <h4 class="h4">Balance : {{ number_format($balance['ETH'],8)}}</h4> 
                     </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i><img src="{{ url('images/eth.png') }}" class="btcicon" /></i></h1>
                    </div>
                </div>
            </div>
                <div class="col-sm-6 col-md-6">
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    <h2 class="h2">Xrp</h2>
                    <div class="walletinfo">
                    <h4 class="h4">Wallet Address : {{ $address['XRP']}}</h4> 
                     <h4 class="h4">Balance : {{ number_format($balance['XRP'],8) }}</h4> 
                     </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <h1><i><img src="{{ url('images/xrp.png') }}" class="btcicon" /></i></h1>
                    </div>
                </div>
            </div>

                    
                    </div>

                </section>
@endsection