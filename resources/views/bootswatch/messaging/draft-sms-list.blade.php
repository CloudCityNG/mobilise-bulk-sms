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
        <div class="col-lg-9 col-lg-offset-1">
            <h1>Draft SMS</h1>
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
                    @foreach ( $data as $draft )
                        <tr>
                            <td>{{$draft->sender}}</td>
                            <td>{{echo_($draft->message, 60)}}</td>
                            <td>{{$draft->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{url("history/draft-sms/$draft->id")}}" data-toggle="tooltip"
                                   data-placement="left" title="Tooltip on left">
                                    <i class="icon icon ion-eye"></i>
                                </a>

                                <a href="#!" style="margin-left:10px"><i class="icon icon ion-forward"></i></a>

                                <a href="{{route('del_draft_sms', ['id'=>$draft->id])}}" id="delete" style="margin-left:10px;"><i class="icon icon ion-trash-a"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $data->render() !!}
            @else

                <div class="alert alert-info" role="alert">
                    You do not have any Draft SMS yet.
                </div>
            @endif
        </div>
    </div>
@stop