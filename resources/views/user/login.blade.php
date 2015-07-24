<!DOCTYPE html>
<html lang="en-gb" dir="ltr" class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <title>User Login</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
        <link rel="stylesheet" href="/assets/uikit/css/uikit.gradient.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <style type="text/css">
        .uk-alert ul {
            padding-left:15px;
        }
        </style>

    </head>

    <body class="uk-height-1-1">

        <div class="uk-vertical-align uk-text-center uk-height-1-1">
            <div class="uk-vertical-align-middle" style="width: 250px;">

                <img class="uk-margin-bottom" width="140" height="120" src="/images/logos/quic-sms.png" alt="">
                @include('flash::message')
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
                        <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
        @section('foot')
        <script src="/js/jquery/jquery-latest.js"></script>
        <script src="/assets/uikit/js/uikit.min.js"></script>
        @show
    </body>

</html>