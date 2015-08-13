@extends('layouts.frontend.master')


@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Credits Purchase Confirmation</h1>
    <p class="uk-lead">Confirm your credit purchase</p>


    <div class="uk-flex">
        <div class="uk-width-1-1 uk-panel uk-panel-box">
        <p>You have requested to buy <div class="uk-badge uk-badge-notification">{{number_format($sms_quantity,2)}} Units</div>

            at the rate of

                <div class="uk-badge uk-badge-notification">₦{{$unit_price}}</div> whose total cost is

                <div class="uk-badge uk-badge-notification">₦{{money_format($total_cost,2)}}</div>
        </p>
        <br/>
        <br/>
        <p>Please confirm by clicking <a class="uk-button uk-button-primary" href="#">Continue</a> </p>
        </div>

    </div>

    <hr class="uk-grid-divider">


</div>

@stop

@section('foot')
@parent

@stop