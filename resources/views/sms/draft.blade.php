@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Draft Sms</h3>
    </div>
</div>

<div class="row">

    <div class="col-lg-6">
        @include('layouts.partials.errors', ['error_header'=>'Cannot Save Draft.'])
        {!! Form::open(['route'=>'postdraft_path','autocomplete'=>'off']) !!}
                <div class="form-group">
                    {!! Form::label('subject', 'Subject: ') !!}
                    {!! Form::text('subject', null, ['class'=>'form-control','maxlength'=>55]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('recipients', 'Recipient(s): ') !!}
                    {!! Form::textarea('recipients', null, ['class'=>'form-control','rows'=>3]) !!}
                </div>

                <div class="form-group message_group">
                    {!! Form::label('message', 'Message: ') !!}
                    {!! Form::textarea('message', null, ['id'=>'message_box','class'=>'form-control','rows'=>5]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Save Draft', ['class'=>'btn btn-primary']) !!}
                </div>
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