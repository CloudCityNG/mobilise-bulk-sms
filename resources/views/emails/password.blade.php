@extends('emails.layouts.master')


@section('content')
<h2>Password Reset</h2>
<br/>
<p>You requested for a password reset.</p>
<p>Click here to reset your password: {{ url('password/reset/'.$token) }}</p>
@stop


@section('info')
<p>If you think this is an error and you did not initiate a password reset, <a href="#">please report the issue here</a></p>
@stop