@extends('email.layouts.basic')

@section('content')

    <h3>Transaction Already Verified</h3>
    <p>User: {{$username}}</p>

    <p>Transaction Code: {{$transaction_code}}</p>

@endsection