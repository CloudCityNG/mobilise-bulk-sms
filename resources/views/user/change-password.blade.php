@extends('layouts.frontend.master')


@section('content')

<div class="uk-panel uk-panel-box change-password">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h3 class="uk-panel-title">Change Password</h3>
    @include('layouts.frontend.partials.errors')
    {!! Form::open(['url'=>'user/change-password', 'class'=>'uk-form uk-form-horizontal']) !!}
        <fieldset class="uk-margin-top">
            <legend>&nbsp;</legend>
            <div class="uk-form-row">
                {!! Form::label('password', 'Current Password', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::password('password', ['placeholder'=>'Current Password']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('new_password', 'New Password', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::password('new_password', ['placeholder'=>'New Password']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('new_password_confirmation', 'New Password Confirmation', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::password('new_password_confirmation', ['placeholder'=>'New Password Confirmation']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    {!! Form::button('Save', ['type'=>'submit','class'=>'uk-button uk-button-primary']) !!}
                </div>
            </div>
        </fieldset>
    {!! Form::close() !!}

</div>

@stop