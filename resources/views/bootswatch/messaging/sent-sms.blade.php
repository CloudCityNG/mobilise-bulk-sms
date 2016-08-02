@inject('dlrHandler', 'App\Lib\Sms\DlrHandler')
@extends('layouts.bootswatch.master')

@section('foot')
    <script>
        $(function(){
            $('a#view_dlr').click(function(event) {
                event.preventDefault();
                window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
            });
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Sent SMS</h1>

            @if ( is_null($data) )

                <div class="ui warning message">

                    You supplied an invalid information. Please try again.
                </div>
            @else

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>Sender ID</h5>
                        {{$data->sender}}
                        <hr>

                        <h5>Message</h5>
                        {{$data->message}}
                        <hr>

                        <h5>Date Sent</h5>
                        {{$data->created_at->toDayDateTimeString()}}
                        <hr>

                        <h5>Recipients</h5>
                        <?php $smsHistoryRecipientCount = $data->smshistoryrecipient()->count()  ?>

                        @if ( $smsHistoryRecipientCount == 1 )
                            {{-- Could be error or one recipient --}}
                            @foreach($data->smshistoryrecipient as $recipient)
                                @if ( $recipient->status != 0  )
                                    <span>An error occured. Error code {{$recipient->status}}</span>
                                @else
                                    <span>{{$smsHistoryRecipientCount}} Recipient</span><br>
                                    <span>{{$recipient->destination}}</span> | <span>{{$dlrHandler->translate_status($recipient->status)}}</span><br>
                                @endif
                            @endforeach
                        @elseif( $smsHistoryRecipientCount >= 10 )
                            @foreach($data->smshistoryrecipient as $recipient)
                                <span>{{$recipient->destination}}</span> | <span>{{$dlrHandler->translate_status($recipient->status)}}</span>
                            @endforeach
                        @else
                            <span>{{$smsHistoryRecipientCount}} Recipient</span>
                        @endif

                        <hr>
                        <a href="{{url("history/sent-sms/$data->id/get-dlr")}}" class="btn btn-info btn-sm">
                            <i class="icon icon ion-ios-cloud-download"></i> Download Delivery Report
                        </a>
                        <a href="{{url("history/sent-sms/$data->id/get-dlr/view")}}" class="btn btn-primary btn-sm" id="view_dlr">
                            <i class="icon icon ion-eye"></i> View Delivery Report
                        </a>

                        <hr>
                        <a href="#!" class="btn btn-primary btn-sm"><i class="icon icon ion-paper-airplane"></i> Forward</a>
                        <a href="#!" class="btn btn-danger btn-sm"><i class="icon icon ion-eye"></i> Delete</a>

                    </div>
                </div>

            @endif

        </div>
    </div>
@stop