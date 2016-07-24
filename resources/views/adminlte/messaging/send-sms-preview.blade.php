@extends('layouts.adminlte.master')
@section('title')
    Send SMS
@stop

@section('head')
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <style type="text/css">
        #tab_1, #tab_2, #tab_3, #tab_4 {
            min-height: 150px;
        }

        .schedule {
            padding-left: 20px;
            background: #e1e3fa;
        }
    </style>
@stop

@section('foot')
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/bootstrap-timepicker.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/dropzone.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="/adminlte/js/jsapps.js"></script>

    @stop

    @section('content')

            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Send SMS
            <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Messaging</a></li>
            <li class="active">Send SMS</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" id="app">

        <div class="box">
            <div class="box-header with-border">
                <span class="inactive-step">1, Start</span> | <h3 class="box-title active-step">2, Preview SMS</h3>  | <span class="inactive-step">3, Preview SMS</span>
            </div>
            <div class="box-body">

                <div class="col-lg-8">
                    <table class="table">
                        <tr>
                            <th>Total Recipients</th>
                            <th>Invalid</th>
                            <th>Total Units</th>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>Network</td>
                            <td>Total Recipients</td>
                            <td>Unit per SMS</td>
                        </tr>
                        @foreach($data['out'] as $number)
                        <tr>
                            <td>{{$number['country']}}</td>
                            <td>{{$number['network']}}</td>
                            <td>{{$number['total_recipients']}}</td>
                            <td>{{$number['unit_per_sms']}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="row">
                        <button class="btn btn-default pull-left">Back</button>
                        <button class="btn btn-default pull-right">Send</button>
                    </div>
                    @include('layouts.adminlte.partials.errors')
                    {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'ui form', 'id'=>'quick-sms', 'autocomplete'=>'off', 'role'=>'form']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Bulk SMS Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th class="bold">Number of Messages</th>
                                <th class="bold">Total SMS</th>
                                <th class="bold">Total Units</th>
                            </tr>
                            <tr>
                                <td>@{{ numberOfMessages }}</td>
                                <td>@{{ totalSms }}</td>
                                <td>@{{ totalUnits }}</td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <th>Country</th>
                                <th>Carrier</th>
                                <th>Total Recipients</th>
                                <th>Unit per SMS</th>
                                <th>SMS Count</th>
                            </tr>
                            <tbody id="update">
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal-send">Send SMS</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section>






@endsection