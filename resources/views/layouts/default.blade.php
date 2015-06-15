<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    @section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    @show
</head>
<body>

    @include('layouts.partials.nav')
    <div class="container">
        @include('flash::message')

        @yield('content')
    </div>

    <footer class="container">
        <hr class="footer">
        <p class="pull-left">&copy; {!! date('Y') !!} Shegunbabs.com</p>
        <p class="pull-right">Credits</p>
    </footer>

    @section('foot')
    <script src="//code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>$('#flash-overlay-modal').modal();</script>
    @show
</body>
</html>