@extends('layouts.kanda.frontend')

@section('head')
@parent
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.common.min.css">
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.default.min.css">
<style type="text/css">
input#schedule{
padding: 0px;
}
</style>
@endsection

@section('foot')
@parent
<script src="/assets/kendoui/js/kendo.all.min.js"></script>
<script src="/assets/js/jquery.simplyCountable.js"></script>
<script src="/js/app.js"></script>

@endsection

@section('content')
<div class="boxx">

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
            <input type="text" name="sender" id="sender" placeholder="Sender ID" value="{!! old('sender') !!}">
        </div>

        <div class="field">
            <label>Recipients</label>
            <textarea name="recipients" id="recipients" rows="2" placeholder="Recipients">{!! old('recipients') !!}</textarea>
            <span id="noOfRecipients">0</span> Recipient(s)
        </div>

        <div class="field">
            <label>Message</label>
            <textarea name="message" id="message">{!! old('message') !!}</textarea>
            <span id="counter">0</span> Characters, <span id="pages">0</span>
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

      <button class="ui button primary" type="submit" id="send">Send</button>
      <button class="ui button orange" type="button" id="save">Save</button>
    {!! Form::close() !!}

</div>
@endsection