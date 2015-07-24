@extends('layouts._master')

@section('head')
@parent
<style>
table th {
  background: #29b7d3!important;
  color: white;
}
</style>
@stop

@section('content')

    <div class="module">

            <div class="module-head"><h3>Saved SMS</h3></div>

            <div class="module-body">
                @include('flash::message')

                <table class="table table-condensed table-responsive">
                    <tr>
                        <th class="span2">Sender</th>
                        <th class="span2">Recipients</th>
                        <th class="span3">Message</th>
                        <th class="span2">Schedule</th>
                        <th class="span2">actions</th>
                    </tr>
                    @foreach ($data as $row)
                    <tr>
                        <td>{!! $row->sender !!}</td>
                        <td>{!! $row->recipients !!}</td>
                        <td>{!! $row->message !!}</td>
                        <td>{!! $row->schedule !!}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn">Action</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a href="#">Send</a></li>
                                  <li><a href="#">Edit</a></li>
                                  <li class="divider"></li>
                                  <li><a href="#">Delete</a></li>
                                </ul>
                              </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
    </div>

@stop