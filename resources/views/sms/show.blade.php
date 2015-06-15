@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-7">
        <h3 class="page-header">Sent Message</h3>
        <table class="table table-striped table-bordered">
            <tr>
                <td class="col-md-3">Sender ID</td>
                <td class="col-md-9">{{ $data->senderid }}</td>
            </tr>
            <tr>
                <td class="bold">Recipients</td>
                <td>{{ $data->recipients }}</td>
            </tr>
            <tr>
                <td class="bold">Message</td>
                <td>{{ $data->message }}</td>
            </tr>
            <tr>
                <td class="bold">Response</td>
                <td>{{ $data->response }}</td>
            </tr>
            <tr>
                <td class="bold">Units</td>
                <td>{{ $data->units }}</td>
            </tr>
            <tr>
                <td class="bold">Delivered?</td>
                <td>{{ ($data->delivered) ? 'yes' : 'no' }}</td>
            </tr>
            <tr>
                <td class="bold">Sent</td>
                <td>{{ $data->created_at->diffForHumans() }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="{!! action('SmsController@edit', ['id'=>$data->id]) !!}" class="btn btn-primary btn-xs">Resend</a>
                    <a href="{!! action('SmsController@destroy', ['id'=>$data->id]) !!}" class="btn btn-danger btn-xs">Delete</a>
                </td>
            </tr>

        </table>

    </div>
</div>


@stop
@section('head')
@parent
<style type="text/css">
.bold {
    font-weight: bold;
}
</style>
@stop