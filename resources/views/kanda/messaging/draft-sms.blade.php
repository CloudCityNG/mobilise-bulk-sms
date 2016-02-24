@extends('layouts.kanda.frontend')


@section('content')
@include('kanda.modals.modal')
<div class="boxx">
    <h2 class="ui header blue">
        <i class="send icon blue"></i>
        <div class="content">
            Draft SMS
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
                    <a href="#" class="ui icon info" data-content="View"> <i class="small unhide icon" ></i> </a>
                    <a href="#" class="ui icon info" data-content="Edit and Send"> <i class="small send outline icon"></i> </a>
                    <a href="#" class="ui icon info" data-content="Delete" id="delete_button"> <i class="small trash icon red"></i> </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

    @else
    <div class="ui warning message">
       <i class="close icon"></i>
       You do not have any Draft SMS yet.
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
        $('.ui.modal').modal();
        e.preventDefault();
    });
});

</script>
@endsection