<?php
use Illuminate\Support\Facades\Auth;
?>
<div id="edit-profile-modal" class="uk-modal" data-id="5">
    <div class="uk-modal-dialog" style="width: 400px;">
        <div class="uk-modal-header">Edit Your Profile</div>

        {!! Form::open(['url'=>'/settings/profile', 'class'=>'uk-form uk-form-stacked modal-edit-profile', 'autocomplete'=>'off','data-parsley-validate']) !!}
        <div>

            <div class="errors" style="display:none;">
                <div class="uk-alert uk-alert-danger" data-uk-alert>
                    <ul id="error-ul"></ul>
                </div>
            </div>
            @if(Auth::user()->userdetails()->exists())
            <div class="uk-form-row uk-margin">
                {!! Form::label('firstname', 'Firstname', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('firstname', print_value(Auth::user()->userdetails->firstname), [
                        'placeholder'=>'Firstname',
                        'class'=>'uk-width-1-1',
                        'required',
                        'data-parsley-required-message' => 'Your Firstname is required',
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-pattern' => '/^[a-zA-Z]*$/',
                        ]) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('lastname', 'Lastname', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('lastname', print_value(Auth::user()->userdetails->lastname), ['placeholder'=>'Lastname','class'=>'uk-width-1-1']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('phone', 'Phone', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('phone', print_value(Auth::user()->userdetails->phone), [
                        'placeholder'=>'Phone Number',
                        'class'=>'uk-width-1-1',
                        'required',
                        'data-parsley-required-message' => 'Your Mobile Phone Number is required (Nigerian Only)',
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-pattern' => '/^(0)(7|8|9){1}([0-9]{9})/',
                        ]) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('address', 'Address', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('address', print_value(Auth::user()->userdetails->address), ['placeholder'=>'Your Address', 'class'=>'uk-width-1-1 input-padding']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('dob', 'Date of Birth', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                <?php
                $value = print_value(Auth::user()->userdetails->dob);
                $value = empty($value) ? NULL : Auth::user()->userdetails->dob;
                ?>
                    {!! Form::text('dob', $value, ['placeholder'=>'Birthdate','class'=>'uk-width-1-1']) !!}
                </div>
            </div>

            @else

            <div class="uk-form-row uk-margin">
                {!! Form::label('firstname', 'Firstname', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('firstname', null, ['placeholder'=>'Your Firstname', 'class'=>'uk-width-1-1 input-padding']) !!}
                </div>
            </div>
            <div class="uk-form-row uk-margin">
                {!! Form::label('lastname', 'Lastname', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('lastname', null, ['placeholder'=>'Your Lastname', 'class'=>'uk-width-1-1 input-padding']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('phone', 'Phone', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('phone', null, ['placeholder'=>'Your Phone Number', 'class'=>'uk-width-1-1 input-padding']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('address', 'Address', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('address', null, ['placeholder'=>'Your Address', 'class'=>'uk-width-1-1 input-padding']) !!}
                </div>
            </div>
            <div class="uk-form-row uk-margin">
                {!! Form::label('dob', 'Date of Birth', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('dob', NULL, ['placeholder'=>'Your Birthdate', 'class'=>'uk-width-1-1 input-padding']) !!}
                </div>
            </div>
            @endif
        </div>


        <div class="uk-modal-footer uk-text-right">
            <button type="submit" class="uk-button uk-button-success uk-button-large uk-width-1-1" id="editProfileSave">Update Profile</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
