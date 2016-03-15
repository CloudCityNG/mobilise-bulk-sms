<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{!! !empty($page_title) ? $page_title : "Quic SMS" !!}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{!! csrf_token() !!}" />

    @section('head')
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/semanticui/semantic.min.css">
    <link rel="stylesheet" href="/kanda/css/extra.css">
    <link rel="stylesheet" href="/css/sweetalert2.css">
    <style type="text/css">
    /**
     ** Large screen container fix
     **/
    @media only screen and (min-width: 1200px) {
        .ui.grid.container {
            width: 1000px!important;
        }
        .ui.small.modal {
            width: 480px;
            margin: 0 0 0 -245px;
        }
    }
    </style>
    @show
    <!-- Modernizr -->
    <!--[if IE 8]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="ui vertical inverted sidebar left menu">
  <a class="active item">Home</a>
  <a class="item" href="{{$sideMenu->quick_sms}}">Quic SMS</a>
  <a class="item" href="#">Bulk SMS</a>
  <a class="item" href="{{$sideMenu->contacts}}">Contacts</a>
  <a class="item" href="{{$sideMenu->groups}}">Groups</a>
  <a class="item" href="{{$sideMenu->sent_messages}}">Sent Messages</a>
  <a class="item" href="{{$sideMenu->draft_messages}}">Draft Messages</a>
</div>

@yield('modal')
<div class="pusher front">

    <div class="ui grid container">

        <div class="row">
            <div class="column">
                @include('layouts.kanda.partials.nav')
            </div>
        </div>

        <div class="row" style="margin-bottom: 40px;">


                <div class="three wide computer hidden tablet hidden mobile column">
                @if( !empty($userSidebar) )
                    @include('layouts.kanda.partials.user-sidebar')
                @else
                    @include('layouts.kanda.partials.sidebar')
                @endif
                </div>
                <div class="thirteen wide computer sixteen wide tablet sixteen wide mobile column">
                    @yield('content')
                </div>


        </div>


    </div>

    <div class="ui inverted vertical footer segment" style="padding: 60px 0 60px 0;">
            <div class="ui container">
              <div class="ui stackable inverted divided equal height stackable grid">
                <div class="three wide column">
                  <h4 class="ui inverted header">About</h4>
                  <div class="ui inverted link list">
                    <a href="#" class="item">Sitemap</a>
                    <a href="#" class="item">Contact Us</a>
                    <a href="#" class="item">Support</a>
                  </div>
                </div>
                <div class="three wide column">
                  <h4 class="ui inverted header">Services</h4>
                  <div class="ui inverted link list">
                    <a href="#" class="item">Bulk SMS</a>
                    <a href="#" class="item">Airtime Recharge</a>
                    <a href="#" class="item">FAQ</a>
                  </div>
                </div>
                <div class="seven wide column">
                  <h4 class="ui inverted header">Messaging</h4>
                  <p>Use our simple yet powerful platform to reach millions of subscribers.</p>
                  <p>Communicate in a better and faster way using Quic-SMS to reach out to Friends, Families, Clients, Customers etc.</p>
                </div>
              </div>
            </div>
          </div>

</div>
    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/semanticui/semantic.min.js"></script>
    <script src="/js/sweetalert2.min.js"></script>
    @include('layouts.kanda.partials.flash')
    <script src="/kanda/js/kanda.js"></script>
    @show



</body>
</html>