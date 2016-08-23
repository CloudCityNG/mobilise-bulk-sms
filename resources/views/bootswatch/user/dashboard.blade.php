@extends('layouts.bootswatch.master')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="box">One</div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <a href="{{route('send_sms')}}" class="box-link">
                        <div class="box">
                            <div class="image icon"><i class="icon ion-android-mail"></i></div>
                            <div class="text">Send SMS</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <a href="#!" class="box-link">
                        <div class="box">
                            <div class="image icon"><i class="icon ion-android-time"></i></div>
                            <div class="text">Schedule SMS</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <a href="{{route('faqs_path')}}" class="box-link">
                        <div class="box">
                            <div class="image icon"><i class="icon ion-clipboard"></i></div>
                            <div class="text">FAQs</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <a href="#!" class="box-link">
                        <div class="box">
                            <div class="image icon"><i class="icon ion-android-contacts"></i></div>
                            <div class="text">My Contacts</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <a href="{{route('profile_path')}}" class="box-link">
                        <div class="box">
                            <div class="image icon"><i class="icon ion-wrench"></i></div>
                            <div class="text">Profile</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <a href="#!" class="box-link">
                        <div class="box">
                                <div class="image icon"><i class="icon ion-cash"></i></div>
                                <div class="text">Buy More Units</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('head')
    <style type="text/css">
        div.box {
            width: 100%;
            height: 165px;
            border: 1px solid #0db7c4;
            background: #0db7c4;
            border-radius: 5px;
            color: white;
            margin-top: 10px;
        }

        a.box-link {
            color: white;
            font-family: Raleway, Georgia;
            font-weight: bold;
        }

        a:hover {
            text-decoration: none;
        }

        a:hover div.icon i {
            font-size: 80px;
        }

        div.icon {
            height: 65%;
            position: relative;
        }

        div.icon i {
            display: block;
            font-size: 68px;
            text-align: left;
            padding-left: 25px;
            padding-top: 20px;
        }

        div.text {
            text-align: left;
            display: block;
            height: 35%;
            font-size: 17px;
            padding-top: 0px;
            padding-left: 25px;
        }
    </style>
@endsection