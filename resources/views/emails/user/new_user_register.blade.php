@extends('emails.layouts.master')

@section('content')
<h1>Hi, {{$username}}</h1>
    <p class="lead">Welcome to {{env('APP_NAME','Quic Bulk SMS')}} and thanks for signing up.</p>
    <p>
        You can start sending bulk SMS straight from your online account and also buy additional units
        online with your Debit Card.
    </p>
@stop

@section('info')
<p>Don't forget to confirm your email address so that you can receive monthly reports <a href="#">Confirm Now! »</a></p>
@stop