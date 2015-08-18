@extends('layouts.frontend.master')

@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="/assets/uikit/css/components/datepicker.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.common.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.default.min.css">
@stop
<?php
$senderid_tooltip = '11 alphanumeric characters or 14 numeric characters';
$recipients_tooltip = 'Up to 500 recipients separated with commas';
$message_tooltip = '';
$schedule_tooltip = 'Choose a later date and time for successful delivery of your message';
?>
@section('content')
<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Bulk SMS</h1>
    <p class="uk-lead">Send SMS to over 500 recipients at a time</p>

    @include('layouts.frontend.partials.errors', ['error_header'=>'Your form contains some errors'])

    {!! Form::open(['url'=>'messaging/bulk-sms', 'class'=>'uk-form uk-form-horizontal uk-margin-large-top', 'id'=>'bulk-sms', 'files'=>true]) !!}
    <div class="uk-flex">
        <div class="uk-width-1-3 uk-panel uk-panel-box">
            <h4>Select from Groups</h4>
            <div class="uk-scrollable-box">
                <ul class="uk-list">
                @foreach($groups as $group)
                    <li>
                        <label>
                            {!! Form::checkbox('groups[]', $group->id, false, ['id'=>'groups']) !!}
                            {{$group->group_name}}
                        </label>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-1-3 uk-panel uk-panel-box uk-margin-left">
            <h4>Select from Contacts</h4>
            <div class="uk-scrollable-box">
                <ul class="uk-list">
                @foreach($contacts as $contact)
                    <li>
                        <label title="{{$contact->gsm}}">
                            {!! Form::checkbox('contacts[]', $contact->id, false, ['id'=>'contacts']) !!}
                            {{$contact->firstname}}  {{!empty($contact->lastname) ? :'' }}
                        </label>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-1-3 uk-panel uk-panel-box uk-margin-left">
            <div id="upload-drop" class="uk-placeholder">
                <p><i class="uk-icon-cloud-upload uk-icon-medium"></i> Drag and drop your files here or
                    <a class="uk-form-file">Select a file<input id="upload-select" type="file" name="files[]"></a>
                </p>
            </div>
            <div id="progressbar" class="uk-progress uk-hidden">
                <div class="uk-progress-bar" style="width: 0%;"></div>
            </div>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row uk-margin">
        {!! Form::label('recipients', 'Recipients', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::textarea('recipients', Input::old('recipients'), ['placeholder'=>'Recipients','rows'=>4,'cols'=>55,]) !!}

            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$recipients_tooltip}}"></a>
            <p id="noOfRecipients"></p>
        </div>
    </div>

    <hr class="uk-grid-divider">

    <div class="uk-form-row uk-margin">
        {!! Form::label('sender', 'Sender ID', ['class'=>'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::text('sender', Input::old('sender'), ['placeholder'=>'Sender ID','required','maxlength'=>14]) !!}
            <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$senderid_tooltip}}"></a>
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

    <div class="uk-form-row" id="schedule-control">
        <div class="uk-form-controls">
            <label>{!! Form::checkbox('schedule_control', 1, false, ['id'=>'schedule_control']) !!} Schedule to send later </label>
            <div class="uk-margin-top" id="schedule-div" style="display:none">
                {!! Form::text('schedule', Input::old('schedule'), ['placeholder'=>'YYYY-MM-DD HH:MM AM/PM','id'=>'schedule',]) !!}
                <a href="#" class="uk-icon-justify uk-icon-info-circle uk-vertical-align-middle uk-margin-left" data-uk-tooltip title="{{$schedule_tooltip}}"></a>
            </div>
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
            {!! Form::button('Send', ['type'=>'submit','class'=>'uk-button uk-button-primary','id'=>'submit_']) !!}
        </div>
    </div>


    {!! Form::close() !!}

</div>
@stop

@section('foot')
@parent
<script src="/assets/kendoui/js/kendo.all.min.js"></script>
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/uikit/js/components/tooltip.min.js"></script>
<script src="/assets/uikit/js/components/upload.js"></script>
<script src="/assets/js/jquery.simplyCountable.js"></script>
<script src="/assets/js/jquery.autosize-min.js"></script>
<script>

$(function(){


if ( $('#schedule_control').prop("checked") === true ) {
    showElement('#schedule-div');
} else if ( $('#schedule_control').prop("checked") === false ) {
    hideElement('#schedule-div');
}


$("#schedule").kendoDateTimePicker({
    value: new Date(),
    min: new Date(),
    format: "yyyy-MM-dd HH:mm"
});


$('#schedule_control').on('change', function(){

    var $this = $(this);

    if( $this.prop("checked") ) {
        showElement('#schedule-div');
        enableInput('#schedule');
    } else {
        hideElement('#schedule-div');
        disableInput('#schedule');
    }
});


$('#message').simplyCountable({
    counter: '#characterCount',
    countType: 'characters',
    maxCount: 320,
    countDirection: 'up',
    strictMax: true
});

var maxNoOfRecipients = 500;
$('#recipients').on('keyup focus blur click change', function(event){

    if ( true )
    {
        $(this).val ( $(this).val().replace(/[^\d(,)]/g,'') );

        $val = $(this).val().trim();

        //split textarea input with comma
        $arrayNumbers = $val.split(',');

        if ( $arrayNumbers.length > maxNoOfRecipients ) {
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
        $('#noOfRecipients').html($length + '/' + maxNoOfRecipients);
    }
});

var progressbar = $("#progressbar"),
    bar         = progressbar.find('.uk-progress-bar'),
    settings    = {

    action: '/messaging/bulk-sms/fileupload', // upload url

    allow : '*.(csv|txt)', // allow only csv, txt

    loadstart: function() {
        bar.css("width", "0%").text("0%");
        progressbar.removeClass("uk-hidden");
    },

    progress: function(percent) {
        percent = Math.ceil(percent);
        bar.css("width", percent+"%").text(percent+"%");
    },

    allcomplete: function(response) {

        bar.css("width", "100%").text("100%");

        setTimeout(function(){
            progressbar.addClass("uk-hidden");
        }, 250);

        simulateEvent('focus', '#recipients');
        alert_("Upload Completed")
    },

    complete: function(response, xhr) {
        var $recipients = $('#recipients');
        var res = $.parseJSON(response);
        if ( $recipients.val() != "" ){
            $recipients.val( $recipients.val() + "," + res.out );
        } else{
            $('#recipients').val( res.out );
        }
    },

    error: function() {
        alert_("Unknown Error...")
    }
};

var select = UIkit.uploadSelect($("#upload-select"), settings),
    drop   = UIkit.uploadDrop($("#upload-drop"), settings);
});


/**
     * These are all the stuffs we want to run first as page has loaded
     * @TODO make all modules here functions.
     */
    simulateEvent('focus', '#recipients');
    $('#message').autosize();


</script>
@stop