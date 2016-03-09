@extends('emails.layouts.master')

@section('content')
<h1>Hi, {{$username}}</h1>
    <p class="lead">Your password was just changed.</p>
    <p>
        Your profile was edited and password changed at {{$date_and_time}}.
    </p>
@stop

@section('info')
<p>If you think your account has been compromised please contact <strong>support@quicsms.com</strong></p>
@stop