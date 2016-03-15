<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Nigeria's Biggest and Most Reliable Bulk-SMS provider.</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="teal lighten-5" role="navigation" id="topnav">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo" href="{{env('URL')}}">
        <img src="{{env('LOGO_URL')}}" alt="" style="width: 160px;margin-top: 15px;">
      </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="{{$sideMenu->dashboard}}">Dashboard</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="{{$sideMenu->dashboard}}">Dashboard</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

    <div class="row">
        <div class="col s12 m4 l3">
            @include('layouts.material.partials.support-sidebar')
        </div>
        <div class="col s12 m8 l9" id="content">
            @yield('content')
        </div>
    </div>

  </div>

  <footer class="page-footer teal">
    {{--<div class="container">--}}
      {{--<div class="row">--}}
        {{--<div class="col l6 s12">--}}
          {{--<h5 class="white-text">Company Bio</h5>--}}
          {{--<p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>--}}


        {{--</div>--}}
        {{--<div class="col l3 s12">--}}
          {{--<h5 class="white-text">Settings</h5>--}}
          {{--<ul>--}}
            {{--<li><a class="white-text" href="#!">Link 1</a></li>--}}
            {{--<li><a class="white-text" href="#!">Link 2</a></li>--}}
            {{--<li><a class="white-text" href="#!">Link 3</a></li>--}}
            {{--<li><a class="white-text" href="#!">Link 4</a></li>--}}
          {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="col l3 s12">--}}
          {{--<h5 class="white-text">Connect</h5>--}}
          {{--<ul>--}}
            {{--<li><a class="white-text" href="#!">Link 1</a></li>--}}
            {{--<li><a class="white-text" href="#!">Link 2</a></li>--}}
            {{--<li><a class="white-text" href="#!">Link 3</a></li>--}}
            {{--<li><a class="white-text" href="#!">Link 4</a></li>--}}
          {{--</ul>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
    <div class="footer-copyright">
      <div class="container">
        Created By <a class="brown-text text-lighten-3" href="http://mobiliseafrica.com">Mobilise</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/materialize/js/materialize.min.js"></script>
  <script src="/materialize/js/init.js"></script>
  </body>
</html>
