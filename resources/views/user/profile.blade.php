@extends('layouts.frontend.master')

<?php

?>
@section('content')


<div class="uk-container uk-grid uk-margin">
    <div class="uk-width-medium-1-10">
        {!! get_gravatar($currentUser->email) !!}
    </div>

    <div class="uk-width-medium-7-10">
        <h3 style="font-weight: 600">{{$currentUser->username}}</h3>
        <ul class="uk-list">
        <li>Member Since {{$currentUser->created_at->format('d/m/Y')}}</li>
        <li>Registered Via {{ empty($currentUser->social_auth_type) ? 'Web' : $currentUser->social_auth_type}}</li>
        </ul>
    </div>

    <div class="uk-width-medium-2-10">
        <a class="uk-button uk-button-large">Edit Profile</a>

    </div>
</div>


<div class="uk-width-medium-1-1 Box">
    content here
</div>


@stop