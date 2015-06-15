<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    @section('head')
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/payquic.css">
    @show
</head>
<body>

    @include('payquic.layouts.partials.nav')
    <div class="container-wrapper content">
        @include('flash::message')

        @yield('content')

    </div>
    <div id="page-footer">
        <div class="container" style="max-width: 960px;margin: 0 auto;">
            <div id="end" class="inner-col col-md-12">
                <div class="email" style="width: 50%;float: left;">
                    <a href="/email">
                        <i class="fa fa-envelope-o fa-3x" style="position:absolute;left:10px;top:55px;"></i>
                        <h4>Can’t find your answer?</h4>
                        <p>We’re here to help. Get in touch and we’ll get back to you as soon as we can.
                           Contact us {{ HTML::email("support@payyquic.com") }}
                        </p>
                    </a>
                </div>
                <div class="irc" style="width: 50%;float: left;">
                    <span>

                    </span>
                </div>
            </div>
        </div>

        <div class="container-wrapper" id="main-footer">
            <footer>
                <p>&copy; PayQuic</p>

                <ul class="footer-links">
                    <li><a href="https://payquic.com">Home</a></li>
                    <li><a href="http://blog.payquic.com">Blog</a></li>
                    <li><a href="#">Privacy&nbsp;&amp;&nbsp;Terms</a></li>
                </ul>
            </footer>
        </div>
    </div>

    @section('foot')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>$('#flash-overlay-modal').modal();</script>
    @show
</body>
</html>