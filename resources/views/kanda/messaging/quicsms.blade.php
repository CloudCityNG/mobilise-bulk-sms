@extends('layouts.kanda.frontend')

@section('foot')
@parent
<script src="/js/app.js"></script>

@endsection

@section('content')
<div class="boxx">

    <form class="ui form">

        <div class="inline fields" id="senderTypeGroup">
            <label for="fruit">Select your sender type:</label>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="sender_type" id="sender_type1" value="1" checked="" tabindex="0" class="hidden">
                <label>My Phone number</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="sender_type" id="sender_type2" value="2" tabindex="0" class="hidden">
                <label>Alphanumeric</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="sender_type" id="sender_type3" value="3" tabindex="0" class="hidden">
                <label>Phone Number</label>
              </div>
            </div>
          </div>


        <div class="field">
            <label>Sender</label>
            <input type="text" name="sender" id="sender" placeholder="Sender ID">
        </div>

        <div class="field">
            <label>Recipients</label>
            <textarea name="recipients" id="recipients" rows="2" placeholder="Recipients"></textarea>
            <span id="noOfRecipients">0</span> Recipient(s)
        </div>

        <div class="field">
            <label>Message</label>
            <textarea name="message" id="message"></textarea>
            <span id="messageLength"></span>
        </div>

        <div class="field">
            <div class="ui segment">
                <div class="ui toggle checkbox">
                    <input name="scheduleControl" id="scheduleControl" type="checkbox" tabindex="0" class="hidden">
                    <label>Schedule Message</label>
                </div>
            </div>
        </div>

      <div class="ui segment">
        <div class="field">
            <div class="ui toggle checkbox">
              <input type="checkbox" tabindex="0" class="hidden">
              <label>Send as Flash message</label>
            </div>
          </div>
      </div>

      <button class="ui button" type="submit">Submit</button>
    </form>

</div>
@endsection