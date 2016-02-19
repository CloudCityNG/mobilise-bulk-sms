@extends('layouts.kanda.frontend')


@section('content')
<div class="boxx">
    <h2 class="ui header blue">
        <i class="send icon blue"></i>
        <div class="content">
            Sent SMS
        </div>
    </h2>

    <div class="ui very relaxed middle aligned divided list">
        <div class="item">
            <div class="content">
                <a class="header">Sender</a>
                <div class="description">Here again</div>
            </div>
        </div>
        <div class="item">
            <div class="content">
                <a class="header">Message</a>
                <div class="description">{{$data->message}}</div>
            </div>
        </div>
        <div class="item">
            <div class="content">
                <a class="header">Date Sent</a>
                <div class="description">{{$data->created_at->toDayDateTimeString()}}</div>
            </div>
        </div>
        <div class="item">
            <div class="content">
                <a class="header">Recipients</a>
                <div class="description">
                    @foreach($data->smshistoryrecipient as $recipient)
                        {{$recipient->destination}} | {{$recipient->status}}<br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection