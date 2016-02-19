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
  <a class="item">Quic SMS</a>
  <a class="item">Bulk SMS</a>
  <a class="item">Contacts</a>
  <a class="item">Groups</a>
  <a class="item">Sent Messages</a>
  <a class="item">Draft Messages</a>
</div>

<div class="pusher front">

    <div class="ui grid container">

        <div class="row">
            <div class="column">
                @include('layouts.kanda.partials.nav')
            </div>
        </div>

        {{--<div class="ui modal">--}}
          {{--<div class="header">Header</div>--}}
          {{--<div class="content">--}}
            {{--<p></p>--}}
          {{--</div>--}}
          {{--<div class="actions">--}}
            {{--<div class="ui approve button">Approve</div>--}}
            {{--<div class="ui button">Neutral</div>--}}
            {{--<div class="ui cancel button">Cancel</div>--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row">--}}
            {{--<div class="column">--}}
                {{--<h1 class="ui header">Header Start</h1>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="column">--}}
                {{--Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row" style="margin-bottom: 40px;">


                <div class="three wide computer four wide tablet hidden mobile column">
                @if( !empty($userSidebar) )
                    @include('layouts.kanda.partials.user-sidebar')
                @else
                    @include('layouts.kanda.partials.sidebar')
                @endif
                </div>
                <div class="thirteen wide computer twelve wide tablet sixteen wide mobile column">
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
                  <h4 class="ui inverted header">Footer Header</h4>
                  <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
                </div>
              </div>
            </div>
          </div>

</div>
    @section('foot')
    <script src="/js/jquery/jquery-latest.js"></script>
    <script src="/assets/semanticui/semantic.min.js"></script>
    <script src="/js/sweetalert2.min.js"></script>
    <script src="/kanda/js/kanda.js"></script>
    @show
    @include('layouts.kanda.partials.flash')


</body>
</html>