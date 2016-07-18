@extends('layouts.kanda.frontend')

@section('head')
@endsection

@section('foot')
    <script src="/js/vue.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/expanding.js"></script>

@endsection

@section('content')
    <div class="boxx" id="app">
        <h2 class="ui header">
            <i class="plug icon"></i>

            <div class="content">
                Send SMS
            </div>
        </h2>

        @include('layouts.kanda.partials.errors')

        {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'ui form', 'id'=>'quick-sms', 'autocomplete'=>'off']) !!}

                <!-- SENDER -->
        <div class="ui segment">
            <div class="inline fields" id="senderTypeGroup">
                <label for="fruit">Select your sender type:</label>

                <div class="field">
                    <div class="ui radio checkbox box2">
                        <input type="radio" name="sender_type" id="sender_type2" value="2" tabindex="0" class="hidden"
                               checked="checked">
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
                <input type="text" name="sender" id="sender" placeholder="Sender ID" value="{!! old('sender') !!}"
                       v-model="sender" maxlength="11">
            </div>
        </div>

        <!-- RECIPIENTS -->
        <div class="ui segment">
            <div class="field">
                <label>Recipients</label>

                <div class="ui top attached tabular menu">
                    <a class="active item" data-tab="numbers">Manual Input</a>
                    <a class="item" data-tab="file">Upload</a>
                    <a class="item" data-tab="contacts">Contacts</a>
                    <a class="item" data-tab="groups">Groups</a>
                </div>

                <div class="ui bottom attached active tab segment" data-tab="numbers">
                    <textarea name="recipients" id="recipients" rows="2" placeholder="Recipients" v-model="recipients" class="expanding">{!! old('recipients') !!}</textarea>
                </div>

                <div class="ui bottom attached tab segment" data-tab="file">
                    file upload
                </div>

                <div class="ui bottom attached tab segment" data-tab="contacts">
                    contacts
                </div>

                <div class="ui bottom attached tab segment" data-tab="groups">
                    groups
                </div>

            </div>
        </div>

        <!-- MESSAGE -->
        <div class="field">
            <div class="ui segment">
                <div class="ui two column very relaxed stackable grid">
                    <div class="column">
                        <label>Message</label>
                    <textarea name="message" id="message" v-model="message"
                              v-on:keyup="countCharacters">{!! old('message') !!}</textarea>
                        <br>
                        <span>@{{ messageCounter }} Characters</span>
                    </div>

                    <div class="ui vertical divider">Preview</div>

                    <div class="column">
                        <span style="font-size:15px;font-weight:bold;line-height:1.7em;">
                            @{{{ displayMessage }}}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SCHEDULE -->
        <div class="field">
            <div class="ui segment">
                <div class="ui toggle checkbox scheduleControl">
                    <input name="scheduleControl" id="scheduleControl" type="checkbox" tabindex="0" class="hidden"
                           value="1">
                    <label>Schedule Message</label>
                </div>
                <div class="ui" id="schedule-div" style="margin-top: 10px;">
                    <input name="schedule" id="schedule" type="text" value="{!! old('schedule') !!}"/>
                </div>
            </div>
        </div>

        <!-- FLASH -->
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