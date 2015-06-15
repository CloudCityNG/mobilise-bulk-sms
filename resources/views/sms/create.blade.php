@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h3 class="page-header">New SMS</h3>
        @include('layouts.partials.errors', ['error_header'=>'Sms Sending Failed'])
        {!! Form::open(['route'=>'new_sms_path','autocomplete'=>'off']) !!}
            <div class="form-group">
                {!! Form::label('senderid', 'Sender ID: ') !!}
                {!! Form::text('senderid', null, ['class'=>'form-control','maxlength'=>15]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('recipient', 'Recipient(s): ') !!}
                {!! Form::textarea('recipients', null, ['class'=>'form-control','rows'=>3]) !!}
            </div>
            <div class="form-group message_group">
                {!! Form::label('message', 'Message: ') !!}
                {!! Form::textarea('message', null, ['id'=>'message_box','class'=>'form-control','rows'=>5]) !!}
            </div>
            <div class="form-group">
                <div class="radio">
                    <label class="col-md-3">
                        {!! Form::radio('send_option', 'send', true) !!} Send Now
                    </label>
                    <label class="col-md-3">
                        {!! Form::radio('send_option', 'schedule') !!} Schedule
                    </label>
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit('Send', ['class'=>'btn btn-primary']) !!}
            </div>
            <input type="hidden" name="schedule" value="">
        {!! Form::close() !!}
    </div>
</div>

@stop

@section('foot')
@parent
    {!! HTML::script('/js/jquery.textareaCounter.plugin.js') !!}

    <script>
    $(function(){
        var limitCounter = {
            'maxCharacterSize':320,
            'originalStyle':'originalDisplayInfo',
            'warningStyle':'warningDisplayInfo',
            'warningNumber':40,
            'displayFormat':'#left characters remaining'
        };
        $('#message_box').textareaCount(limitCounter);
    });
    </script>
@stop

@section('head')
@parent
@stop