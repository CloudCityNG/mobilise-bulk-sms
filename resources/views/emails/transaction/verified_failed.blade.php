@extends('emails.layouts.basic')

@section('info')

    <h3>Verification failed for the user below</h3>
    <p>User: {{$username}}</p>
    <p>Transaction Code: {{$transaction_code}}</p>

@endsection