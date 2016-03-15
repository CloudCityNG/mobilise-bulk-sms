@extends('layouts.kanda.frontend')


@section('content')
<div class="boxx">
    <h2 class="ui header blue">
        <i class="send icon blue"></i>
        <div class="content">
            Sent SMS
        </div>
    </h2>

    @if( $data )

    {!! $data->render() !!}

    <table class="ui single line table">
      <thead>
        <tr>
          <th>Sender</th>
          <th>Message</th>
          <th>Sent</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $data as $sent )
        <tr>
          <td>{{$sent->sender}}</td>
          <td>{{echo_($sent->message, 60)}}</td>
          <td>{{$sent->created_at->diffForHumans()}}</td>
          <td>
                <a href="{{url("messaging/sent-sms/$sent->id")}}" class="ui icon info" data-content="View Message"> <i class="small unhide icon" ></i> </a>
                <a href="#" class="ui icon info" data-content="Forward Message"> <i class="small forward mail icon"></i> </a>
                <a href="#" class="ui icon info" data-content="Delete Message" id="delete_button"> <i class="small remove icon red"></i> </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    @else
     <div class="ui warning message">
       You do not have any Sent SMS yet.
     </div>
    @endif


</div>
@endsection

@section('foot')
@parent
<script>
$(function(){
    $('.ui.icon.info').popup();
    $('a#delete_button').click(function(e){
        alert('u clicked me');
        e.preventDefault();
    });
});

</script>
@endsection