@extends('layouts._master')

@section('content')

<div class="module message">
    <div class="module-head">
        <h3>Sent SMS</h3>
    </div>
    <div class="module-option clearfix">
        <div class="pull-left">
            <div class="btn-group">
                <button class="btn">All</button>
                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">All</a></li>
                    <li><a href="#">In progress</a></li>
                    <li><a href="#">Done</a></li>
                    <li class="divider"></li>
                    <li><a href="#">New Task</a></li>
                    <li><a href="#">Overdue Task</a></li>
                </ul>
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="#">Create Task</a>
        </div>
    </div>

    <div class="module-body table">
        <table class="table table-message">
            <tbody>
                <tr class="heading">
                    <td class="cell-icon"></td>
                    <td class="cell-title">Message</td>
                    <td class="cell-status hidden-phone hidden-tablet">Status</td>
                    <td class="cell-time align-right">Sent Date</td>
                </tr>
                @foreach($data as $row)
                <tr class="task">
                    <td class="cell-icon"> <a href="#"> <i class="icon-checker high"></i> </a> </td>
                    <td class="cell-title"> <a href="{{url('messaging/sent-sms', ['id'=>$row->id])}}"><div>{{$row->message}}</div></a> </td>
                    <td class="cell-status"> <a href="#"><b class="done">Sent</b></a> </td>
                    <td class="cell-time align-right"> <a href="#">{{$row->created_at->diffForHumans()}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="module-foot"></div>
</div>

            {{--$row->smshistoryrecipient->implode('destination', ', ') --}}
                {{--@foreach($row->smshistoryrecipient->implode(',') as $row2)--}}
                        {{--{{$row2->destination}}--}}
                {{--@endforeach--}}


@stop
