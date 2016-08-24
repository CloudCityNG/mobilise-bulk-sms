@extends('layouts.bootswatch.master')

@section('foot')
    @include('layouts.global.flash')
    <script>
        $(function(){
            $('a.delete-icon').click(function(e){
                return confirm("Are you sure you want to delete this record ?");
            });
        });
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
            <h1>Sent SMS</h1>
            @if( $data )
                <table class="table table-striped table-hover table-condensed table-responsive">
                    <thead>
                    <tr>
                        <th class="col-lg-2">Sender</th>
                        <th class="col-lg-5">Message</th>
                        <th class="col-lg-3">Date Sent</th>
                        <th class="col-lg-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $data as $sent )
                        <tr>
                            <td>{{$sent->sender}}</td>
                            <td>{{echo_($sent->message, 60)}}</td>
                            <td>{{$sent->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{url("history/sent-sms/$sent->id")}}" data-toggle="tooltip"
                                   data-placement="left" title="Tooltip on left">
                                    <i class="icon icon ion-eye"></i>
                                </a>

                                <a href="#!" style="margin-left:10px"><i class="icon icon ion-forward"></i></a>

                                <a href="{{route('sent_sms_del', ['id'=>$sent->id])}}" style="margin-left:10px;" class="delete-icon"><i class="icon icon ion-trash-a"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $data->render() !!}
            @else

                <div class="alert alert-info" role="alert">
                    You do not have any Sent SMS yet.
                </div>
            @endif
        </div>
    </div>
@stop