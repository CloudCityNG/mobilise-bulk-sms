<div id="edit-contact-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">Edit Contact</div>
            {!! Form::open(['url'=>'', 'class'=>'uk-form uk-form-horizontal modal-edit-contact']) !!}
            <div class="uk-form-row">
                {!! Form::label('firstname', 'Firstname', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('firstname', Input::old('firstname'), ['placeholder'=>'Firstname']) !!}
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
                {!! Form::label('gsm', 'Gsm', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('gsm', Input::old('gsm'), ['placeholder'=>'Gsm']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('birthdate', 'Birthdate', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('birthdate', Input::old('birthdate'), ['placeholder'=>'Birthdate','data-uk-datepicker'=>"{format:'DD-MM-YYYY',pos:'auto'}"]) !!}
                </div>
            </div>

            {!! Form::close() !!}
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-button-small" id="editContactCancel">Cancel</button>
            <button type="button" class="uk-button uk-button-primary uk-button-small" id="editContactSave">Save</button>
        </div>
    </div>
</div>
