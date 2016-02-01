@extends('layouts.kanda.admin')


@section('content')

<div class="boxx">
    <form action="{{url('admin/search')}}" method="post">
    {!! csrf_field() !!}
        <div class="ui fluid action input">
          <input name="search" type="text" placeholder="Search...">
          <button class="ui button">Search</button>
        </div>
    </form>

    @if ( !empty($users) )
    <table class="ui striped celled table">
        <thead>
            <tr>
                <th>id</th>
                <th>email</th>
                <th>credit Balance</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                <div class="content"><a class="ui" href="{{url('admin/user/'.$user->id)}}">Open</a></div>
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->smscredit->available_credit}}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
    @endif

</div>

@endsection