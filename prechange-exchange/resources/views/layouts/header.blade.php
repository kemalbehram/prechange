<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome </title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('css/responsive.css') }}">

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/owl.theme.default.min.css') }}">

    <!-- selectbox -->
    <link rel="stylesheet" href="{{ url('css/chosen.css') }}">
    <link rel="stylesheet" href="{{ url('css/ImageSelect.css') }}">

    <!-- font-awesome -->
    <link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@600&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<style type="text/css">
    span.help-block {
    color: #f15b5b;
    margin-top: 2px;
}
</style>

<body>

    <div id="preloader">
        <div class="sk-cube-grid">
            <img src="{{ url('images/loader.gif') }}" alt="" class="img-fluid">
        </div>
    </div>

    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg ">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" alt="" class="img-fluid logo_site"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                    aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample05">

                    <ul class="navbar-nav mr-auto sep">

                        <li class="nav-item ">
                            <a class="nav-link active" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#faq') }}">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('contact') }}">Contact Us </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">

                    @if(Auth::id()=='')
                        <li class="nav-item top_btn mrw-1">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#register"> Sign Up</a>
                        </li>
                        <li class="nav-item top_btn mlw-1">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#login">Sign In </a>
                        </li>
                    @else

                         <li class="nav-item mr-1">
                            <a class="nav-link" href="{{ url('profile') }}"><i class="fa fa-user"></i>{{ $login_user_name }} </a>
                        </li>

                        @if( Request::segment(1) == '')

                            <li class="nav-item top_btn ml-1">
                                <a class="nav-link" href="{{ url('profile') }}">Dashboard </a>
                            </li>

                            @else

                            <li class="nav-item top_btn ml-1">
                                <a class="nav-link" href="{{ url('logout') }}"> Sign out</a>
                            </li>

                        @endif
                    @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>