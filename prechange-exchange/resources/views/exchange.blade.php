
    @include('layouts.header')

<style type="text/css">
  .dissable-active{
    opacity: 0.4;
  }
</style>

  <section class="banner_section">
    <div class="container">
      <div class="ban_sec">
        <div class="ex_cen">        

            <div class="row">

              <div class="col-md-6 col-lg-6 col-12 m-auto">

                <div class="exchange_in">
                  <div class="exchange-block">

                  <h3>Calculate amount</h3>  

                  <div class="clearfix mb-3"></div>

                    <!-- <div class="switch">
                      <div class="switcher-box">
                        <div class="square-switcher">
                          <div class="option turned">Floating rate</div>
                          <div class="option second">Fixed rate</div>
                        </div>
                      </div>

                      <div class="mark-box">
                      <img src="{{ url('images/qs.png') }}">
                      </div>


                      <div class="tooltip-container" style="display: none;">
                        <div class="close_box"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            viewBox="0 0 24 24">
                            <path fill="#fff" fill-rule="evenodd"
                              d="M12.961 11.999l6.722 6.723a.678.678 0 1 1-.961.958L12 12.96 5.278 19.68a.68.68 0 0 1-.96 0 .678.678 0 0 1 0-.958l6.72-6.723-6.72-6.722a.68.68 0 1 1 .96-.96L12 11.04l6.722-6.722a.68.68 0 1 1 .961.96L12.96 12z">
                            </path>
                          </svg></div>

                        <div class="exrate">
                          <div class="excircle"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M12.6667 6.90918H3.33333C2.59695 6.90918 2 7.50613 2 8.24251V12.9092C2 13.6456 2.59695 14.2425 3.33333 14.2425H12.6667C13.403 14.2425 14 13.6456 14 12.9092V8.24251C14 7.50613 13.403 6.90918 12.6667 6.90918Z"
                                stroke="#80A3B6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                              <path
                                d="M4.66675 6.90961V4.24294C4.66592 3.41631 4.97227 2.61885 5.52633 2.00539C6.08039 1.39192 6.84264 1.00621 7.66509 0.923134C8.48754 0.840058 9.31151 1.06554 9.97706 1.55582C10.6426 2.04609 11.1023 2.76617 11.2667 3.57627"
                                stroke="#80A3B6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </svg></div>

                          <div class="extxt">
                            <h2 class="styled__TooltipTitle-th509d-8 jxYQGc">Floating exchange rate</h2>
                            <p class="styled__TooltipDescription-th509d-9 fmronQ">Your amount could change depending
                              on
                              the market conditions.</p>
                          </div>
                        </div><br>
                        <div class="exrate">
                          <div class="excircle"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M12.6667 6.9668H3.33333C2.59695 6.9668 2 7.56375 2 8.30013V12.9668C2 13.7032 2.59695 14.3001 3.33333 14.3001H12.6667C13.403 14.3001 14 13.7032 14 12.9668V8.30013C14 7.56375 13.403 6.9668 12.6667 6.9668Z"
                                stroke="#10D078" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                              <path
                                d="M4.66675 6.9668V4.30013C4.66675 3.41608 5.01794 2.56823 5.64306 1.94311C6.26818 1.31799 7.11603 0.966797 8.00008 0.966797C8.88414 0.966797 9.73198 1.31799 10.3571 1.94311C10.9822 2.56823 11.3334 3.41608 11.3334 4.30013V6.9668"
                                stroke="#10D078" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </svg></div>
                          <div class="extxt">
                            <h2>Fixed exchange rate</h2>
                            <p>Your amount will remain the same irrespective of the changes on the market.</p>
                            <p class="txt2">Fixed rate updates every 30 seconds</p>
                          </div>
                        </div>
                      </div>

                    </div> -->

                    <div class="selct_divex">
                      <span class="currlabel">You send</span>
                      <input maxlength="16" value="0.1" id="exchange_you_send">
                      <div class="currency_div">

                            <div id="myDIV">
                              <div class="my_div">
                                <select class="my-select" id="exchange_coinone">
                                  @foreach($coins as $key => $coin)
                                      <option data-img-src="{{ $coin->image }}" value="{{$coin->ticker}}"  @if($coinone == $coin->source) selected="selected" @else @endif>{{$coin->coinname}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                      </div>
                    </div>

                    <span id="exchange_error_response" style="color: red;"></span>


                    <div class="swithsec">
                      <div class="switch-block">
                        <div class="left-side"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M10.8013 7.59961H5.20051C4.75861 7.59961 4.40039 7.95783 4.40039 8.39973V11.2001C4.40039 11.642 4.75861 12.0002 5.20051 12.0002H10.8013C11.2432 12.0002 11.6014 11.642 11.6014 11.2001V8.39973C11.6014 7.95783 11.2432 7.59961 10.8013 7.59961Z"
                              fill="#80A3B6"></path>
                            <path
                              d="M6 7.59955V5.99931C6 5.4688 6.21074 4.96002 6.58587 4.5849C6.961 4.20977 7.46978 3.99902 8.00029 3.99902C8.5308 3.99902 9.03958 4.20977 9.41471 4.5849"
                              stroke="#80A3B6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                          </svg>
                          <div class="rate-info">
                                <span id="exchange_coinone_name">1 {{$coinone}}</span>
                                <span id="current_market_price"> ~ 0 </span>
                                <span id="exchange_cointwo_name"> {{$cointwo}} </span> 
                          </div>
                        </div>
                     <!--    <button type="button" tabindex="0" class="exchange-switch-button"><svg width="14"
                            height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.888916 3.22266L3.11112 1.00045L5.33333 3.22266" stroke="#80A3B6"
                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M3.11108 10.7773L3.11108 0.999619" stroke="#80A3B6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.1112 8.77779L10.889 11L8.66675 8.77779" stroke="#80A3B6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.8889 1.22228L10.8889 11" stroke="#80A3B6" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg></button> -->
                      </div>
                    </div>

                    <div class="selct_divex">
                      <span class="currlabel">You get approximately</span>
                      <input maxlength="16" value="" id="exchange_get_approx">
                      <input type="hidden" maxlength="16" value="" id="netfee">
                      <input type="hidden" maxlength="16" value="" id="exchangefee">
                      <div class="currency_div">
                        <div id="myDIV">
                          <div class="my_div">
                              <select class="my-select" id="exchange_cointwo">
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
                 
                </div>


                <div class="ac_bx">

                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Transaction details
                          </button>
                        </h2>
                      </div>
                  
                      <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          <ul>

                         <li> Exchange fee {{$total_commission_percentage}}%  <span id="commission_amount_total"> 0 {{ $cointwo }} </span></li>
                         <li> Network fee  <span id="network_fee">0 {{ $cointwo }} </span></li>
                         <li> Estimated arrival <span> 5-30 minutes </span></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                   
                   
                  </div>
                </div>

                <div class="wall_bx">
                  <h2 class="title">Wallet address</h2>

                  <div class="form-group">
                    <label >Recipient address</label>
                    <input type="text" class="form-control" placeholder="Enter your ETH recipient address" id="receive_address" >
                    <span id="address_error" style="color: red"></span>
                  
                  </div>

                  <div class="form-group">
                  <!-- <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">I agree with Terms of Use, Privacy Policy  and AML/KYC</label> 
                  </div> -->
                  </div>
                  <button class="exchange-button dissable-active" disabled="disabled" id="go_checkout" onclick="changeurl();">Next Step</button>
                  <!-- <a class="exchange-button" href="{{ url('checkout') }}" style="display: none;"><span>Next Step</span></a> -->

                 
                  </div>

              </div>

            </div>
        
        </div>

      </div>
    </div>
  </section>





  @include('layouts.footer')

  <script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  </script>


  <!-- <script type="text/javascript">
    $(".my-select").chosen({
      width: "100%"
    });
  </script> -->



  <script type="text/javascript">

    $(document).ready(function(){
        var exchange_coinone = '{{ $coinone }}';
        var exchange_cointwo = '{{ $cointwo }}';

        $("#exchange_coinone_name").html(exchange_coinone);
        $("#exchange_cointwo_name").html(exchange_cointwo);

        fetchliveprice();
    });


   $("select#exchange_coinone").change(function(){

          exchange_coinone = $(this).children("option:selected").val();
          $("#exchange_coinone_name").html(exchange_coinone);
          fetchliveprice();
       
    });

    $("select#exchange_cointwo").change(function(){
          exchange_cointwo = $(this).children("option:selected").val();        
          $("#exchange_cointwo_name").html(exchange_cointwo);
          fetchliveprice();
    });

      $('#exchange_you_send').on('keyup', function() {
        fetchliveprice();  
      });


      $('#receive_address').on('keyup', function() {
        addressValidate();  
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
                            var network_fee =  parseFloat(data.result[0].networkFee).toFixed(8);
                            var changelly_fee = parseFloat(data.result[0].fee).toFixed(8);
                            var koboex_trade_percentage = parseFloat('{{$percentage_trade}}'/100).toFixed(8);
                            var koboex_fee = parseFloat(koboex_trade_percentage) * parseFloat($("#exchange_you_send").val());
                            var koboex_fee = parseFloat(koboex_fee).toFixed(8);

                            var commission_amount_total = parseFloat(changelly_fee) + parseFloat(koboex_fee);

                           $("#exchange_get_approx").val(receive_amount);
                           $("#current_market_price").html(market_rate);
                           $("#commission_amount_total").html(commission_amount_total);
                           $("#network_fee").html(network_fee);
                           $("#exchange_error_response").html('');
                            $("#receive_address").attr("placeholder", "Enter your "+$("#exchange_cointwo_name").text().toUpperCase()+" recipient address");
                        }                       
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 
      }


</script>

<script>
       function addressValidate(){

              $.ajax({
                      url: '{{ url("addressvalidate") }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "address": $("#receive_address").val(),
                          "coin": $("#exchange_cointwo_name").text(),
                        
                      }, 

                      success: function (data) {

                        if(data.result == 'wrong'){
                          $("#address_error").html('Invalid Address.');
                        }else{
                          $("#address_error").html('');
                           $('#go_checkout').prop("disabled", false);
                          $("#go_checkout").removeClass("dissable-active");
                            // 0xecdf3210227ce060340bd98f637ad86a99c913c2
                        }                       
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 

      }
  </script>

<script type="text/javascript">
  
  function changeurl(){

                  $.ajax({
                      url: '{{ url("sessionsave") }}',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          "receiver_address": $("#receive_address").val(),
                          "cointwo": $("#exchange_cointwo_name").text(),
                          "coinone": $("#exchange_coinone_name").text(),
                          "coinone_amount": $("#exchange_you_send").val(),
                          "cointwo_amount": $("#exchange_get_approx").val(),
                          "network_fee": $("#network_fee").html(),
                          "exchange_fee": $("#commission_amount_total").html(),
                        
                      }, 

                      success: function (data) {

                          // location.href='http://koboex.consummo.com/development/checkout';                      
                          location.href='{{ url("checkout")}}';                      
                        
                      },
                      error: function (data) {
                         return false;
                      }
                  }); 
    
  }
</script>


</body>


</html>