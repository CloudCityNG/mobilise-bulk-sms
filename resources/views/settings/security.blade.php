@extends('layouts.frontend.master')


@section('content')

<div class="uk-width-medium-1-1 Box">
    <div class="uk-grid">
        <div class="uk-width-medium-7-10">
            <h2>Change Password</h2>
            <p>Change your password</p>

            {!! Form::open(['url'=>'/settings/security', 'class'=>'uk-form uk-form-stacked uk-margin-bottom', 'id'=>'settings-security','autocomplete'=>'off','data-parsley-validate']) !!}

                <div class="uk-form-row">
                    {!! Form::label('password', 'Password', ['class'=>'uk-form-label']) !!}
                    <div class="uk-form-controls">
                        {!! Form::password('password', [
                            'placeholder'=>'Password',
                            'class' => 'uk-width-1-2',
                            'required',
                            'data-parsley-required-message' => 'Password is required',
                            'data-parsley-trigger'          => 'change focusout',
                            'data-parsley-minlength'        => '6',
                            'data-parsley-maxlength'        => '20'
                            ]) !!}
                    </div>
                </div>

                <div class="uk-form-row">
                    {!! Form::label('password_confirmation', 'Confirm Password', ['class'=>'uk-form-label']) !!}
                    <div class="uk-form-controls">
                        {!! Form::password('password_confirmation', [
                            'placeholder'=>'Password_confirmation',
                            'class' => 'uk-width-1-2',
                            'required',
                            'data-parsley-required-message' => 'Password confirmation is required',
                            'data-parsley-trigger'          => 'change focusout',
                            'data-parsley-equalto'          => '#password',
                            'data-parsley-equalto-message'  => 'Not same as Password',
                            ]) !!}
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
        <div class="uk-width-medium-3-10">
            <a class="uk-button uk-button-large uk-button-danger" href="#">Deactivate Account</a>
        </div>
    </div>
</div>

@stop


@section('head')
@parent
<link rel="stylesheet" href="/assets/parsley/parsley.css" />
@stop


@section('foot')
@parent
<script src="/assets/parsley/parsley.min.js"></script>
<script>

$(function() {

window.ParsleyConfig = {
    errorsWrapper: '<div></div>',
    errorTemplate: '<div class="uk-alert" role="alert"></div>'
};

});

</script>
@stop