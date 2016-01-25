<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>{{!empty($page_title) ? $page_title : 'Welcome to QuicSMS'}}</title>
    @section('head')
    <link rel="stylesheet" type="text/css" href="/assets/semanticui/components/reset.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/semanticui/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/semanticui/css/style.css">
    @show
    <style type="text/css">
    body {
        background-color: #FFFFFF;
    }
    .ui.menu .item img.logo {
        margin-right: 1.5em;
    }
    .main.container, #main-area {
        margin-top: 3.8em;
    }
    .wireframe {
        margin-top: 2em;
    }
    .ui.footer.segment {
        margin: 5em 0em 0em;
        padding: 5em 0em;
    }
    </style>
</head>
<body>



@include('layouts.backend.partials.topnav')


  <div class="ui main text container" id="after-topnav">

    <div class="row" style="margin-bottom:.8em;text-align: right">
        <div class="right ui label">
          <i class="mail icon blue"></i>
            23 Units
          <a class="detail">Buy Credits</a>
        </div>
    </div>

    <div class="ui grid">
        <div class="row">

            <div class="four wide column">
                @include('layouts.backend.partials.sidenav')
            </div>


            <div class="eleven wide column">
                @yield('content')
            </div>

        </div>
    </div>

  </div>

  <div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
      <div class="ui stackable inverted divided grid">
        <div class="three wide column">
          <h4 class="ui inverted header">Group 1</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">Link One</a>
            <a href="#" class="item">Link Two</a>
            <a href="#" class="item">Link Three</a>
            <a href="#" class="item">Link Four</a>
          </div>
        </div>
        <div class="three wide column">
          <h4 class="ui inverted header">Group 2</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">Link One</a>
            <a href="#" class="item">Link Two</a>
            <a href="#" class="item">Link Three</a>
            <a href="#" class="item">Link Four</a>
          </div>
        </div>
        <div class="three wide column">
          <h4 class="ui inverted header">Group 3</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">Link One</a>
            <a href="#" class="item">Link Two</a>
            <a href="#" class="item">Link Three</a>
            <a href="#" class="item">Link Four</a>
          </div>
        </div>
        <div class="seven wide column">
          <h4 class="ui inverted header">Footer Header</h4>
          <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
        </div>
      </div>
      <div class="ui inverted section divider"></div>
      <img src="assets/images/logo.png" class="ui centered mini image">
      <div class="ui horizontal inverted small divided link list">
        <a class="item" href="#">Contact Us</a>
        <a class="item" href="#">Terms and Conditions</a>
        <a class="item" href="#">Privacy Policy</a>
      </div>
    </div>
  </div>

    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/semanticui/semantic.min.js"></script>
    @show
</body>

</html>
