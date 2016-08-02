@inject('session', 'Illuminate\Session\Store')

@extends('layouts.bootswatch.master')
@section('head')
    <link rel="stylesheet" href="/css/dropzone.min.css">
@endsection

@section('foot')
    <script type="text/javascript" src="/js//dropzone.min.js"></script>
    <script src="/js/vue.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        var Upload = new Dropzone('div.contactsUpload', {url: "/a/contacts-upload"});
        Dropzone.options.contactsUpload = {
            paramName: "contacts",
            maxFilesize: 5,
            acceptedFiles: "application/csv, .csv, .txt"
        };
        Upload.on("success", function(response){
            var $return = JSON.parse(response.xhr.response);
            //vm.addRecipients($return.data);
            var $message = $return.numberCount + ' Numbers uploaded successfully';
            swal({title:'Upload Successful',text: $message,timer:3000});
            //update well with same data
            $('ul.message-list').fadeIn(5000).append('<li>'+$message+'</li>');
        });
        Upload.on("error", function(response, errorMessage, xhr){
            var $return = JSON.parse(response.xhr.response);
            swal('Upload Error',$return.file[0],'error');
        });


        var vm = new Vue({
            el: '#app',
            data: {
                recipients: '',
                message: '',
                messageCharacterCount: 0
            },
            methods:{
                messageCharacterCounter: function(){
                    this.messageCharacterCount = this.message.length
                }
            }
        });


        var $form = $('#send-sms-form');
    </script>
@stop

@section('content')
    <div class="row" id="app">
        <div class="col-lg-8 col-lg-offset-1">
            <h1>Send SMS</h1>

            <div class="well">
                @include('layouts.bootswatch.partials.errors')
                <form class="form-horizontal" method="post" action="{{route('post_send_sms')}}" id="send-sms-form">
                    {{csrf_field()}}
                    <fieldset>
                        {{--<legend>Client Details</legend>--}}

                        <div class="form-group">
                            <label for="sender" class="col-lg-3 control-label">Sender ID</label>

                            <div class="col-lg-9">
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
                                                  id="recipients" v-model="recipients"
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
                                <textarea name="message" class="form-control" rows="5" v-model="message" v-on:keyup="messageCharacterCounter"
                                          id="message" placeholder="Message">{{old('message')}}</textarea>
                                <p class="help-block">@{{messageCharacterCount}} characters</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="schedule" class="col-lg-3 control-label">&nbsp;</label>
                            <div class="col-lg-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="schedule" id="schedule" value="1"> Schedule to send later
                                    </label>
                                </div>
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

                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <button type="reset" class="btn btn-default" id="reset">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="well" style="margin-top: 78px;">
                <ul class="message-list">
                </ul>
            </div>
        </div>
    </div>
@stop