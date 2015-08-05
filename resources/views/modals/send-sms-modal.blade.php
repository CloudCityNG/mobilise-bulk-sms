<div id="send-sms-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">Send SMS</div>
            {!! Form::open(['url'=>'', 'class'=>'uk-form uk-form-horizontal modal-send-sms']) !!}
            <div class="errors" style="display:none;">
                <div class="uk-alert uk-alert-danger" data-uk-alert>
                    <ul id="error-ul"></ul>
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('recipients', 'Mobile No.', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('recipients', Input::old('recipient'), ['placeholder'=>'Mobile No.']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('sender', 'Sender ID', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('sender', Input::old('sender'), ['placeholder'=>'Sender ID']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('schedule_date', 'Schedule', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    <?php $now = date('d-m-Y', time()); ?>
                    {!! Form::text('schedule_date', Input::old('schedule_date'), ['placeholder'=>'Date','data-uk-datepicker'=>"{format:'DD-MM-YYYY',pos:'auto',minDate:'$now'}"]) !!}
                    {!! Form::text('schedule_time', Input::old('schedule_time'), ['placeholder'=>'Time','data-uk-timepicker'=>"{format:'12h'}", 'id'=>'schedule_time']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('message', 'Message', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::textarea('message', Input::old('message'), ['placeholder'=>'Message']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-button-small" id="sendSmsModalCancel">Cancel</button>
            <button type="button" class="uk-button uk-button-primary uk-button-small" id="sendSmsModalButton">Send</button>
        </div>
    </div>
</div>
