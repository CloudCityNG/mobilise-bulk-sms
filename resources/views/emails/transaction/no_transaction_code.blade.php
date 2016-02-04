@extends('email.layouts.basic')

@section('content')

    <h3>No Transaction code was detected</h3>
    <p>User: {{$username}}</p>

    <p>Transaction Code: {{$transaction_code}}</p>

@endsection