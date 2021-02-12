<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | {{ config('app.name') }} </title>
    <!-- favicon !-->
    
   
    <link rel="shortcut icon" sizes="57x57" href="{{ url('images/favicon.jpeg') }}">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ url('adminpanel/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/animate.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('adminpanel/css/app.min.css') }}">
</head>
<body data-sa-theme="11">
    <!-- Login -->
    <div class="login">
        <div class="login__block active" id="l-login">
            <img src="{{ url('/images/logo.png') }}" class="logo-text" />
            <div class="login__block__header">
                <i class="zmdi zmdi-account-circle"></i>
                Admin Panel                 
            </div>
            <div class="login__block__body">

            @if(session('login_error'))
					    <div class="alert alert-success">
                              {{ session('login_error') }}
                        </div>
					@endif

                <form class="form-horizontal" role="form" method="POST" action="{{route('login')}}" autocomplete="nope">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control text-center" name="email" value="{{ old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control text-center" placeholder="Password">
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    @if (isset($status))
                        <span class="help-block">
                            <strong>{{ $status }}</strong>
                        </span>
                    @endif
                    <button type="submit" name="secure-adminlogin" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ url('adminpanel/js/jquery.min.js') }}"></script>
    <script src="{{ url('adminpanel/js/popper.min.js') }}"></script>
    <script src="{{ url('adminpanel/js/bootstrap.min.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ url('adminpanel/js/app.min.js') }}"></script>
</body>
</html>