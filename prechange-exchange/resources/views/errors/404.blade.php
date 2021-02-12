<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome EPT SWAP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/shortcode.css">



    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">



    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- ========== Google Fonts ========== -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,700;1,700&display=swap"
        rel="stylesheet">

    
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">

</head>

<body>

    <div id="preloader">
        <div class="sk-cube-grid">
            <img src="{{ url('images/loader.gif') }}" alt="" class="img-fluid">
        </div>
    </div>


<section class="errpage">
    <div class="container">

        <div class="errpagetxt">

        <h2>ERROR 404 <br>
            NOT FOUND</h2>

            <p>You may have mis-typed the URL.

                Or the page has been removed.
                
                Actually, there is nothing to see here... <br>
                
                Click on the links below to do something, Thanks!</p>

               

                <a href="{{ url('/') }}" class="sub_btn">GO TO HOME</a>

                

        </div>

    </div>
</section>


</body>
<script src="js/jquery-3.3.1.min.js"></script>

<!-- Slider js -->
<script src="js/slider/jquery.nivo.slider.pack.js"></script>
<script src="js/slider/nivo-active.js"></script>


<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/simplebar.js"></script>

<script src="js/owl.carousel.js"></script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 20
                }
            }
        })
    })
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(window).on("load", function () {
        "use strict";
        /* -------- preloader ------- */
        $('#preloader').delay(2000).fadeOut(500);
    });
</script>

<script>
    /* ------------------ HEADER STICKY -----------------*/
    var last_known_scroll_position = 0;
    var navigation = document.querySelector("header");
    window.addEventListener('scroll', function (e) {
        last_known_scroll_position = window.scrollY;
        if (last_known_scroll_position > 50) {
            navigation.classList.add("sticky");
        } else {
            navigation.classList.remove("sticky");
        }
    });
</script>




</html>