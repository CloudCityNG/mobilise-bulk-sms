@extends('layouts.frontend.master')

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h1 class="uk-panel-title uk-title">Draft SMS</h1>
    <p class="uk-lead">All Draft SMS</p>



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
                                    <li><a href="" data-send-id="{{$record->id}}" id="send">Send</a></li>
                                    <li><a href="" data-delete-id="{{$record->id}}" id="delete">Delete</a></li>
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
    $this.closest('tr').remove();
    //alert_("I was clicked");
 });
</script>
@stop