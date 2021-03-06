@extends('layouts.kanda.frontend')


@section('content')
    <div class="boxx">
        <h2 class="ui header blue">
            <i class="send icon blue"></i>

            <div class="content">
                Sent SMS
            </div>
        </h2>

        @if ( is_null($data) )

            <div class="ui warning message">

                You supplied an invalid information. Please try again.
            </div>

        @else

            <div class="ui very relaxed middle aligned divided list">
                <div class="item">
                    <div class="content">
                        <a class="header">Sender</a>

                        <div class="description">{{$data->sender}}</div>
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
                            <p>
                                <?php $smshistoryrecipient_count = $data->smshistoryrecipient()->count()  ?>
                                @if ($smshistoryrecipient_count < 0)
                                    @foreach($data->smshistoryrecipient as $recipient)
                                        {{$recipient->destination}} |
                                        @if ( $recipient->status == '0' )
                                            SENT
                                        @else
                                            {{$recipient->status}}
                                        @endif
                                        <br/>
                                    @endforeach
                                @else
                                    <span>{{$smshistoryrecipient_count}} Recipient(s)</span><br/>
                                    <a class="ui button primary" href="{{url("messaging/sent-sms/$data->id/get-dlr")}}">Download
                                        Delivery report</a>
                                    <a class="ui button primary" id="view_dlr"
                                       href="{{url("messaging/sent-sms/$data->id/get-dlr/view")}}">View Delivery
                                        report</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="content">
                        <div class="ui buttons">
                            <a href="{{url("messaging/sent-sms/$data->id/forward")}}"
                               class="ui green button">Forward</a>

                            <div class="or"></div>
                            <a href="{{url("messaging/sent-sms/$data->id/delete")}}" class="ui red button"
                               id="delete_button">Delete</a>
                        </div>

                    </div>
                </div>
            </div>

        @endif

    </div>
@endsection

@section('foot')
    @parent
    <script>
        $(function () {
            $('a#delete_button').click(function (e) {
                if (!confirm("Are you sure you want to delete?")) {
                    e.preventDefault();
                }
            });
            $('a#view_dlr').click(function (event) {
                event.preventDefault();
                window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
            });
        });
    </script>
@endsection