@include('layouts.header')

<section class="user">
    <div class="container">

        <div class="coin_balance">
            <ul class="list-inline">
                <li class="list-inline-item"><img src="images/btc.png" alt="" class="img-fluid"> BTC/USD: 18798.27 /
                17307.57 USD </li>
                <li class="list-inline-item"><img src="images/ltc.png" alt="" class="img-fluid"> LTC/USD: 80.73 /
                73.63 USD </li>
                <li class="list-inline-item"><img src="images/btc_ltc.png" alt="" class="img-fluid">BTC/LTC: 235.27
                / 221.37 LTC </li>
            </ul>
        </div>

        <h3>Profile</h3>

        <div class="col-md-10 col-lg-10 m-auto">

            <div class="user_frm">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Profile</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="exchange-tab" data-toggle="tab" href="#exchange" role="tab"
                        aria-controls="exchange" aria-selected="true">Exchange</a>
                    </li>
<!-- 
<li class="nav-item" role="presentation">
<a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab"
aria-controls="payments" aria-selected="false">Payments</a>
</li> -->

<li class="nav-item" role="presentation">
    <a class="nav-link" id="referrals-tab" data-toggle="tab" href="#referrals" role="tab"
    aria-controls="referrals" aria-selected="false">Referrals</a>
</li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel"
    aria-labelledby="profile-tab">

    <div class="pro_bx">
        <p> Welcome back, {{ $user->email }}! <br>
            <!-- Your balance: 0 USD or 0 BTC as of the current moment. -->
        </p>

        <h4>Account Information</h4>

        <div class="row">

            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <span class="pre_text">Email Address</span>
                    <input type="text" class="form-control" placeholder="Calum@gfxdistrict.com" readonly="readonly" value="{{ $user->email }}">
                </div>
            </div>

       <!--      <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <span class="pre_text">User Name</span>
                    <input type="text" class="form-control" placeholder="Calum" value="{{ $user->email }}">
                </div>
            </div> -->

        </div>

        <h4>Change Password</h4>

        @include('layouts.message')


        <form action="{{ url('change-password') }}" method="POST" id="myForm">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <span class="pre_text">Current Password</span>
                        <input name="oldpassword" id="oldpassword" class="form-control" value="" type="password" required="">

                        @if ($errors->has('oldpassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldpassword') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <span class="pre_text">New Password</span>
                        <input name="newpassword" id="newpassword" class="form-control" value="" type="password" required="">

                        @if ($errors->has('newpassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('newpassword') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <span class="pre_text">Confirm Password</span>
                        <input name="confirmpassword" id="confirmpassword" class="form-control" value="" type="password" required="">

                        @if ($errors->has('confirmpassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('confirmpassword') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <!-- <a href="#" class="frm_btn"> </a> -->
                        <button class="frm_btn" type="submit" href="#"><span>Change Password</span></button>  
                    </div>
                </div>

            </div>


        </form>



    </div>

</div>
<div class="tab-pane fade" id="exchange" role="tabpanel" aria-labelledby="exchange-tab">

    <div class="pro_bx">

        <P>You have made {{ $completed_count }} successful exchanges, turnover amount: 0 USD</P>

        <!-- <p>Your discount: 3%</p> -->

        <!-- <p>For each 5000$ of turnover, your discount will increase by 1%</p> -->

        <!-- <p>Maximally possible discount - 20%</p> -->

        <h4>Exchange History</h4>

        <div class="page_table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Exchange Sum</th>
                        <th>Rate</th>
                        <th>Account</th>
                        <th>Status</th>
                        <!-- <th>Link</th> -->
                    </tr>
                </thead>
                <tbody>

                    @foreach($tradehistory as $key => $history)

                        <tr>
                        <td>{{ $history->txid}}</td>
                        <td>{{$history->amount_expected_from}} {{$history->currency_from}} to {{$history->amount_expected_to}} {{$history->currency_to}}</td>
                        <td>235.27</td>
                        <td>{{ $history->payout_address }}</td>
                        <td>  @if($history->status == 0)
                                    Pending
                              @elseif($history->status == 1)
                                  Completed
                              @elseif($history->status == 100)
                                  Cancelled
                              @else
                                  invalid
                              @endif
                        </td>
                        <!-- <td><a href="#">Open Link</a></td> -->
                    </tr>

                    @endforeach
            

                </tbody>
            </table>
        </div>


    </div>

</div>

<div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">

    <div class="pro_bx">

        <P>Minimal sum for payment is 0.50 USD.</P>


        <h4>Payments History</h4>

        <div class="page_table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Payment Sum</th>
                        <th>Rate</th>
                        <th>Account</th>
                        <th>Status</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1234567</td>
                        <td>40.1234 LTC to 0.18234 BTC</td>
                        <td>235.27</td>
                        <td>3FZbgi29cpjq2GjdwV8eyHuJJnkLtktZc5</td>
                        <td>Complete</td>
                        <td><a href="#">Open Link</a></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

</div>

<div class="tab-pane fade" id="referrals" role="tabpanel" aria-labelledby="referrals-tab">


    <div class="pro_bx">


        <h4>Referral Information</h4>

        <div class="row">

            <div class="col-md-5 col-lg-5">
                <div class="form-group">
                    <span class="pre_text">Your Referral Link</span>
                    <input type="text" class="form-control"
                    placeholder="https://prechange.is/?r=12345">
                </div>
            </div>


        </div>


        <P>Your percent: 20%</P>

        <p>Your link was followed by 1 visitors, who made 0 exchanges, totally earned 0 USD,
        paid 0 USD.</p>

        <p>XML Rates: https://prechange.is/rates</p>

        <h4>Accruals History</h4>


        <div class="col-md-7 col-lg-7">

            <div class="acc_table table-responsive">
                <table class="table">

                    <tbody>
                        <tr>
                            <td>2020-11-21 15:30:52 </td>
                            <td>+-0.0001 USD</td>
                            <td>-0.0001 USD</td>
                        </tr>

                        <tr>
                            <td>2020-11-21 15:30:52 </td>
                            <td>+-0.0001 USD</td>
                            <td>-0.0001 USD</td>
                        </tr>

                        <tr>
                            <td>2020-11-21 15:30:52 </td>
                            <td>+-0.0001 USD</td>
                            <td>-0.0001 USD</td>
                        </tr>



                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>
</div>

</div>

</div>


</div>
</section>
@include('layouts.footer')