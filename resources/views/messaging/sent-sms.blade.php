@extends('layouts.frontend.master')

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Sent SMS</h1>
    <p class="uk-lead">All sent SMS</p>


    @if( $data->count() )
    <div class="table-container">

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
                                    <li><a href="" data-recipients-id="{{$record->id}}">Delivery Report</a></li>
                                    <li><a href="" data-resend-id="{{$record->id}}">Resend</a></li>
                                    <li><a href="" data-delete-id="{{$record->id}}">Delete</a></li>
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