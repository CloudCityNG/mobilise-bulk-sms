@extends('layouts.frontend.master')

@section('head')
@parent
<link rel="stylesheet" href="/assets/uikit/css/components/datepicker.min.css">
@stop

@section('content')
<?php
$senderid_tooltip = '11 alphanumeric characters or 14 numeric characters';
$recipients_tooltip = 'Not more than 50 recipients separated with commas';
$message_tooltip = '';
$schedule_tooltip = 'Choose a later date and time for successful delivery of your message';
?>
<div class="uk-panel all-contacts">
    <div class="uk-panel-badge uk-badge"></div>
    <h3 class="uk-panel-title">Quick SMS</h3>

    {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'uk-form uk-form-horizontal', 'id'=>'quick-sms']) !!}
    <div class="uk-form-row uk-margin">
        {!! Form::label('sender', 'Sender ID', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::text('sender', Input::old('senderid'), ['placeholder'=>'Sender ID']) !!}
            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$senderid_tooltip}}"></a>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row uk-margin">
        {!! Form::label('recipients', 'Recipients', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::textarea('recipients', Input::old('recipients'), ['placeholder'=>'Recipients','rows'=>4,'cols'=>55]) !!}
            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$recipients_tooltip}}"></a>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row uk-margin">
        {!! Form::label('message', 'Message', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::textarea('message', Input::old('message'), ['placeholder'=>'Message','rows'=>4,'cols'=>55]) !!}
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row">
        {!! Form::label('schedule', 'Schedule', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            <?php $now = date('Y-m-d', time()); ?>
            {!! Form::text('schedule', Input::old('schedule_date'), ['placeholder'=>'Date','data-uk-datepicker'=>"{format:'YYYY-MM-DD',minDate:'$now'}",'class'=>'uk-form-width-small']) !!}
            {!! Form::text('schedule_time', Input::old('schedule_time'), ['placeholder'=>'Time','data-uk-timepicker'=>"{format:'12h'}",'class'=>'uk-form-width-small']) !!}
            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$schedule_tooltip}}"></a>
        </div>
    </div>

    <hr class="uk-grid-divider">
    
    <div class="uk-form-row">
        <span class="uk-form-label"></span>

        <div class="uk-form-controls uk-form-controls-text">
            {!! Form::checkbox('flash', 1, false, ['id'=>'flash']) !!}
            <label for="flash"> Send as flash</label>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row">
        <div class="uk-form-controls">
            {!! Form::button('Send', ['type'=>'submit','class'=>'uk-button uk-button-primary']) !!}
            {!! Form::button('Save as Draft', ['type'=>'button','class'=>'uk-button']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>
@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/tooltip.min.js"></script>
<script src="/assets/uikit/js/components/datepicker.min.js"></script>
<script src="/assets/uikit/js/components/autocomplete.min.js"></script>
<script src="/assets/uikit/js/components/timepicker.min.js"></script>


@stop