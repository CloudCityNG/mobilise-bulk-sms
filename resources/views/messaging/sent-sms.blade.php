@extends('layouts.frontend.master')

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Sent SMS</h1>
    <p class="uk-lead">All sent SMS</p>


    @if( $data->count() )
    <div id="table-container">

        <table class="uk-table uk-table-hover uk-table-condensed">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Recipients</th>
                    <th>Sent</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $record)
                <tr>
                    <td class="uk-table-middle">{{$record->sender}}</td>
                    <td class="uk-table-middle">{{$record->message}}</td>
                    <td class="uk-table-middle">@foreach ($record->smshistoryrecipient as $recipients)
                        <span>{{$recipients->destination}}</span>
                        @endforeach
                    </td>
                    <td class="uk-table-middle">{{$record->created_at}}</td>
                    <td class="uk-table-middle">
                        <div class="uk-button-dropdown" data-uk-dropdown>
                            <button class="uk-button"><i class="uk-icon-wrench"></i></button>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li><a href="#" id="dlr" data-recipients-id="{{$record->id}}">Delivery Report</a></li>
                                    <li><a href="#" id="resend" data-resend-id="{{$record->id}}">Resend</a></li>
                                    <li><a href="#" id="delete" data-delete-id="{{$record->id}}">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! (new Landish\Pagination\UIKit($data))->render() !!}
    </div>
    @else
    <div class="uk-alert">No Sent Messages yet.</div>
    @endif
</div>
@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/js/global.js"></script>
<script>
 $('#table-container').on('click', 'a#delete', function(e){
    e.preventDefault();
    var $this = $(this);
    var id = $this.attr('data-delete-id');

    var jqXHR = $.get('/messaging/sent-sms/' + id + '/del');

    jqXHR.done( function(data){

        //$this.closest('tr').remove();
        $this.closest('tr').slideUp("slow", function(){
            $(this).remove();
        });
        alert_("Done");

    } );

    jqXHR.fail( function(data){

        if (data.status === 404)
        {
            alert_("Server error: Not found")
        }
        else if (data.status === 401)
        {
            $(location).prop('pathname', 'user/login');
        }
        else if (data.status === 422)
        {
            alert("Delete failed");
        }

        if (data.status === 500){
            alert_("Unknown error. Please try later");
        }

    } );
 });
</script>
@stop