
    @include('layouts.header')

<style type="text/css">
  .help-block{
    color: #ca5050;
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
                <div class="checkout_tit">
                  <h3>Checkout </h3>
                  <button class="back-button" type="button">
                    <span width="13px" height="10px" class="arrow-left-icon"></span>&nbsp;&nbsp; Back</button>
                  </div>
                  <div class="clearfix mb-3"></div>
                  <div class="check_txt">
                    <div class="row">
                      <div class="col-md-6 col-lg-6">
                        <span class="checklabel">You send</span>
                        <h4 class="value">{{ $coinone_amount }} {{ strToUpper($coinone) }}</h4>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <span class="checklabel">You get approximately</span>
                        <h4 class="value">{{$cointwo_amount}} {{ strToUpper($cointwo) }}</h4>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6 col-lg-6">
                        <span class="checklabel">Exchange fee</span>
                        <h4 class="value">{{$exchange_fee}} {{ strToUpper($cointwo) }}</h4>
                        <span class="notice">The exchange fee is already included in the displayed amount you’ll get</span>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <span class="checklabel">Network fee</span>
                        <h4 class="value">{{$network_fee}} {{ strToUpper($cointwo) }}</h4>
                        <span class="notice"> Will be excluded from the final amount</span>
                      </div>
                    </div>
                    <div class="clearfix mb-4"></div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <span class="checklabel">Recipient address</span>
                        <h4 class="value">{{$receiver_address}}</h4>           
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
              @if (isset(Auth::user()->id))
              <div class="confirm_bx">
                <a class="exchange-button" href="{{ url('confirm') }}"><span>Confirm & make payment</span></a>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@php 
  $register = '';
  $login = 'active';
  $signupdis ='display:none';

if($errors->has('email') || $errors->has('password') || $errors->has('regiser_email') || session('registerstatus')){

  $style = ''; 
  $cstle = 'active';
  $ulstyle =  '';

  if($errors->has('regiser_email')){

        $style = ''; 
        $cstle = 'active';
        $ulstyle =  '';
        $signupdis = '';

        $register = 'active show';
        $login = '';

  }

   elseif (session('registerstatus')){
      $style = ''; 
      $cstle = 'active';
      $register = 'active show';
      $login = '';
      $signupdis = '';
 }


} 

 else {
  if (session('errorstatus')){
      $style = ''; 
      $cstle = 'active';

 }else{
     $style ='display:none';
     $cstle = '';  
  }
 
}
@endphp


  <div class="joinnw @if(Auth::id() == '') active @else @endif" id="joinnow" @if(Auth::id() == '') @else style="display:none;" @endif>
    <a class="close" href="#"><img src="{{ url('public/images/close.png') }}"> </a>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link {{$login}}" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log"
      aria-selected="true">Sign in</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link {{$register}}" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup"
      aria-selected="false">Sign up</a>
    </li>

  </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show {{$login}}" id="log" role="tabpanel" aria-labelledby="log-tab">
        <div class="log_bx">
          <h3>Welcome back!</h3>
            @include('layouts.message')

      <div class="alert alert-danger print-error-msg" id="login_form_errors" style="display:none">
                <ul></ul>
          </div>

       <form action="{{ url('userlogin') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Email address</label>
              <input type="text" class="form-control" placeholder="Enter your email address" id="login_email" name="email">

                  @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
            </div>

            <div class="form-group">
              <label>Password <span><a hrref="">Forgot password ?</a></span></label>
              <input type="text" class="form-control" placeholder="Enter your Password" id="login_password" name="password">

                 @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
            </div>

            <div class="form-group">
              <!-- <button class="exchange-button" type="submit" href="#" id="login_submit"> -->
              <button class="exchange-button" type="submit">
                <span>Continue to Exchange</span>
              </button>
            </div>

        </form>


          <div class="foot_social">
            <button class="joinnw_sn sn-google" type="button">
              <span class="joinbox__inline-icon">
                <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <mask id="a">
                    <path d="M24 0H0v24h24z" fill-rule="evenodd"></path>
                  </mask>
                  <path
                  d="M11.86 9.92v3.912s3.787-.004 5.33-.004c-.836 2.535-2.135 3.916-5.33 3.916-3.235 0-5.76-2.627-5.76-5.868 0-3.24 2.525-5.867 5.76-5.867 1.71 0 2.814.603 3.827 1.442.81-.813.743-.928 2.807-2.88A9.817 9.817 0 0 0 11.859 2C6.414 2 2 6.422 2 11.876c0 5.456 4.414 9.877 9.86 9.877 8.138 0 10.127-7.1 9.468-11.832z"
                  fill-rule="evenodd" mask="url(#a)"></path>
                </svg></span>
              </button>

              <button class="joinnw_sn sn-facebook" type="button">
                <span class="joinbox__inline-icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                      <path d="M0 0h24v24H0z"></path>
                      <path
                      d="M22 20.896c0 .61-.494 1.104-1.104 1.104H15.8v-7.745h2.6l.388-3.019H15.8V9.31c0-.874.242-1.47 1.496-1.47h1.598v-2.7a21.315 21.315 0 0 0-2.33-.12c-2.304 0-3.882 1.407-3.882 3.99v2.226h-2.606v3.02h2.606V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104z"
                      fill="#fff" fill-rule="nonzero">
                    </path>
                  </g>
                </svg></span>
              </button>

              <button class="joinnw_sn sn-twitter" type="button"><span class="joinbox__inline-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <g fill="none" fill-rule="evenodd">
                    <path d="M0 0h24v24H0z"></path>
                    <path
                    d="M22.393 3.339a8.874 8.874 0 0 1-2.868 1.121A4.448 4.448 0 0 0 16.23 3c-2.49 0-4.512 2.072-4.512 4.628 0 .363.04.715.116 1.054-3.75-.193-7.076-2.034-9.304-4.837a4.712 4.712 0 0 0-.61 2.33c0 1.604.797 3.02 2.007 3.85a4.422 4.422 0 0 1-2.045-.576v.057c0 2.243 1.556 4.114 3.622 4.538a4.301 4.301 0 0 1-1.189.162c-.29 0-.575-.027-.85-.082.575 1.839 2.24 3.177 4.216 3.213A8.914 8.914 0 0 1 1 19.256a12.563 12.563 0 0 0 6.918 2.077c8.304 0 12.843-7.05 12.843-13.167 0-.201-.004-.403-.011-.6A9.269 9.269 0 0 0 23 5.17a8.816 8.816 0 0 1-2.592.728 4.613 4.613 0 0 0 1.985-2.56"
                    fill="#fff" fill-rule="nonzero"></path>
                  </g>
                </svg></span></button>
             </div>
            </div>
          </div>

         <div class="tab-pane fade {{$register}}" id="signup" role="tabpanel" aria-labelledby="signup-tab">

            @if (session('registerstatus'))

<div class="joinbox__stretch" id="registe_success_div" style="{{$signupdis}}">
  <h2 class="cl-heading color-gray  sc-htpNat gflWBe" font-size="2.4">Check your email</h2>
  <p class="cl-para  sc-gipzik gDNlDP">We've just sent you a confirmation email to Inbox</p><p class="cl-para p4 sc-gipzik idQdtX">Please kindly check your mailbox.</p>
  <a class="exchange-button btn"  href="//gmail.com" target="_blank">Open Inbox</a>
</div>
@else
          <div class="log_bx" id="registe_form_div">
            <h3>Join for free</h3>

            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
              </div>

              <form action="{{ url('userregister') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
              <label>Email address</label>
              <input type="text" class="form-control" name="regiser_email" id="regiser_email" placeholder="Enter your email address">
                    @if ($errors->has('regiser_email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('regiser_email') }}</strong>
                      </span>
                  @endif
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <div id="reg_email_errors" style="color: red"></div>
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1"> Send me updates on my email</label>
              </div>
            </div>

            <div class="form-group">
              <!-- <button class="exchange-button" type="button" href="#" id="register_submit"> -->
              <button class="exchange-button" type="submit" href="#">
                <span>Continue to Exchange</span></button>              
              <!-- <a class="btn exchange-button" href="{{ url('register') }}"><span>Continue to Exchange</span></a> -->
            </div>

          </form>


            <div class="foot_social">

              <button class="joinnw_sn sn-google" type="button">
                <span class="joinbox__inline-icon">
                  <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <mask id="a">
                      <path d="M24 0H0v24h24z" fill-rule="evenodd"></path>
                    </mask>
                    <path
                    d="M11.86 9.92v3.912s3.787-.004 5.33-.004c-.836 2.535-2.135 3.916-5.33 3.916-3.235 0-5.76-2.627-5.76-5.868 0-3.24 2.525-5.867 5.76-5.867 1.71 0 2.814.603 3.827 1.442.81-.813.743-.928 2.807-2.88A9.817 9.817 0 0 0 11.859 2C6.414 2 2 6.422 2 11.876c0 5.456 4.414 9.877 9.86 9.877 8.138 0 10.127-7.1 9.468-11.832z"
                    fill-rule="evenodd" mask="url(#a)"></path>
                  </svg></span>
                </button>

                <button class="joinnw_sn sn-facebook" type="button">
                  <span class="joinbox__inline-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <g fill="none" fill-rule="evenodd">
                        <path d="M0 0h24v24H0z"></path>
                        <path
                        d="M22 20.896c0 .61-.494 1.104-1.104 1.104H15.8v-7.745h2.6l.388-3.019H15.8V9.31c0-.874.242-1.47 1.496-1.47h1.598v-2.7a21.315 21.315 0 0 0-2.33-.12c-2.304 0-3.882 1.407-3.882 3.99v2.226h-2.606v3.02h2.606V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104z"
                        fill="#fff" fill-rule="nonzero">
                      </path>
                    </g>
                  </svg></span>
                </button>

                <button class="joinnw_sn sn-twitter" type="button"><span class="joinbox__inline-icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                      <path d="M0 0h24v24H0z"></path>
                      <path
                      d="M22.393 3.339a8.874 8.874 0 0 1-2.868 1.121A4.448 4.448 0 0 0 16.23 3c-2.49 0-4.512 2.072-4.512 4.628 0 .363.04.715.116 1.054-3.75-.193-7.076-2.034-9.304-4.837a4.712 4.712 0 0 0-.61 2.33c0 1.604.797 3.02 2.007 3.85a4.422 4.422 0 0 1-2.045-.576v.057c0 2.243 1.556 4.114 3.622 4.538a4.301 4.301 0 0 1-1.189.162c-.29 0-.575-.027-.85-.082.575 1.839 2.24 3.177 4.216 3.213A8.914 8.914 0 0 1 1 19.256a12.563 12.563 0 0 0 6.918 2.077c8.304 0 12.843-7.05 12.843-13.167 0-.201-.004-.403-.011-.6A9.269 9.269 0 0 0 23 5.17a8.816 8.816 0 0 1-2.592.728 4.613 4.613 0 0 0 1.985-2.56"
                      fill="#fff" fill-rule="nonzero"></path>
                    </g>
                  </svg></span></button>

                </div>


              </div>

              @endif


            </div>

            </div>
          </div>
          @include('layouts.footer')
        </body>
        </html>