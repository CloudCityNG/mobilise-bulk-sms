@inject('session', 'Illuminate\Session\Store')

@extends('layouts.bootswatch.master')
@section('head')
    <link rel="stylesheet" href="/css/dropzone.min.css">
    <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">
@endsection

@section('foot')
    <script type="text/javascript" src="/js//dropzone.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/jquery.datetimepicker.full.min.js"></script>
    <script>
        $(function () {

            Dropzone.autoDiscover = false;
            var Upload = new Dropzone('div.contactsUpload', {url: "/a/contacts-upload"});
            Dropzone.options.contactsUpload = {
                paramName: "contacts",
                maxFilesize: 5,
                acceptedFiles: "application/csv, .csv, .txt"
            };
            Upload.on("success", function (response) {
                var $return = JSON.parse(response.xhr.response);
                vm.addRecipients($return.data);
                var $message = $return.numberCount + ' Numbers uploaded successfully';
                swal({title: 'Upload Successful', text: $message, timer: 3000});
                //update well with same data
            });
            Upload.on("error", function (response, errorMessage, xhr) {
                var $return = JSON.parse(response.xhr.response);
                swal('Upload Error', $return.file[0], 'error');
            });


            var vm = new Vue({
                el: '#app',
                data: {
                    recipients: '',
                    message: '',
                    messageCharacterCount: 0,
                    pageCount: 0,
                },
                methods: {
                    messageCharacterCounter: function () {
                        var len = this.message.length
                        this.messageCharacterCount = len;
                        if (len == 0)
                            this.pageCount = 0;
                        else if ( len > 0 && len <= 160 )
                            this.pageCount = '1 Page';
                        else if ( len > 160 && len <= 320 )
                            this.pageCount = '2 Pages';
                        else if ( len > 320 && len <= 480 )
                            this.pageCount = '3 Pages';
                        //else if ( len > 480 )
                            //chop of
                    },
                    restrictXters: function () {
                        var $recipients = this.recipients;
                        this.recipients = $recipients.replace(/[^\d(,+)]/g, '');
                    },
                    addRecipients: function (newRecipient) {
                    var res = this.recipients;
                        if ( res == "" ){
                            this.recipients = res + newRecipient;
                        } else if ( res.charAt(res.length - 1) == "," ){
                            this.recipients = res + newRecipient;
                        } else {
                            this.recipients = this.recipients + "," + newRecipient;
                        }
                }
            }
        })
            ;

            $('#datetime').datetimepicker({
                format:'Y/m/d H:i',
                minDate: 0
            });
            var $form = $('#send-sms-form');

            $('button#preview').click(function (e) {
                e.preventDefault();
                $('#ajax-error-container').hide();
                $('#ajax-error-container ul').empty();

                var jqXHR = $.post('/a/send-sms-preview', $form.serialize());

                jqXHR.done(function (data) {
                    $('div#preview-modal .modal-body').empty();
                    $('div#preview-modal .modal-body').append(data.html);
                    $('div#preview-modal').modal('show');
                });

                jqXHR.fail(function (data) {
                    var htmlOut;
                    var response = data.responseJSON;
                    if ( response.credit ){
                        swal( "Low Balance", response.credit[0], "error");
                        return
                    }
                    if ( response.sender ){
                        $('#ajax-error-container ul').append("<li>"+response.sender[0]+"</li>");
                    }
                    if ( response.recipients ){
                        $('#ajax-error-container ul').append("<li>"+response.recipients[0]+"</li>");
                    }
                    if ( response.message ){
                        $('#ajax-error-container ul').append("<li>"+response.message[0]+"</li>");
                    }
                    if (response.schedule) {
                        $('#ajax-error-container ul').append("<li>" + response.schedule[0] + "</li>");
                    }

                    $('#ajax-error-container').show();
                })

            });

            $('button#reset').click(function(e){
                e.preventDefault();
                location.href = '/dashboard';
                console.log(location);
            });

        });
    </script>
@stop

@section('content')
    <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">SMS Message Summary</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-lg-9 col-lg-offset-1">
            <h1>Send SMS</h1>

            <div class="well">
                @include('layouts.bootswatch.partials.errors')
                <div class="alert alert-danger alert-dismissible" id="ajax-error-container" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Form Errors</h4>
                    <ul>
                    </ul>
                </div>
                <form class="form-horizontal" method="post" action="{{route('post_send_sms')}}" id="send-sms-form">
                    {{csrf_field()}}
                    <fieldset>
                        {{--<legend>Client Details</legend>--}}

                        <div class="form-group">
                            <label for="sender" class="col-lg-3 control-label">Sender ID</label>

                            <div class="col-lg-3">
                                <input name="sender" type="text" class="form-control" id="sender"
                                       placeholder="Sender ID" value="{{old('sender')}}" maxlength="11">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipients" class="col-lg-3 control-label">Recipients</label>

                            <div class="col-lg-9">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#paste" data-toggle="tab" aria-expanded="true">Manual Input</a>
                                    </li>
                                    <li>
                                        <a href="#upload" data-toggle="tab" aria-expanded="false">Upload</a>
                                    </li>
                                </ul>
                                <div id="recipientsTab" class="tab-content">
                                    <div class="tab-pane fade active in" id="paste">
                                        <textarea name="recipients" class="form-control" rows="4"
                                                  id="recipients" v-model="recipients" v-on:keyup="restrictXters"
                                                  placeholder="Recipients">{{old('recipients')}}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="upload">
                                        <div class="">
                                            <div id="" class="contactsUpload dropzone"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-lg-3 control-label">Message</label>

                            <div class="col-lg-9">
                                <textarea name="message" class="form-control" rows="5" v-model="message"
                                          v-on:keyup="messageCharacterCounter"
                                          id="message" placeholder="Message">{{old('message')}}</textarea>

                                <p class="help-block">@{{messageCharacterCount}} characters. @{{pageCount}}.</p>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="schedule" class="col-lg-3 control-label">&nbsp;</label>

                            <div class="col-lg-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="schedule" id="schedule" value="1"> Schedule to send later
                                    </label>
                                </div><br>
                                <input type="text" id="datetime" name="datetime" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="flash" class="col-lg-3 control-label">&nbsp;</label>

                            <div class="col-lg-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="flash" id="flash" value="1"> Send as Flash Message
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <button class="btn btn-default btn-primary" id="preview">Preview</button>
                                <button class="btn btn-default btn-info" id="draft">Save Draft</button>
                                <button class="btn btn-default btn-warning" id="reset">Cancel</button>
                                {{--<button type="submit" class="btn btn-primary" id="submit">Submit</button>--}}
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
@stop