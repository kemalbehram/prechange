@include('layouts.header')

    <section class="banner">
        <div class="container">

            <div class="coin_balance">
                <ul class="list-inline">
                    <li class="list-inline-item"><img src="images/btc.png" alt="" class="img-fluid"> BTC/USD: 18798.27 / 17307.57 USD </li>
                    <li class="list-inline-item"><img src="images/ltc.png" alt="" class="img-fluid"> LTC/USD: 80.73 / 73.63 USD </li>
                    <li class="list-inline-item"><img src="images/btc_ltc.png" alt="" class="img-fluid">BTC/LTC: 235.27 / 221.37 LTC </li>
                </ul>
            </div>

            <div class="main_banner">

            <div class="row">

            <div class="col-md-6 col-lg-6">
            <div class="banner_txt">
                <h2>EXCHANGE
                    CRYPTOCURRENCY<span>.</span></h2>
                    <p>Instantly exchange and purchase cryptocurrencies 24/7.</p>
                </div> 
            </div>

            <div class="col-md-1 col-lg-1">
                <div class="coin_img"></div>
            </div>

        <div class="col-md-4 col-lg-4">
        <div class="top_frm">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="exchange-tab" data-toggle="tab" href="#exchange" role="tab" aria-controls="exchange" aria-selected="true">Exchange</a>
                </li>
            <!--     <li class="nav-item" role="presentation">
                  <a class="nav-link" id="buy-tab" data-toggle="tab" href="#buy" role="tab" aria-controls="buy" aria-selected="false">Buy</a>
                </li> -->
         <!--        <li class="nav-item" role="presentation">
                  <a class="nav-link" id="sell-tab" data-toggle="tab" href="#sell" role="tab" aria-controls="sell" aria-selected="false">Sell</a>
                </li> -->
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="exchange" role="tabpanel" aria-labelledby="exchange-tab">
                    
                   <div class="frm_div">
                    <div class="selct_div">
                        <span class="currlabel">You send</span>
                        <input maxlength="16" value="0.005" id="exchange_you_send">
                        <div class="currency_div">
                          <div id="myDIV">
                            <div class="my_div">
                             <span class="cur_div">Bitcoin</span>
                              <select class="my-select">
                                   @foreach($coins as $key => $coin)
                                      <option data-img-src="{{ $coin->image }}" value="{{$coin->ticker}}"  @if($coinone == $coin->source) selected="selected" @else @endif>{{$coin->coinname}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                         <span id="exchange_error_response" style="color: red;"></span>

                    <div class="frm_div">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <!-- <p class="values">1 BTC = 35.791784 ETH</p> -->
                              <p class="values">
                                <span id="exchange_coinone_name">1 {{$coinone}}</span>
                                <span id="current_market_price"> ~ 0 </span>
                                <span id="exchange_cointwo_name"> {{$cointwo}} </span> 
                              </p>
                            </div>
                            <div class="col-md-6 col-lg-6">
                               <a href="#"><img src="{{ url('images/switch.png') }}" class="img-fluid"></a> 
                                </div>
                        </div>
                    </div>

                    <div class="frm_div">
                      <div class="selct_div">
                        <span class="currlabel">You receive</span>
                        <input maxlength="16" value="" id="exchange_get_approx">
                        <div class="currency_div">
                          <div id="myDIV">
                            <div class="my_div">
                             <span class="cur_div">Ethereum</span>
                              <select class="my-select">
                                  @foreach($coins as $key => $coin)
                                      <option data-img-src="{{ $coin->image }}" value="{{$coin->ticker}}" 
                                        @if($cointwo == $coin->source) selected="selected" @else @endif>{{$coin->coinname}}</option>
                                  @endforeach   
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>

                      <div class="frm_div">
                        <a href="{{ url('exchange') }}" class=" frm_btn">Exchange now</a>
                      </div>
                </div>
                <div class="tab-pane fade" id="buy" role="tabpanel" aria-labelledby="buy-tab">
                    

                    <div class="by_bxv">
                        <div class="buy_img">
                            <img src="images/btc_buy.png">
                        </div>

                        <h3>I want to buy</h3>

                        
                        <div class="by_frm">
                            <div class="frm_input"><input type="email" class="form-control" placeholder="0.005"></div>
                            <div class="frm_slt">
                                <select class="custom-select">
                                    <option selected>BTC</option>
                                    <option value="1">ETH</option>
                                    <option value="2">LTC</option>
                                  </select>
                            </div>
                        </div>


                    </div>

                    <div class="bal">
                        <div class="amt">0.005 BTC @ $18798.27</div>
                        <div class="val">$93.44</div>
                    </div>

                    <div class="bal">
                        <div class="amt">0.005 BTC @ $18798.27</div>
                        <div class="val">$93.44</div>
                    </div>

                    <hr>

                    <div class="bal">
                        <div class="amt">Total Cost</div>
                        <div class="val blu">$93.99</div>
                    </div>

                    <div class="">
                        <a href="#" class=" frm_btn">Exchange now</a>
                         </div>
                    

                </div>
                <div class="tab-pane fade" id="sell" role="tabpanel" aria-labelledby="sell-tab">.3..</div>
              </div>
        </div>
        </div>

        </div>

        </div>


        </div>
    </section>


    <section class="client_sec section">
        <div class="container">

            <div class="page_tit">
                <h2>What our customers say</h2>
            </div>

            <div class="owl-carousel owl-theme">

                <div class="item">
                    <div class="cli_bx">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniamqat voluptatem.</p>
                        <h5>Username</h5>
                    </div>
                </div>

                <div class="item">
                    <div class="cli_bx">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniamqat voluptatem.</p>
                        <h5>Username</h5>
                    </div>
                </div>

                <div class="item">
                    <div class="cli_bx">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniamqat voluptatem.</p>
                        <h5>Username</h5>
                    </div>
                </div>

                <div class="item">
                    <div class="cli_bx">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniamqat voluptatem.</p>
                        <h5>Username</h5>
                    </div>
                </div>

                <div class="item">
                    <div class="cli_bx">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniamqat voluptatem.</p>
                        <h5>Username</h5>
                    </div>
                </div>


            </div>
        </div>
    </section>


    <section class="service_sec section">
        <div class="container">

            <div class="page_tit">
                <h2>Our Service</h2>
            </div>


            <div class="row">

                <div class="col-md-6 col-lg-6 col-12">
                    <div class="ser_bx d-flex">
                        <img src="images/ic_1.png" alt="">
                        <h3>Best rates on the market</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-12">
                    <div class="ser_bx d-flex">
                        <img src="images/ic_2.png" alt="">
                        <h3>Fast exchange & delivery</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-12">
                    <div class="ser_bx d-flex">
                        <img src="images/ic_3.png" alt="">
                        <h3>High exchange reserves & limits</h3>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-12">
                    <div class="ser_bx d-flex">
                        <img src="images/ic_4.png" alt="">
                        <h3>Secure network delivery</h3>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="faq_sec section" id="faq">
        <div class="container">

            <div class="page_tit">
                <h2>Frequently Asked Questions</h2>
            </div>

            <div class="Accordions">
                <div class="Accordion_item">
                    <div class="title_tab">
                        <h3 class="title">How long should I wait for the confirmation from the Bitcoin network?<span
                                class="icon"><i class="fa fa-sort-desc"></i></span></h3>
                    </div>
                    <div class="inner_content">
                        <p>
                            <span>1 confirmation. Estimated 10 minutes. More information about the confirmation from the
                                network you can find here.</span><br>
                        </p>
                    </div>
                </div>

                <div class="Accordion_item">
                    <div class="title_tab">
                        <h3 class="title">Which guarantee do you provide that my exchange request will be
                            completed?<span class="icon"><i class="fa fa-sort-desc"></i></span></h3>
                    </div>
                    <div class="inner_content">
                        <p>
                            <span>1 confirmation. Estimated 10 minutes. More information about the confirmation from the
                                network you can find here.</span><br>
                        </p>
                    </div>
                </div>


                <div class="Accordion_item">
                    <div class="title_tab">
                        <h3 class="title">Which guarantee do you provide that my exchange request will be
                            completed?<span class="icon"><i class="fa fa-sort-desc"></i></span></h3>
                    </div>
                    <div class="inner_content">
                        <p>
                            <span>1 confirmation. Estimated 10 minutes. More information about the confirmation from the
                                network you can find here.</span><br>
                        </p>
                    </div>
                </div>


            </div>

        </div>
    </section>


<!-- login -->


@php 
  $register = '';
  $login    = '';
  $logindis ='display:none';

if($errors->has('loginemail') || $errors->has('loginpassword') || $errors->has('logincode')  || session('errorstatus')){

  $login = 'show'; 
  $register = '';
  $logindis =  'display: block; padding-right: 16px;';

} 

 else {

  $login = ''; 
  $register = '';
  $logindis ='display:none';
 
}
@endphp


<div class="modal fade page_modal {{ $login }}" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="{{ $logindis }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

  @include('layouts.message')
         <form action="{{ url('userlogin') }}" method="POST">

              {{ csrf_field() }}
         
       
            <div class="form-group">
                <span class="pre_text">Username</span>
                <span class="after_text">
                    <!-- <a href="#">Forgot Username?</a> -->
                </span>
                <input type="text" class="form-control" placeholder="" name="loginemail">

                     @if ($errors->has('loginemail'))
                      <span class="help-block">
                        <strong>{{ $errors->first('loginemail') }}</strong>
                      </span>
                    @endif
              </div> 

              <div class="form-group">
                <span class="pre_text">Password</span>
                <span class="after_text">
                    <!-- <a href="#">Forgot password?</a> -->
                </span>
                <input type="password" class="form-control" placeholder="*************" name="loginpassword">

                  @if ($errors->has('loginpassword'))
                      <span class="help-block">
                        <strong>{{ $errors->first('loginpassword') }}</strong>
                      </span>
                    @endif
              </div> 

              <div class="form-group">
                <span class="pre_text"></span>
                <span class="after_text"></span>
                 <!-- <a href="#" style="float: right;"></a> -->
                 <a class="nav-link" href="#" data-toggle="modal" data-target="#forgot-password" data-dismiss="modal" style="float: right;">Forgot password?</a>
              </div> 

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                             <input type="hidden" name="originalcode" value="{{ $random }}">
                  <span class="input-group-text" id="basic-addon1">{{ $random }}</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="logincode">
              </div>
                @if ($errors->has('logincode'))
                      <span class="help-block">
                        <strong>{{ $errors->first('logincode') }}</strong>
                      </span>
                    @endif

              <div class="">
                <!-- <a href="#" class="frm_btn">Login</a> -->
                    <button class="frm_btn" type="submit" href="#"><span>Login</span></button>  
                 </div>
             </form>
        </div>
      </div>
    </div>
  </div>

  <!-- register -->

@php 
  $register = '';
  $login    = '';
  $signupdis ='display:none';

if($errors->has('email') || $errors->has('password') || $errors->has('password_confirmation') || session('registerstatus')  || $errors->has('validcode')){

  $login = ''; 
  $register = 'show';
  $signupdis =  'display: block; padding-right: 16px;';

} 

 else {

  $login = 'show'; 
  $register = '';
  $signupdis ='display:none';
 
}
@endphp



<div class="modal fade page_modal {{$register}}" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="{{ $signupdis }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  @include('layouts.message')

          <form action="{{ url('userregister') }}" method="POST">
            {{ csrf_field() }}
       
            <div class="form-group">
                <span class="pre_text">Email Address</span>
              
                <input type="text" class="form-control" placeholder="" name="email">

                @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                @endif
              </div> 

              <div class="form-group">
                <span class="pre_text">Password</span>
                <input type="password" class="form-control" placeholder="" name="password">
                  @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
              </div> 

              <div class="form-group">
                <span class="pre_text">Confirm Password</span>
                <input type="password" class="form-control" placeholder="" name="password_confirmation">

                   @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                    @endif
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">{{ $random }}</span>
                </div>
                <input type="hidden" name="originalcode" value="{{ $random }}">
                <input type="text" class="form-control" placeholder=""  name='validcode'>
              </div>
                @if ($errors->has('validcode'))
                      <span class="help-block">
                        <strong>{{ $errors->first('validcode') }}</strong>
                      </span>
                    @endif

              <div class="">
                <!-- <a href="#" class="frm_btn">Create Account</a> -->
                 <button class="frm_btn" type="submit" href="#"><span>Create Account</span></button>  
                 </div>
             </form>
        </div>
      </div>
    </div>
  </div>


    <!-- forgot password -->

<div class="modal fade page_modal" id="forgot-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

              @include('layouts.message')

          <form action="{{ url('/') }}" method="POST">
            {{ csrf_field() }}
       
            <div class="form-group">
                <span class="pre_text">Email Address</span>
              
                <input type="text" class="form-control" placeholder="" name="email">

                @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                @endif
              </div> 

              <div class="">
                <!-- <a href="#" class="frm_btn">Create Account</a> -->
                 <button class="frm_btn" type="submit" href="#"><span>Create Account</span></button>  
                 </div>
             </form>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<script type="text/javascript">

    $(document).ready(function(){


    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });


        var exchange_coinone = '{{ $coinone }}';
        var exchange_cointwo = '{{ $cointwo }}';

        $("#exchange_coinone_name").html(exchange_coinone);
        $("#exchange_cointwo_name").html(exchange_cointwo);

        fetchliveprice();
        fetchbtcprice();  
        fetchethprice();  
        fetchxrpprice(); 
    });

   $("select#exchange_coinone").change(function(){

          exchange_coinone = $(this).children("option:selected").val();
          $("#exchange_coinone_name").html(exchange_coinone);
          fetchliveprice();
          fetchbtcprice();  
          fetchethprice();  
          fetchxrpprice(); 
       
    });

    $("select#exchange_cointwo").change(function(){
          exchange_cointwo = $(this).children("option:selected").val();        
          $("#exchange_cointwo_name").html(exchange_cointwo);
          fetchliveprice();
          fetchbtcprice();  
          fetchethprice();  
          fetchxrpprice(); 
    });

      $('#exchange_you_send').on('keyup', function() {
        
        fetchliveprice();  
        fetchbtcprice();  
        fetchethprice();  
        fetchxrpprice(); 


      }); 

      $('#buy_you_send').on('keyup', function() {
        
        fetchliveprice();  
        fetchbtcprice();  
        fetchethprice();  
        fetchxrpprice();  
      });


      function fetchliveprice(){ 

          var givenprice = $("#exchange_you_send").val();
    
              $.ajax({
                      url: '{{ url("exchangeamount") }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "coinone": $("#exchange_coinone_name").text(),
                          "cointwo": $("#exchange_cointwo_name").text(),
                          "amount": $("#exchange_you_send").val(),
                      }, 

                      success: function (data) {

                        if(data.error){
                          $("#exchange_error_response").html(data.error.message);
                        }else{

                            var receive_amount = data.result[0].result;
                            var market_rate =  parseFloat(data.result[0].rate).toFixed(8);
                       
                           $("#buy_get_approx").val(receive_amount);

                           $("#exchange_get_approx").val(receive_amount);
                           $("#current_market_price").html(market_rate);
                           $("#exchange_error_response").html('');
                        }                       
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 
      }



          function fetchbtcprice(){ 

          var givenprice = $("#exchange_you_send").val();
    
              $.ajax({
                      url: '{{ url("exchangeamount") }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "coinone": 'btc',
                          "cointwo": 'usdc',
                          "amount": '1',
                      }, 

                      success: function (data) {

                        if(data.error){
                          $("#exchange_error_response").html(data.error.message);
                        }else{
                         
                          $("#btc_live_price").text('$'+parseFloat(data.result[0].rate).toFixed(2));                   
                        }                       
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 
      }


            function fetchethprice(){ 

          var givenprice = $("#exchange_you_send").val();
    
              $.ajax({
                      url: '{{ url("exchangeamount") }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "coinone": 'eth',
                          "cointwo": 'usdc',
                          "amount": '1',
                      }, 

                      success: function (data) {

                        if(data.error){
                          $("#exchange_error_response").html(data.error.message);
                        }else{

                           $("#eth_live_price").text('$'+parseFloat(data.result[0].rate).toFixed(2));

                        }                       
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 
      }


        function fetchxrpprice(){ 

          var givenprice = $("#exchange_you_send").val();
    
              $.ajax({
                      url: '{{ url("exchangeamount") }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "coinone": 'xrp',
                          "cointwo": 'usdc',
                          "amount": '200',
                      }, 

                      success: function (data) {

                        if(data.error){
                          alert(data.error);
                          $("#exchange_error_response").html(data.error.message);
                        }else{

                           $("#xrp_live_price").text('$'+parseFloat(data.result[0].rate).toFixed(2));
                        }                       
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 
      }


      $("#exchange_help").mouseover(function(){
        $("#exchange_tooltip_container").css("display", "block");
      });

      $('.close_box').on('click', function() {

              $("#exchange_tooltip_container").css("display", "none");

      }); 

      // $("#exchange_help").mouseout(function(){
      //    $("#exchange_tooltip_container").css("display", "none");
      // });

</script>
 
