@extends('layouts._master')

@section('content')

<div class="module">

    <div class="module-head"><h3>Sent SMS</h3></div>

        <div class="module-body">
            @include('flash::message')

            <table class="table table-striped table-bordered">
                <tr>
                    <th>Recipients</th>
                    <th>Other info</th>
                </tr>
                <tr>
                    <td rowspan="5" class="span6">{{$data[0]->smshistoryrecipient->implode('destination', ', ')}}</td>
                    <td class="span6">Sender: {{$data[0]->sender}}</td>
                </tr>
                <tr>
                    <td>Message: {{$data[0]->message}}</td>
                </tr>
                <tr>
                    <td>Schedule: {{$data[0]->schedule}}</td>
                </tr>
                <tr>
                    <td>Flash SMS: {{ !empty($data[0]->flash) ? 'Yes' : 'No'}}</td>
                </tr>

            </table>
        </div>
    </div>
</div>
@stop