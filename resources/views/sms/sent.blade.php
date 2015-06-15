@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Sent Sms</h3>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
    {!! $data->render() !!}
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th class="col-md-1 col-md-3">Sender ID</th>
                <th class="col-md-3 col-sm-3">Recipient</th>
                <th class="col-md-6 col-sm-3">Message</th>
                <th class="col-md-2 col-sm-3">Action</th>
            </tr>
            @foreach( $data as $d)
            <tr>
                <td>{{ $d->senderid }}</td>
                <td>{{ $d->recipients }}</td>
                <td>{{ $d->message }}</td>
                <td>
                    <a href="{!! action('SmsController@show', ['id'=>$d->id]) !!}" class="btn btn-primary btn-xs">View</a>
                    <a href="{!! action('SmsController@edit', ['id'=>$d->id]) !!}" class="btn btn-primary btn-xs">Resend</a>
                    <a href="{!! action('SmsController@destroy', ['id'=>$d->id]) !!}" class="btn btn-danger btn-xs">Delete</a>
                </td>
            </tr>
            @endforeach

        </table>


    </div>

</div>

@stop