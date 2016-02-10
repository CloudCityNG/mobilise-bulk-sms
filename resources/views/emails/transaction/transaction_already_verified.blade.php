@extends('emails.layouts.basic')

@section('content')

    <h3>Transaction Already Verified</h3>
    <p>A transaction that has already been verified was just re-processed.</p>
    <p>User: {{$username}}</p>

    <p>Transaction Code: {{$transaction_code}}</p>

@endsection