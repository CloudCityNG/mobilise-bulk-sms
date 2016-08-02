@extends('layouts.bootswatch.master')

@section('foot')
    @include('layouts.global.flash')
    <script src="/js/vue.js"></script>
    <script>
        $(function () {
            $('#back-button-1').click(function (e) {
                e.preventDefault();
                return history.go(-1);
            });
            $('#countryCodes').hide();
            $('#option').change(function (e) {
                if ($(this).val() != "") {
                    $('#countryCodes').fadeIn(500).show();
                } else {
                    $('#countryCodes').fadeOut(500).hide();
                }
            });
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
    </script>

@endsection

@section('content')
    <div class="row" id="app">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>File to SMS</h1>

            <div class="well clearfix">
                @include('layouts.bootswatch.partials.errors')
                <form action="" class="form-horizontal" id="countryPrefixForm">
                    <fieldset>
                        <legend>Prep File</legend>
                    <div class="form2">
                        <div class="option-block">
                            <div class="form-group">
                                <label for="" class="col-lg-3">First 10 Numbers</label>

                                <div class="col-lg-9">
                                    <ul class="returnNumbers">
                                        @foreach(explode(",",$data) as $number)
                                            <li>{{$number}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="options" class="col-lg-3">Add country prefix</label>

                                <div class="col-lg-7">
                                    <select id="option" class="form-control col-lg-9">
                                        <option value="">None</option>
                                        <option value="1">To numbers starting with 0</option>
                                        <option value="2">To all numbers</option>
                                    </select>
                                    <select id="countryCodes" class="form-control">
                                        <option value="1">US (1)</option>
                                        <option value="234">Nigeria (234)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group clearfix" style="padding-top: 20px;">
                                <div class="col-lg-12">
                                    <button class="btn btn-default" id="back-button-1">Back: Upload File</button>
                                    <button class="btn btn-primary pull-right" id="next-button-1">Next: Compose Message
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    <br>
                    <fieldset class="form3">
                        <legend>Send SMS</legend>
                        <div class="form-group">
                            <label for="sender" class="col-lg-3 control-label">Sender ID</label>

                            <div class="col-lg-7">
                                <input name="sender" type="text" class="form-control" id="sender"
                                       placeholder="Sender ID" value="{{old('sender')}}" maxlength="11">
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
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection