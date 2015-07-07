@extends('layouts._master')

@section('foot')
@parent
<script src="/js/jquery/jquery.textareaCounter.plugin.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

    var form = $('form#quick-sms')

    $('button#draft').click(function(){
        form.prop('action', '/messaging/draft-sms');
        form.submit();
    });

    $('button#submit_').click(function(){
        form.prop('action', '/messaging/quick-sms');
        form.submit();
    });

    $('div.radios input:radio').click(function(){

        if ( $('#alpha_radio').prop("checked") ){

            $('#alpha_input').prop('disabled', false);
            $('#numeric_input').prop('disabled', true);

        } else if ( $('#numeric_radio').prop("checked") ) {

            $('#alpha_input').prop('disabled', true);
            $('#numeric_input').prop('disabled', false);
        }

    });

    //$('input:radio#alpha_radio').trigger("click");
    $('input:radio#alpha_radio').prop('checked', true);
    $('input:radio#alpha_radio').trigger("click");


    var limitCounter = {
        'maxCharacterSize':320,
        'originalStyle':'originalDisplayInfo',
        'warningStyle':'warningDisplayInfo',
        'warningNumber':40,
        'displayFormat':'#left characters remaining'
    };
    $('#message_box').textareaCount(limitCounter);


    var $globalLength=0, recipientsCopy;

    $('#recipients').on('keyup', function(event){

        if ( true )
        {
            $(this).val ( $(this).val().replace(/[^\d(,)]/g,'') );

            $val = $(this).val().trim();

            //split textarea input with comma
            $arrayNumbers = $val.split(',');

            if ( $arrayNumbers.length > 50 ) {
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
            $('#no_of_recipients').html($length + '/50');
        }
    });
});

</script>
@stop

@section('content')

    <div class="module">

        <div class="module-head"><h3>Quick SMS</h3></div>

        <div class="module-body">
            @include('flash::message')
            @include('layouts/partials/_errors')

            {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'form-horizontal row-fluid', 'id'=>'quick-sms', 'method'=>'post']) !!}

                <div class="control-group">

                    {!! Form::label('sender', 'Sender', ['class'=>'control-label']) !!}

                    <div class="controls radios">
                        <div class="contain">
                            <label class="radio span3">
                                {!! Form::radio('sender_', 'alpha', true, ['id'=>'alpha_radio']) !!} Alphanumeric
                            </label>
                                {!! Form::text('sender', Input::old('alpha_input'), ['class'=>'span5','placeholder'=>'Alphanumeric','id'=>'alpha_input']) !!}

                        </div>

                        <div class="contain">
                            <label class="radio span3">
                                {!! Form::radio('sender_', 'alpha', false, ['id'=>'numeric_radio']) !!} Numeric
                            </label>
                                {!! Form::text('sender', Input::old('numeric_input'), ['class'=>'span5','placeholder'=>'Numeric','id'=>'numeric_input']) !!}

                        </div>
                    </div>

                </div>


                <div class="control-group">
                    <label class="control-label" for="basicinput">Recipients</label>
                    <div class="controls">
                        {!! Form::textarea('recipients', Input::old('recipients'), ['rows'=>5,'class'=>'span8','id'=>'recipients']) !!}
                        <div>
                            <span class="help-inline">
                                <span id="no_of_recipients" class="label label-info">0/50</span>
                                <span class="label label-info">Contacts</span>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="basicinput">Message</label>
                    <div class="controls">
                        {!! Form::textarea('message', Input::old('message'), ['rows'=>5,'class'=>'span8','id'=>'message_box']) !!}
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls">
                        <label class="checkbox">
                            {!! Form::checkbox('flash', 1) !!} Send as Flash Message
                        </label>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" id="submit_" class="btn btn-primary">Send SMS</button>
                        <button type="button" id="draft" class="btn">Save as Draft</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

    </div>

@stop

