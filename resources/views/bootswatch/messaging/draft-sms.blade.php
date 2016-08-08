@inject('dlrHandler', 'App\Lib\Sms\DlrHandler')
@extends('layouts.bootswatch.master')

@section('foot')
    @include('layouts.global.flash')
    <script>
        $(function(){
            $('a#delete').click(function(event) {
                if ( confirm("Are you sure you want to delete this record?") ){
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Draft SMS</h1>
            @if ( is_null($data) )

                <div class="ui warning message">

                    You supplied an invalid information. Please try again.
                </div>
            @else

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>Sender ID</h5>
                        {{$data->sender?:'Empty'}}
                        <hr>

                        <h5>Message</h5>
                        {{$data->message?:'Empty'}}
                        <hr>

                        @if( !empty($data->schedule) )
                        <h5>Scheduled Date</h5>
                        {{$data->schedule->toDayDateTimeString()}}
                        @else
                        <h5>Date Sent</h5>
                        {{$data->created_at->toDayDateTimeString()}}
                        @endif
                        <hr>

                        <h5>Recipients</h5>
                        {{$data->recipients?:'Empty'}}

                        <hr>
                        <a href="#" class="btn btn-primary btn-sm" id="forward"><i class="icon icon ion-paper-airplane"></i> Forward</a>
                        <a href="{{route('del_draft_sms', ['id'=>$data->id])}}" class="btn btn-danger btn-sm" id="delete"><i class="icon icon ion-eye"></i> Delete</a>

                    </div>
                </div>

            @endif

        </div>
    </div>
@stop