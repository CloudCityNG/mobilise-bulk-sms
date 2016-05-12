@extends('layouts.kanda.frontend')

@section('head')
@parent
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.common.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.default.min.css">
<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
<style type="text/css">
input#schedule{
padding: 0px;
}
</style>
@endsection

@section('foot')
@parent
<script src="/js/vue.js"></script>
<script src="/assets/kendoui/js/kendo.all.min.js"></script>
<script src="/assets/js/jquery.simplyCountable.js"></script>
<script src="/js/app.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>

<script>
new Vue({
    el: '#app',
    data: {
        message: '',
        recipients: '',
        sender: '',
        counter2: 0,
    },

    methods: {
        countCharacters: function(){
            this.counter2 = this.message.length;
        }
    },

    ready: function() {
        //this.countCharacters
    }
});
</script>

<script>
$(document).ready(function()
{
var $recipients = $('#recipients');
	var uploadObj = $("#fileuploader").uploadFile
	({

	    url:"bulk-sms/fileupload",
        fileName:"bulkSmsFile",
        maxFileCount:10,
        onSuccess: function(files, data, xhr, pd)
        {
            if ( $recipients.val() != "" )
            {
                $recipients.val( $recipients.val() + "," + data.out );
            }
            else
            {
                $('#recipients').val( data.out );
            }
            $recipients.trigger('focus')
            $('.ajax-file-upload-statusbar').hide();
        },
        onError: function(files,status,errMsg,pd)
        {
                swal('error', "Unknown error please try again.");
                $('.ajax-file-upload-statusbar').hide();
        }
    });


    uploadObj.reset();
});
</script>


<script>
$(function(){

var form = $('form#quick-sms');

$('button#draft').click(function(){
    form.prop('action', '/messaging/draft-sms');
    form.submit();
});

$('button#send').click(function(){
    form.prop('action', '/messaging/quick-sms');
    form.submit();
});
});
</script>

@endsection

@section('content')
<div class="boxx" id="app">

    @include('layouts.kanda.partials.errors')

    {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'ui form', 'id'=>'quick-sms', 'autocomplete'=>'off']) !!}

        <div class="inline fields" id="senderTypeGroup">
            <label for="fruit">Select your sender type:</label>
            {{--<div class="field">--}}
              {{--<div class="ui radio checkbox box1">--}}
                {{--<input type="radio" name="sender_type" id="sender_type1" value="1" checked="" tabindex="0" class="hidden">--}}
                {{--<label>My Phone number</label>--}}
              {{--</div>--}}
            {{--</div>--}}
            <div class="field">
              <div class="ui radio checkbox box2">
                <input type="radio" name="sender_type" id="sender_type2" value="2" tabindex="0" class="hidden" checked="checked">
                <label>Alphanumeric</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox box3">
                <input type="radio" name="sender_type" id="sender_type3" value="3" tabindex="0" class="hidden">
                <label>Phone Number</label>
              </div>
            </div>
          </div>


        <div class="field">
            <label>Sender</label>
            <input type="text" name="sender" id="sender" placeholder="Sender ID" value="{!! old('sender') !!}" v-model="sender" maxlength="11">
        </div>

        <div class="field">
            <label>Recipients</label>
            <textarea name="recipients" id="recipients" rows="2" placeholder="Recipients" v-model="recipients">{!! old('recipients') !!}</textarea>
            <span id="noOfRecipients">0</span> Recipient(s) <div id="fileuploader">Upload</div>
        </div>

        <div class="field">
            <label>Message</label>
            <textarea name="message" id="message" v-model="message" v-on:keyup="countCharacters">{!! old('message') !!}</textarea>
            {{--<span id="counter">0</span> Characters, <span id="pages">0</span>--}}
            <br> <span>@{{ counter2 }} Characters</span>
        </div>

        <div class="field">
            <div class="ui segment">
                <div class="ui toggle checkbox scheduleControl">
                    <input name="scheduleControl" id="scheduleControl" type="checkbox" tabindex="0" class="hidden" value="1">
                    <label>Schedule Message</label>
                </div>
                <div class="ui" id="schedule-div" style="margin-top: 10px;">
                    <input name="schedule" id="schedule" type="text" value="{!! old('schedule') !!}" />
                </div>
            </div>
        </div>

      <div class="ui segment">
        <div class="field">
            <div class="ui toggle checkbox flash">
              <input name="flash" id="flash" type="checkbox" tabindex="0" class="hidden" value="1">
              <label>Send as Flash message</label>
            </div>
          </div>
      </div>

      <button class="ui button primary" type="submit" id="send" v-show="message && recipients && sender">Send</button>
      <button class="ui button orange" type="button" id="draft">Save as Draft</button>
    {!! Form::close() !!}

</div>
@endsection