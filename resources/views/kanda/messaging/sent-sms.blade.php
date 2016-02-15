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
    @foreach($data->chunk(3) as $chunk)
        <div class="ui three cards">
            @foreach($chunk as $sent)
            <div class="card">
                <div class="content">
                    <div class="header">{{$sent->sender}}</div>
                    <div class="meta">
                        <span class="right floated time">{{$sent->created_at->diffForHumans()}}</span>
                        <span class="category">Sent</span>
                    </div>
                    <div class="description">{{echo_($sent->message)}}</div>
                </div>
                <div class="extra content">
                    <i class="check icon"></i>
                    <?php $recipients = $sent->smshistoryrecipient->count() ?>
                    {{$recipients}} {{ $recipients == 1 ? 'Recipient' : 'Recipients'  }}
                </div>
                <div class="ui bottom attached button teal">
                      <i class="add icon"></i>
                      View
                </div>

            </div>
            @endforeach
        </div>
    @endforeach

    @else
     <div class="ui warning message">
       <i class="close icon"></i>
       You do not have any Sent SMS yet.
     </div>
    @endif


</div>
@endsection