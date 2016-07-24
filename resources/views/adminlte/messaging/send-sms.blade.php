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
                <h3 class="box-title active-step">1, Start</h3> | <span class="inactive-step">2, Preview SMS</span> | <span class="inactive-step">3, Preview SMS</span>
            </div>
            <div class="box-body">

                <div class="col-lg-8">
                    @include('layouts.adminlte.partials.errors')
                    {!! Form::open(['url'=>'messaging/quick-sms', 'class'=>'ui form', 'id'=>'quick-sms', 'autocomplete'=>'off', 'role'=>'form']) !!}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="sender">Sender ID</label>
                            <!-- SENDER -->
                            <input name="sender" type="text" class="form-control" id="sender"
                                   v-model="sender" placeholder="Sender ID" maxlength="11"
                                   value="{!! old('sender') !!}">
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Recipients</label>

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Manual
                                            Input</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">File
                                            Upload</a></li>
                                    <li class=""><a href="#tab_3" data-toggle="tab"
                                                    aria-expanded="false">Contacts</a></li>
                                    <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Groups</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <!-- RECIPIENTS -->
                                            <textarea name="recipients" id="recipients" class="form-control" rows="5"
                                                      v-model="recipients" v-on:keyup="countRecipients"
                                                      placeholder="Enter Recipients...">{!! old('recipients') !!}</textarea>
                                        <p class="help-block">@{{ recipientsCounter }}</p>
                                    </div>

                                    <div class="tab-pane" id="tab_2">
                                        <div id="contactsUpload" class="dropzone"></div>
                                    </div>

                                    <div class="tab-pane" id="tab_3">
                                        Contacts
                                    </div>
                                    <div class="tab-pane" id="tab_4">
                                        groups
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="message">Text Message</label>

                            <div class="row">
                                <div class="col-lg-7">
                                    <!-- MESSAGE -->
                                        <textarea name="message" id="message" class="form-control col-lg-7" rows="4"
                                                  v-model="message" v-on:keyup="countMessageCharacters"
                                                  placeholder="Enter Message...">{!! old('message') !!}</textarea>
                                </div>
                                <div class="col-lg-5">
                                        <span style="font-weight:bold;">
                                            @{{{ messagePreview }}}
                                        </span>
                                </div>

                            </div>
                            <p class="help-block">@{{ messageCounter }} | 160 Characters = 1page.</p>
                        </div>

                        <div class="checkbox">
                            <label>
                                <!-- SCHEDULE -->
                                <input type="checkbox" name="schedule" id="schedule" value="1" v-model="schedule">
                                <b>Schedule Message</b>
                            </label>
                        </div>
                        <div class="form-group schedule" v-show="schedule">
                            <label for="date">Date</label>

                            <div class="input-group date col-md-4 col-xs-6">
                                <!-- DATE -->
                                <input name="date" id="date" type="text" v-show="schedule"
                                       class="form-control datepicker" value="{!! old('date') !!}"
                                       id="date">

                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div class="input-group col-md-4 col-xs-6">
                                <div class="bootstrap-timepicker">
                                    <div class="bootstrap-timepicker-widget dropdown-menu">
                                    </div>
                                    <div class="form-group">
                                        <label>Time picker:</label>

                                        <div class="input-group">
                                            <!-- TIME -->
                                            <input name="time" id="time" v-show="schedule" type="text"
                                                   class="form-control timepicker" value="{!! old('time') !!}">

                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- TIMEZONE -->
                                <select name="timezone" id="timezone" style="width: 300px;">
                                    @include('layouts.adminlte.partials.timezones')
                                </select>
                            </div>
                        </div>

                        <!-- FLASH -->
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="flash" id="flash" value="1"> <b>Send as Flash
                                    Message</b>
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- Buttons -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary" id="send" v-show="sender && recipients && message">Preview before send</button>
                        <button type="button" class="btn btn-primary" id="preview" v-show="sender && recipients && message">Preview</button>
                        <button type="button" class="btn btn-info" id="draft" v-show="sender && message">Save draft</button>
                        <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
                    </div>
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