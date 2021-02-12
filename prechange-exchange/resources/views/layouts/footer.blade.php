    <footer>
        <div class="container">

            <div class="btm_logo">
                <img src="{{ url('images/logo_btm.png') }}" alt="" class="img-fluid">
            </div>

            <div class="btm_link">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="list-inline-item"><a href="{{ url('/') }}">Feedback</a></li>
                    <li class="list-inline-item"><a href="{{ url('contact') }}">Contact us</a></li>
                    <li class="list-inline-item"><a href="{{ url('exchange') }}">Exchange</a></li>
                    <!-- <li class="list-inline-item"><a href="{{ url('/') }}">Buy</a></li> -->
                    <!-- <li class="list-inline-item"><a href="{{ url('/') }}">Sell</a></li> -->
                </ul>
            </div>

            <div class="social">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#"><img src="{{ url('images/twiter.png') }}" alt="" class="img-fluid"></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><img src="{{ url('images/fb.png') }}" alt="" class="img-fluid"></a></li>
                    <li class="list-inline-item"><a href="#"><img src="{{ url('images/social.png') }}" alt="" class="img-fluid"></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><img src="{{ url('images/youtube.png') }}" alt="" class="img-fluid"></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><img src="{{ url('images/insta.png') }}" alt="" class="img-fluid"></a>
                    </li>
                </ul>
            </div>


        </div>
    </footer>

      <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{ url('terms-condition') }}">Terms & Conditions</a></li>
                        <li class="list-inline-item"><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                    <ul class="list-inline text-right">
                        <li>© Prechange {{ date('Y') }}. All rights reserved.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>

<script src="js/owl.carousel.js"></script>

<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/ImageSelect.jquery.js" type="text/javascript"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="js/custom.js"></script>


</html>