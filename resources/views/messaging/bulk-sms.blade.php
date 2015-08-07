@extends('layouts.frontend.master')

@section('head')
@parent
@stop

@section('content')
<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Bulk SMS</h1>
    <p class="uk-lead">Send SMS to over 50 recipients</p>

    {!! Form::open(['url'=>'messaging/bulk-sms', 'class'=>'uk-form uk-form-horizontal uk-margin-large-top', 'id'=>'bulk-sms']) !!}
    <div class="uk-flex">
        <div class="uk-width-1-3 uk-panel uk-panel-box">
            <h4>Select from Groups</h4>
            <div class="uk-scrollable-box">
                <ul class="uk-list">
                @foreach($groups as $group)
                    <li>
                        <label><input type="checkbox" name="{{$group->id}}"> {{$group->group_name}}</label>
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
                        <label title="{{$contact->gsm}}"><input type="checkbox" name="{{$contact->id}}"> {{$contact->firstname}}</label>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-1-3 uk-panel uk-panel-box uk-margin-left">
            <div id="upload-drop" class="uk-placeholder">
                <p><i class="uk-icon-cloud-upload uk-icon-medium"></i> Drag and drop your files here or
                    <a class="uk-form-file">Select a file<input id="upload-select" type="file"></a>
                </p>
            </div>
            <div id="progressbar" class="uk-progress uk-hidden">
                <div class="uk-progress-bar" style="width: 0%;"></div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</div>
@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/uikit/js/components/datepicker.min.js"></script>
<script src="/assets/uikit/js/components/timepicker.min.js"></script>
<script src="/assets/uikit/js/components/autocomplete.min.js"></script>
<script>

$(function(){

var progressbar = $("#progressbar"),
    bar         = progressbar.find('.uk-progress-bar'),
    settings    = {

    action: '/', // upload url

    allow : '*.(jpg|jpeg|gif|png)', // allow only images

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

        alert("Upload Completed")
    }
};

var select = UIkit.uploadSelect($("#upload-select"), settings),
    drop   = UIkit.uploadDrop($("#upload-drop"), settings);
});

</script>
@stop