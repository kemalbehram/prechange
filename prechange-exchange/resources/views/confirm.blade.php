@include('layouts.header')

  <section class="banner_section">
    <div class="container">
      <div class="ban_sec">
        <div class="ex_cen">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-12 m-auto">
              <div class="id_div">
                <div class="center-wrapper">
                  <div class="label">Transaction ID:</div>
                  <div class="value">{{$txid}}</div>

                  <div class="copy-button">
                    <i class="fa fa-copy"></i>
                  </div>
                </div>
              </div>

              <div class="ex_ac">
                <p>Please send the exact amount from your wallet or exchange account to the following address</p>
              </div>

              <div class="exchange_in">
                <div class="exchange-block">
                  <div class="check_txt">
                    <div class="row">
                      <div class="col-md-12 col-lg-12 text-center">
                        <span class="checklabel">Send</span>
                        <h4 class="value">{{$coinone_amount}} {{ $coinone}}</h4>
                      </div>

                    </div>

                    <div class="clearfix mb-3"></div>

                    <div class="row">

                      <div class="col-md-12 col-lg-12 text-center">
                        <span class="checklabel">To address</span>
                        <h4 class="value">{{ $admin_address }}</h4>'

                         <input readonly=""  class="eth-address form-control" id="coinaddress" type="hidden" value="{{ $admin_address }}">

                        <div class="copy-action">                          
                         
                          <span onclick="myCopyFunc()" class="copy-btn ctexty" id="myTooltip"><i class="fa fa-copy"></i> Copy address</span>
                        </div>

                        <div class="clearfix mb-3"></div>

                        <div class="qr">
                          <img src="{{ url('images/qr.png') }}">
                        </div>
                      </div>
                    </div>
                    <div class="clearfix mb-4"></div>
                  </div>
                </div>
              </div>

              <div class="confirm_bx text-center pt-4 pb-4">
                <div class="time" id="timer"></div>
                <div class="description">You have 36 hours to send funds otherwise the transaction will be canceled automaticaly</div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>




  <div class="joinnw" id="joinnow" style="display:none;">


    <a class="close" href="#"><img src="images/close.png"> </a>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log"
          aria-selected="true">Sign in</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup"
          aria-selected="false">Sign up</a>
      </li>

    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="log-tab">

        <div class="log_bx">
          <h3>Welcome back!</h3>

          <div class="form-group">
            <label>Email address</label>
            <input type="text" class="form-control" placeholder="Enter your email address">
          </div>
          <div class="form-group">
            <label>Password <span><a hrref="">Forgot password ?</a></span></label>
            <input type="text" class="form-control" placeholder="Enter your Password">
          </div>

          <div class="form-group">
            <button class="exchange-button" type="button" href="#"><span>Continue to Exchange</span></button>
          </div>


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
      <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
        <div class="log_bx">
          <h3>Join for free</h3>

          <div class="form-group">
            <label>Email address</label>
            <input type="text" class="form-control" placeholder="Enter your email address">
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck1">
              <label class="custom-control-label" for="customCheck1"> Send me updates on my email</label>
            </div>
          </div>




          <div class="form-group">
            <button class="exchange-button" type="button" href="#"><span>Continue to Exchange</span></button>
          </div>


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

    </div>
  </div>

@include('layouts.footer')

<script type="text/javascript">
  function myCopyFunc() {
    var copyText = document.getElementById("coinaddress");
    copyText.select();
    document.execCommand("Copy");
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "<strong class=''>Copied</strong>";
  }
</script>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 34)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  //document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  
   document.getElementById("timer").innerHTML = hours+":"+minutes+":"+seconds;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);
</script>




</body>


</html>