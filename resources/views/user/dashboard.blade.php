@extends('layouts.frontend.master')

@section('content')

<div class="uk-block uk-block-muted dashboard">

    <div class="uk-container">

    <h3>Dashboard</h3>

        <div class="uk-grid uk-grid-match" data-uk-grid-margin>
            <div class="uk-width-medium-1-3">
                <div class="uk-panel">
                <a href="{{url('messaging/quick-sms')}}">
                    <i class="uk-icon-pencil-square"></i>
                    <p>Compose SMS</p>
                </a>
                </div>
            </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-panel">
                    <a href="{{url('address-book')}}">
                    <i class="uk-icon-list"></i>
                    <p>Address Book</p>
                    </a>
                </div>
            </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-panel">
                    <a href="#">
                    <i class="uk-icon-money"></i>
                    <p>Buy SMS Credit</p>
                    </a>
                </div>
            </div>


            <div class="uk-width-medium-1-3">
                <div class="uk-panel">
                    <a href="">
                    <i class="uk-icon-plus-circle"></i>
                    <p>Add a new Sender ID</p>
                    </a>
                </div>
            </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-panel">
                <a href="#">
                    <i class="uk-icon-gears"></i>
                    <p>Edit My Settings</p>
                </a>
                </div>
            </div>
            <div class="uk-width-medium-1-3">
                <div class="uk-panel">
                    <a href="#">
                        <i class="uk-icon-bar-chart"></i>
                        <p>Reports</p>
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>

{{--<div class="uk-panel uk-panel-box">--}}
    {{--<div class="uk-panel-badge uk-badge">Its sales time hurry!</div>--}}
    {{--<h3 class="uk-panel-title">Quick-SMS</h3>--}}
    {{--Content here--}}
{{--</div>--}}
@stop

@section('head')
@parent
<style type="text/css">
.dashboard .uk-panel {
    text-align: center;
}
.dashboard .uk-panel a {
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1em;
}
.dashboard .uk-panel i {
    color: #CD183C;
    font-size: 4em;
}
</style>
@stop