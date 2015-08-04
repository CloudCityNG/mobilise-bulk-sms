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
<div class="uk-panel {{Request::segment(2)}}">

    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Quick SMS</h1>
    <p class="uk-lead">Send SMS with less than or 50 recipients</p>

    @include('layouts.frontend.partials.errors', ['error_header'=>'Your form contains some errors'])

    {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'uk-form uk-form-horizontal uk-margin-large-top', 'id'=>'quick-sms']) !!}
    <div class="uk-form-row uk-margin">
        {!! Form::label('sender', 'Sender ID', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::text('sender', Input::old('senderid'), ['placeholder'=>'Sender ID','required']) !!}
            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$senderid_tooltip}}"></a>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row uk-margin">
        {!! Form::label('recipients', 'Recipients', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::textarea('recipients', Input::old('recipients'), ['placeholder'=>'Recipients','rows'=>4,'cols'=>55,'required']) !!}

            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$recipients_tooltip}}"></a>
            <p id="noOfRecipients"></p>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row uk-margin">
        {!! Form::label('message', 'Message', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::textarea('message', Input::old('message'), ['placeholder'=>'Message','rows'=>4,'cols'=>55,'required']) !!}
            <p><span id="characterCount"></span> Characters. 160characters = 1page</p>
        </div
    </div>

    <hr class="uk-grid-divider">
    <a href="#" class="uk-button uk-button-mini" data-uk-toggle="{target:'#schedule-control'}">Schedule</a>

    <div class="uk-form-row uk-hidden" id="schedule-control">
        {!! Form::label('schedule_date', 'Schedule', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            <?php $now = date('Y-m-d', time()); ?>
            {!! Form::text('schedule_date', Input::old('schedule_date'), ['placeholder'=>'Date','data-uk-datepicker'=>"{format:'YYYY-MM-DD',minDate:'$now'}",'class'=>'uk-form-width-small']) !!}
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
            {!! Form::button('Send', ['type'=>'button','class'=>'uk-button uk-button-primary','id'=>'submit_']) !!}
            {!! Form::button('Save as Draft', ['type'=>'button','class'=>'uk-button','id'=>'draft']) !!}
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
<script src="/assets/js/jquery.simplyCountable.js"></script>
<script>
$(function(){

$('#message').simplyCountable({
    counter: '#characterCount',
    countType: 'characters',
    maxCount: 320,
    countDirection: 'up',
    strictMax: true
});

$('#recipients').on('keyup', function(event){

    if ( true )
    {
        $(this).val ( $(this).val().replace(/[^\d(,)]/g,'') );

        $val = $(this).val().trim();

        //split textarea input with comma
        $arrayNumbers = $val.split(',');

        if ( $arrayNumbers.length > 50 ) {
            $(this).val ( recipientsCopy );
            return;
        }

        //internal length
        $length = 0;

        $.each($arrayNumbers, function(index, value){

            if ( value ){
                $length++;
            }

        });

        recipientsCopy = $(this).val();
        $globalLength = $length;
        $('#noOfRecipients').html($length + '/50');
    }
});


var form = $('form#quick-sms')

$('button#draft').click(function(){

    form.prop('action', '/messaging/draft-sms');

    if ( $('#flash').is(":checked") === false ){
        form.append('<input name="flash" type="hidden" value="0"/>');
    }

    form.submit();
});

$('button#submit_').click(function(){

    form.prop('action', '/messaging/quick-sms');

    if ( $('#flash').is(":checked") === false ){

        form.append('<input name="flash" type="hidden" value="0"/>');
    }

    form.submit();
});



});
</script>

@stop