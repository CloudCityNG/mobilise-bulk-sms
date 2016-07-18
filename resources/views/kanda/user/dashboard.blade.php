@extends('layouts.kanda.frontend')

@section('title', 'Welcome to your Dashboard')
@section('foot')
    <script src="/kanda/js/dashboard.js"></script>
@stop
@section('content')

    <div class="boxx" id="dashboard">
        <h2 class="ui header">
            <i class="plug icon"></i>

            <div class="content">
                Dashboard
            </div>
        </h2>
        <div class="ui three column grid">
            <div class="column">
                <div class="ui segment center" data-url="{{$sideMenu->quick_sms}}">
                    <i class="olive huge send outline icon"></i>

                    <h3 class="dashboard-title">Send SMS</h3>
                </div>
            </div>

            <div class="column">
                <div class="ui segment center" data-url="{{$sideMenu->sent_messages}}">
                    <i class="blue huge history icon"></i>

                    <h3 class="dashboard-title">Message History</h3>
                </div>
            </div>

            <div class="column">
                <div class="ui segment center" data-url="{{$sideMenu->contacts}}">
                    <i class="pink huge save icon"></i>

                    <h3 class="dashboard-title">My PhoneBook</h3>
                </div>
            </div>
        </div>
        <div class="ui three column grid">
            <div class="column">
                <div class="ui segment center" data-url="/user/credit-purchase">
                    <i class="purple huge payment icon"></i>

                    <h3 class="dashboard-title">Buy Credits</h3>
                </div>
            </div>

            <div class="column">
                <div class="ui segment center" data-url="#">
                    <i class="violet huge write icon"></i>

                    <h3 class="dashboard-title">Draft SMS</h3>
                </div>
            </div>

            <div class="column">
                <div class="ui segment center" data-url="#">
                    <i class="teal huge settings icon"></i>

                    <h3 class="dashboard-title">Personal Settings</h3>
                </div>
            </div>
        </div>
    </div>


@endsection