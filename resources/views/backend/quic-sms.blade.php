@extends('layouts.backend.template')

@section('content')



        <div class="container">

                <h2 class="ui header">
                  <i class="settings icon"></i>
                  <div class="content">
                    Quic SMS
                    <div class="sub header">Send SMS to not more than 50 recipients</div>
                  </div>
                </h2>
                <div class="ui divider"></div>

                <div class="ui segment" id="quic-sms-form">

                    {!!Form::open(['class'=>'ui form'])!!}

                          <div class="inline field">
                            <label>Sender ID</label>
                            <input type="text" placeholder="Full Name">
                          </div>

                        <div class="ui section divider"></div>

                          <div class="inline field">
                            <label>Recipients</label>
                            <textarea name="recipients" id="recipients"></textarea>
                          </div>

                        <div class="inline" style="padding-bottom:30px;">
                            <div class="five wide field">
                                <label>Sender ID</label>
                                <input type="text">
                            </div>
                        </div>


                        <div class="field" style="padding-bottom:20px;">
                            <label>Recipients</label>
                            <textarea name="recipients" id="recipients"></textarea>
                        </div>



                        <div class="field" style="padding-bottom:20px;">
                            <label>Message</label>
                            <textarea name="message" id="message"></textarea>
                        </div>


                        <div class="ui segment">
                            <div class="field">
                                <div class="ui toggle checkbox">
                                    <input name="schedule_control" id="schedule_control" type="checkbox" value="1" tabindex="0">
                                    <label>Schedule Message</label>
                                </div>
                                <div id="schedule-div" style="padding-top: 1em;display: none;">
                                    {!! Form::text('schedule', Input::old('schedule'), ['placeholder'=>'YYYY-MM-DD HH:MM AM/PM','id'=>'schedule','class'=>'padding:0px;']) !!}
                                </div>

                            </div>
                        </div>


                        <div class="ui segment">
                            <div class="field">
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" value="1" name="gift" tabindex="0">
                                    <label>Send Message as Flash</label>
                                </div>
                            </div>
                        </div>

                        <button class="ui labeled icon button blue">
                          <i class="send icon"></i>
                          Send Now
                        </button>
                        <button class="ui right labeled icon button">
                          <i class="suitcase arrow icon"></i>
                          Save as Draft
                        </button>


                    {!!Form::close()!!}

                </div>

        </div>
@endsection

@section('foot')
@parent
<script src="/assets/js/jquery.autogrowtextarea.min.js"></script>
<script src="/assets/kendoui/js/kendo.all.min.js"></script>
<script>
$(function(){

$("#schedule").kendoDateTimePicker({
    value: new Date(),
    min: new Date(),
    format: "yyyy-MM-dd HH:mm"
});
var datetimepicker = $("#schedule").data("kendoDateTimePicker");

if ( $('#schedule_control').prop("checked") === true ) {
    showElement('#schedule-div');
    datetimepicker.enable(true);
} else if ( $('#schedule_control').prop("checked") === false ) {
    hideElement('#schedule-div');
    datetimepicker.enable(false);
}

$('#schedule_control').on('change', function(){

    var $this = $(this);

    if( $this.prop("checked") ) {
        showElement('#schedule-div');
        datetimepicker.enable(true);
    } else {
        hideElement('#schedule-div');
        datetimepicker.enable(false);
    }
});

$('#message').autoGrow();
$('#recipients').autoGrow();
});

function showElement(el) {
    $(el).fadeIn('slow').show();
}

function hideElement(el) {
    $(el).fadeOut('slow').hide().slideUp();
}
</script>
@endsection


@section('head')
@parent
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.common.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.default.min.css">
@stop