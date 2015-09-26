@extends('layouts.frontend.master')

@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="/assets/uikit/css/components/datepicker.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.common.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.default.min.css">
@stop

@section('content')
<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">File 2 SMS</h1>
    <p class="uk-lead">Upload your files containing bulk SMS</p>


    <div class="uk-alert">
        <h4>Heads Up.</h4>
        Your file must follow the sample given here [File Sample]
    </div>
    @include('layouts.frontend.partials.errors', ['error_header'=>'Your form contains some errors'])

    {!! Form::open(['url'=>'messaging/bulk-sms', 'class'=>'uk-form uk-form-horizontal uk-margin-large-top', 'id'=>'bulk-sms', 'files'=>true]) !!}
    <div class="uk-flex">

        <div class="uk-width-1-1 uk-panel uk-panel-box uk-margin-left">
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

    <table class="uk-table" id="response">
        <tr>
            <th class="uk-width-1-5"></th>
            <th class="uk-width-1-5">Sender</th>
            <th class="uk-width-1-5">Recipients</th>
            <th class="uk-width-1-5">Message</th>
            <th class="uk-width-1-5">Schedule</th>
        </tr>
    </table>


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
<script src="/assets/uikit/js/components/upload.js"></script>
<script>

$(function(){

var progressbar = $("#progressbar"),
    bar         = progressbar.find('.uk-progress-bar'),
    settings    = {

    action: '/messaging/file2sms/fileupload', // upload url

    allow : '*.(csv)', // allow only csv, txt

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
        var $response = $('#response');
        var res = $.parseJSON(response);

        $.each(res.out, function(index, value){

            $response.append("<tr>" +
                                '<td class="uk-width-1-5"><input type="checkbox" name="send[]" value="1"></td>' +
                                '<td class="uk-width-1-5">'+ value.sender +"</td>" +
                                '<td class="uk-width-1-5"><div class="uk-panel uk-panel-box uk-clearfix uk-responsive-width"><span style="width:250px">'+value.recipients+"</span></div></td>" +
                                '<td class="uk-width-1-5">'+value.message+"</td>" +
                                '<td class="uk-width-1-5">'+ value.schedule +"</td></tr>");

        });

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



</script>
@stop