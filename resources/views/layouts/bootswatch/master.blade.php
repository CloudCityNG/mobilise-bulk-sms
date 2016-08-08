<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>@yield('title', "Quic SMS Messaging Platform")</title>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <link rel="stylesheet" href="/landing/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
    <link rel="stylesheet" href="/css/sweetalert2.css">
    <link rel="stylesheet" href="/bootswatch/css/style.css">

    @yield('head')

    <style type="text/css">
        #body {
            Padding-top: 80px;
        }

        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f7f7f7;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        }
        #buy-units{
            color:white;
            font-weight:bold;
        }
        #buy-units:hover, #buy-units:active, #buy-units:focus{
            background: #03acc0;
        }

    </style>
</head>
<body>
<div class="se-pre-con"></div>
<nav id="topNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="{{route('dashboard')}}">
                <i class="fa fa-commenting-o" aria-hidden="true"></i> Quic-SMS</a>
        </div>
        <div class="navbar-collapse collapse" id="bs-navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Messaging
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('send_sms')}}">Send SMS</a></li>
                        <li><a href="{{route('file_to_sms')}}">File To SMS</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Schedule SMS</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">History
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('sent_sms_list')}}">Sent Messages</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('draft_sms_list')}}">Draft Messages</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Address Book
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">New Contact</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li class="divider"></li>
                        <li><a href="#">New Group</a></li>
                        <li><a href="#">Groups</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#!" style="background-color:aliceblue;font-weight:bold;">{{$currentUser->smscredit->available_credit}} Units</a></li>
                <li><a href="{{route('purchase_path')}}" id="buy-units" class="btn btn-primary btn-xs" style="">Buy Units</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$currentUser->username}}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('profile_path')}}">Profile</a></li>
                        <li><a href="{{route('settings_path')}}">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('orders_path')}}">Orders</a></li>
                        <li><a href="{{route('payments_path')}}">Payments</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('support_path')}}">Support</a></li>
                        <li><a href="{{route('faqs_path')}}">FAQs</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout_path')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<section id="body">
    <div class="container">
        @yield('content')
    </div>
</section>


<!--scripts loaded here from cdn for performance -->
<script src="/js/jquery/jquery-latest.js"></script>
<script>
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
<script src="/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/master.js"></script>
<script src="/js/sweetalert2.min.js"></script>
@yield('foot')
</body>
</html>