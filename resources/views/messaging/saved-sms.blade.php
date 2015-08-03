@extends('layouts.frontend.master')

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h1 class="uk-panel-title uk-title">Draft SMS</h1>
    <p class="uk-lead">All Draft SMS</p>


    @if( $data->count() )
    <div id="table-container">

        <table class="uk-table uk-table-hover uk-table-condensed">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Recipients</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $record)
                <tr>
                    <td class="uk-table-middle uk-width-1-10">{{$record->sender}}</td>
                    <td class="uk-table-middle">{{$record->message}}</td>
                    <td class="uk-table-middle uk-width-1-10">
                        @foreach ( explode(',', $record->recipients) as $recipient )
                        <span>{{$recipient}}</span>
                        @endforeach
                    </td>
                    <td class="uk-table-middle uk-width-2-10">{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$record->created_at)->toDayDateTimeString() }}</td>
                    <td class="uk-table-middle uk-width-1-10">
                        <div class="uk-button-dropdown" data-uk-dropdown>
                            <button class="uk-button"><i class="uk-icon-wrench"></i></button>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li><a href="#" data-send-id="{{$record->id}}" id="send">Send</a></li>
                                    <li><a href="#" data-delete-id="{{$record->id}}" id="delete">Delete</a></li>
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
    <div class="uk-alert">No Draft Messages yet.</div>
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

    var jqXHR = $.get('/messaging/draft-sms/' + id + '/del');

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




    //alert_($this.prop("data-delete-id"));
 });
</script>
@stop