<!DOCTYPE html>
<html lang="en-gb" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontpage layout example - UIkit documentation</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
        @section('head')
        <link rel="stylesheet" href="/assets/uikit/css/uikit.docs.min.css">
        <link rel="stylesheet" href="/assets/uikit/css/uikit.gradient.min.css">
        <link rel="stylesheet" href="/assets/uikit/css/components/slider.gradient.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/frontend/style.css">
        @show
    </head>

    <body>

    @include('layouts.frontend.partials.nav')
    @yield('modal')
    <div class="main-div uk-container uk-container-center uk-margin-top uk-margin-large-bottom">

        <div class="uk-grid" data-uk-grid-margin>

            @include('flash::message')

            <div class="uk-width-medium-1-4" id="sidebar">
            <!--sidebar-->
            @include('layouts.frontend.partials.sidebar')
            </div>

            <div class="uk-width-medium-3-4" id="content">
            <!--content-->
                @yield('content')

            </div>
        </div>

        <hr class="uk-grid-divider">


            <p>Here</p>
    </div>

        @include('layouts.frontend.partials.canvas')

    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/uikit/js/uikit.min.js"></script>
    <script src="/assets/uikit/js/components/slider.min.js"></script>
    <script src="/assets/uikit/js/components/sticky.js"></script>
    <script src="/assets/js/global.js"></script>
    @show
    </body>
</html>