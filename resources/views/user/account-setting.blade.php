@extends('layouts.frontend.master')


@section('content')

<div class="uk-panel uk-panel-box">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h3 class="uk-panel-title">Account Setting</h3>

    <form class="uk-form uk-form-horizontal" action="">
        <fieldset class="uk-margin-large-top">
            <legend>User Detail</legend>
            <div class="uk-form-row">
                {!! Form::label('username', 'Username', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('username', Input::old('username'), ['placeholder'=>'Username']) !!}
                </div>
            </div>
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


        </fieldset>

        <fieldset class="uk-margin-large-top">
            <legend>Contact Detail</legend>

        </fieldset>

        <fieldset class="uk-margin-large-top">
            <legend>Address Detail</legend>

        </fieldset>

    </form>

</div>

@stop