@extends('emails.layouts.basic')

@section('info')

    <h3>User Account Credited</h3>
    <p>User: {{$username}}</p>
    <p>Units: {{$units}}</p>
    <p>Transaction Code: {{$transaction_code}}</p>

@endsection