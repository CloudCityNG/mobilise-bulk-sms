@extends('layouts.bootswatch.master')

@section('foot')
    <script>
//        $(function () {
//
//            var $form1 = $('#fileUploadForm');
//            var $form2 = $('#countryPrefixForm');
//            $form2.hide();
//            $('#countryCodes').hide();
//
//            //handle file upload
//            var form = document.getElementById('fileUploadForm');
//            var fileSelect = document.getElementById('contacts');
//            var uploadButton = document.getElementById('upload-button');
//
//            form.onsubmit = function (event) {
//                event.preventDefault();
//                //update the button
//                uploadButton.innerHTML = 'Uploading...';
//                var files = fileSelect.files;
//                var formData = new FormData();
//                //loop through the files. even if its one file, an array is always returned.
//                for (var i = 0; i < files.length; i++) {
//                    var file = files[i];
//                    //check file type
//                    if (!file.type.match('text.*')) {
//                        continue;
//                    }
//                    formData.append('contacts', file, file.name);
//                }
//                var xhr = new XMLHttpRequest();
//                xhr.open('POST', '/a/contacts-file-upload', true);
//                xhr.onload = function () {
//                    if (xhr.status === 200) {
//                        uploadButton.innerHTML = 'Upload';
//                        //show form two.
//                        console.log(xhr.response);
//                        var response = JSON.parse(xhr.response);
//                        handleResponse(response);
//                    } else {
//                        swal('Error', 'An Error Occured', 'error');
//                        uploadButton.innerHTML = 'Upload';
//                        clearFileInput();
//                    }
//                };
//                xhr.send(formData);
//            };
//
//            window.handleResponse = function (response) {
//                if (response.success === true) {
//                    //process the passed input
//                    var $returnNumbers = splitString(response.data, ",");
//
//                    $('.returnNumbers').empty();
//                    $.each($returnNumbers, function(index, value){
//                        $('.returnNumbers').append('<li>'+value+'</li>');
//                    });
//                    var msg = response.numberCount + ' Numbers uploaded successfully';
//                    swal({title:'Upload successful',text: msg,timer:2000});
//
//                    $form1.hide();
//                    $form2.show();
//                }
//            };
//
//            //clear the input form upload when we click back
//            window.clearFileInput = function(){
//                var input = $('#contacts');
//                input.replaceWith(input.val('').clone(true));
//            }
//            window.splitString = function(stringToSplit, separator){
//                var arrayOfStrings = stringToSplit.split(separator);
//                return arrayOfStrings;
//            };
//
//            $('#back-button-1').click(function(e){
//                e.preventDefault();
//                if ( !$form1.is(":visible") ){
//                    if ( confirm("Are you sure you want to start over again?") ){
//                        clearFileInput();
//                        $form1.show();
//                        $form2.hide();
//                    }
//                }
//            });
//            $('#next-button-1').click(function (e) {
//
//            });
//
//
//            //$('.step2').hide();
//            //show step1- hide step2 & step3
//            //if upload is successful, hide step1, show step2, hide step3
////            $('.option-block').hide();
//            $('#option').change(function (e) {
//                if ($(this).val() != "") {
//                    $('#countryCodes').fadeIn(500).show();
//                } else {
//                    $('#countryCodes').fadeOut(500).hide();
//                }
//            });
//
//
//        });
    </script>
@endsection

@section('head')
    <link rel="stylesheet" href="/bootswatch/css/style.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>File to SMS</h1>

            <div class="content">
                <div class="well clearfix">
                    @include('layouts.bootswatch.partials.errors')
                    <form action="{{route('post_file_to_sms')}}" id="fileUploadForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Upload File</legend>
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="contacts" class="col-lg-3 control-label">&nbsp;</label>

                            <div class="col-lg-9">
                                <input type="file" name="contacts" id="contacts" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <button class="btn btn-primary" type="submit" id="upload">Upload</button>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop