@extends('layouts.frontend.master')

@section('head')
@parent
@stop

@section('content')
<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Bulk SMS</h1>
    <p class="uk-lead">Send SMS to over 50 recipients</p>

    {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'uk-form uk-form-horizontal uk-margin-large-top', 'id'=>'quick-sms']) !!}

</div>
@stop

@section('foot')
@parent
@stop