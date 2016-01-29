<!DOCTYPE html>
<html lang="en-gb" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{!empty($page_title) ?$page_title:'Quic Bulk SMS'}}</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
        @section('head')
        <link rel="stylesheet" href="/assets/uikit/css/uikit.gradient.css">
        <link rel="stylesheet" href="/assets/uikit/css/components/slider.gradient.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/frontend/style.css">
        @show

    </head>

    <body>
    <div id="loading" style="position:absolute;left:50%;z-index:99000;border:1px solid black;background:#eee;display:none;">
        <div class="" style="padding:10px;">
            <p>Loading...</p>
        </div>
    </div>
    <div id="main-loader" class="spinner" style="display:none;"></div>
    @include('layouts.frontend.partials.nav')
    @yield('modal')
    <div class="main-div uk-container uk-container-center uk-margin-top uk-margin-large-bottom">

        <div class="uk-grid" data-uk-grid-margin>

            <div class="uk-width-medium-1-5" id="sidebar">
            <!--sidebar-->
            @if ( !empty($userSidebar) )
                @include('layouts.frontend.partials.settings')
            @else
                @include('layouts.frontend.partials.sidebar')
            @endif

            </div>

            <div class="uk-width-medium-4-5" id="content">
                <div class="uk-block-muted uk-clearfix" style="padding:5px;margin-bottom: 11px">
                    <span style="font-weight: bold">Balance: {{$currentUser->smscredit->available_credit}}</span>
                    <span class="uk-float-right">
                        <a href="{{url('user/credit-purchase')}}" class="uk-button uk-button-success uk-button-small">
                        <i class="uk-icon-money"></i> Buy Credit</a>
                    </span>
                </div>
            <!--content-->
                @yield('content')

            </div>
        </div>

        <hr class="uk-grid-divider">


            <p>&copy; {{date("Y", time())}}</p>
    </div>

        @include('layouts.frontend.partials.canvas')

    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/uikit/js/uikit.min.js"></script>
    <script src="/assets/uikit/js/components/slider.min.js"></script>
    <script src="/assets/uikit/js/components/sticky.js"></script>
    <script src="/assets/uikit/js/components/notify.min.js"></script>
    <script src="/assets/js/global.js"></script>
    @show
    </body>
</html>