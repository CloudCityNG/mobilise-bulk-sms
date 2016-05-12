@extends('layouts.kanda.frontend')


@section('content')

    <div class="boxx">

        <h2 class="ui header blue">
            <i class="send icon blue"></i>
            <div class="content">
                Send SMS Confirmation
            </div>
        </h2>

        <div class="ui large message">
            <h4 class="ui header">Sender: </h4>
            {{$data['sender']}}
        </div>

        <div class="ui large message">
            <h4 class="ui header">Recipients: </h4>
            {{$data['recipients']}}
        </div>

        <div class="ui large message">
            <h4 class="ui header">Message: </h4>
            {{$data['message']}}
        </div>

        <div class="ui large message">
            <h4 class="ui header">Schedule: </h4>
            {{$data['schedule']}}
        </div>

        <div class="ui large message">
            <h4 class="ui header">Flash: </h4>
            {{ ($data['flash']) ? 'Send as flash' : 'Send as normal message' }}
        </div>

        <a href="#!" class="ui primary button">Send Now</a>
        <a href="#!" class="ui red button">Cancel Send</a>

    </div>

@endsection