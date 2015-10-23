<div id="edit-contact-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">Edit Profile</div>

        <div class="uk-overflow-container">
            {!! Form::open(['url'=>'', 'class'=>'uk-form uk-form-horizontal modal-edit-contact']) !!}
            <div class="errors" style="display:none;">
                <div class="uk-alert uk-alert-danger" data-uk-alert>
                    <ul id="error-ul"></ul>
                </div>
            </div>
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
                {!! Form::label('gsm', 'GSM*', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('gsm', Input::old('gsm'), ['placeholder'=>'GSM']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('birthdate', 'Birthdate', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('birthdate', Input::old('birthdate'), ['placeholder'=>'Birthdate','data-uk-datepicker'=>"{format:'DD-MM-YYYY',pos:'auto'}"]) !!}
                </div>
            </div>
        </div>

            {!! Form::close() !!}
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-button-small" id="editContactCancel">Cancel</button>
            <button type="button" class="uk-button uk-button-primary uk-button-small" id="editContactSave">Save</button>
        </div>
    </div>
</div>
