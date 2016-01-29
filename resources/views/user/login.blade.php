<!DOCTYPE html>
<html lang="en-gb" dir="ltr" class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <title>User Login</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
        <link rel="stylesheet" href="/assets/uikit/css/uikit.gradient.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/css/sweetalert2.css">

        <style type="text/css">
        .uk-alert ul {
            padding-left:15px;
        }
        .social-connect {
            display: table;
            text-decoration: none;
            color: #666;
            height: 24px;
            line-height: 26px;
            border-bottom: 1px solid #c8d4db;
            margin-bottom: 10px;
            position: relative;
            width: 100%;
            background-color: #E6EBED;
            border-radius: 4px;
        }
        .social-connect .google-plus {
            background-color: #DF4932;
            display: table-cell;
            left: 0;
            top: 0;
            width: 14px;
            padding: 10px 20px 10px 21px;
            color: #fff;
            width: 50px;
        }
        .social-connect .facebook {
            background-color: #4965A0;
            display: table-cell;
            left: 0;
            top: 0;
            width: 14px;
            padding: 10px 20px 10px 21px;
            color: #fff;
            width: 50px;
        }
        .social-connect .social-button-text {
            background-color: #E6EBED;
            text-align: center;
            color: #70838c;
            width: 100%;
            display: table-cell;
            padding: 10px 10px;
        }
        a.social-connect:hover {
            text-decoration: none;
        }
        a.social-connect:hover .social-button-text{
            background: #EEF3F5;
        }
        </style>

    </head>

    <body class="uk-height-1-1">

        <div class="uk-vertical-align uk-text-center uk-height-1-1">
            <div class="uk-vertical-align-middle" style="width: 350px;">

                <img class="uk-margin-bottom" width="140" height="120" src="/images/logos/quic-sms.png" alt="">
                @include('layouts.frontend.partials.errors')

                {!! Form::open(['url'=>'user/login', 'method'=>'post', 'class'=>'uk-panel uk-panel-box uk-form', 'autocomplete'=>'off', 'id'=>'loginForm']) !!}
                    <div class="uk-form-row">
                        {!! Form::email('email', Input::old('email'), ['class'=>'uk-width-1-1 uk-form-large','placeholder'=>'Email','required']) !!}
                    </div>
                    <div class="uk-form-row">
                        {!! Form::password('password', ['class'=>'uk-width-1-1 uk-form-large','placeholder'=>'Password','required']) !!}
                    </div>

                    <div class="uk-form-row uk-text-small">
                        <label class="uk-float-left">
                            {!! Form::checkbox('rememberMe', 1, true) !!} Remember Me
                        </label>
                    </div>

                    <div class="uk-form-row">
                        <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Login</button>
                    </div>
                    <div class="uk-form-row uk-text-small">
                        <label class="uk-float-left">
                            <a class="uk-float-left uk-link uk-link-muted" href="{{url('user/register')}}">Register</a>
                        </label>
                        <a class="uk-float-right uk-link uk-link-muted" href="{{url('password/email')}}">Forgot Password?</a>
                    </div>
                    <div class="uk-form-row">
                        <a href="/Oauth/Authenticate/google" class="social-connect">
                            <span class="google-plus"><i class="uk-icon-google-plus uk-icon-small"></i></span>
                            <span class="social-button-text">Connect with Google</span>
                        </a>
                        <a href="/Oauth/Authenticate/facebook" class="social-connect">
                            <span class="facebook"><i class="uk-icon-facebook-official uk-icon-small"></i></span>
                            <span class="social-button-text">Connect with Facebook</span>
                        </a>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
        @section('foot')
        <script src="/js/jquery/jquery-latest.js"></script>
        <script src="/assets/uikit/js/uikit.min.js"></script>
        <script src="/js/sweetalert2.min.js"></script>
        @show
        @include('layouts.kanda.partials.flash')
    </body>

</html>