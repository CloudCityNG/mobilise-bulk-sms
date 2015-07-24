<div id="new-contact-modal" class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">New Contact</div>
            {!! Form::open(['url'=>'', 'class'=>'uk-form uk-form-horizontal newContactForm']) !!}
            <div class="errors" style="display:none;">
                <div class="uk-alert uk-alert-danger" data-uk-alert>
                    <ul id="error-ul"></ul>
                </div>
            </div>

            <div class="uk-form-row">
                {!! Form::label('firstname', 'Firstname*', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('firstname', Input::old('firstname'), ['placeholder'=>'Firstname']) !!}*
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('lastname', 'Lastname', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('lastname', Input::old('lastname'), ['placeholder'=>'Lastname']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('email', 'Email', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('email', Input::old('email'), ['placeholder'=>'Email']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('gsm', 'Gsm*', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('gsm', Input::old('gsm'), ['placeholder'=>'Gsm']) !!}*
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('birthdate', 'Birthdate', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('birthdate', Input::old('birthdate'), ['placeholder'=>'Birthdate','data-uk-datepicker'=>"{format:'YYYY/MM/DD',pos:'auto'}"]) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('custom', 'Custom', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::textarea('custom', Input::old('custom'), ['placeholder'=>'Custom','rows'=>4,'cols'=>20]) !!}
                </div>
            </div>

            {!! Form::close() !!}
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-button-small" id="newContactCancel">Cancel</button>
            <button type="button" class="uk-button uk-button-primary uk-button-small" id="newContactSave">Save</button>
        </div>
    </div>
</div>
