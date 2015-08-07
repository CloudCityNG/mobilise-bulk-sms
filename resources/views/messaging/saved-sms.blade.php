@extends('layouts.frontend.master')

@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="/assets/uikit/css/components/datepicker.min.css">
@stop

@section('content')
<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h1 class="uk-panel-title uk-title">Draft SMS</h1>
    <p class="uk-lead">All Draft SMS</p>


    @if( $data->count() )
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
                                    <li><a href="#" data-send-id="{{$record->id}}" id="send">Send</a></li>
                                    <li><a href="#" data-delete-id="{{$record->id}}" id="delete">Delete</a></li>
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
    <div class="uk-alert">No Draft Messages yet.</div>
    @endif
</div>
@stop

@section('modal')
@include('modals.send-sms-modal')
@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/uikit/js/components/datepicker.min.js"></script>
<script src="/assets/uikit/js/components/timepicker.min.js"></script>
<script src="/assets/uikit/js/components/autocomplete.min.js"></script>
<script src="/assets/js/global.js"></script>
<script src="/assets/js/jquery.simplyCountable.js"></script>
<script>

$(function(){
     $('#message').simplyCountable({
         counter: '#characterCount',
         countType: 'characters',
         maxCount: 320,
         countDirection: 'up',
         strictMax: true
     });

    var smsModal = UIkit.modal('#send-sms-modal');
    registerCloseModal('#sendSmsModalCancel', smsModal);

    //Click the send dropdown
    $('#table-container').on('click', 'a#send', function(e){

        e.preventDefault();
        //hide any previous errors
        $('.errors').hide();
        var $this = $(this);
        var $id = $this.attr('data-send-id');

        //request for the sms details
        var jqXHR = $.get('/messaging/draft-sms/' + $id + '/get');
        jqXHR.done(function(data){

            //reset the form first
            resetForm('form.modal-send-sms');

            //set the form values from the request
            var $formValues = data.out[0]
            $('#recipients').val($formValues.recipients);
            $('#sender').val($formValues.sender);
            $('#message').val($formValues.message);

            if ( $formValues.schedule ) {
                var $schedule = $formValues.schedule;
                $schedule = $schedule.split(" ");
                $('#schedule_date').val($schedule[0]);
                $('#schedule_time').val($schedule[1]);
            }
            //popup the modal
            smsModal.show();
        });

        jqXHR.fail(function(data){
            handleError(data.status)
        });
    });

    //click the delete button
     $('#table-container').on('click', 'a#delete', function(e){
        e.preventDefault();
        var $this = $(this);
        var $id = $this.attr('data-delete-id');

        UIkit.modal.confirm("Are you sure you want to delete?", function(){

            var jqXHR = $.get('/messaging/draft-sms/' + $id + '/del');

                jqXHR.done( function(data){
                    //$this.closest('tr').remove();
                    $this.closest('tr').slideUp("slow", function(){
                        $(this).remove();
                    });
                    alert_("Done");
                });

                jqXHR.fail( function(data){
                    handleError(data.status);
                } );
        });

     });

    //Click the send button || Send the SMS
     $('body').on('click', '#sendSmsModalButton', function(e){

        e.preventDefault();
        var jqXHR = $.post('/messaging/quick-sms/draftSend', $('form.modal-send-sms').serialize());

        jqXHR.done( function(data){

            //close modal
            smsModal.hide();
            alert_("Message Sent.");

        } );

        jqXHR.fail( function(data){

            //emptyErrorContainer('.errors');
            //close modal
            if (data.status === 401 ){//user not authenticated.
                $(location).prop('pathname', 'user/login');
            }
            if (data.status === 422){

                var error = $.parseJSON(data.responseText);
                console.log(error);
                processAjaxError(error, '.errors', '.errors #error-ul');
                //emptyErrorContainer('.errors');
            }
            if (data.status === 500){
                alert_("Unknown error. Please try later");
            }
        });

     });

})
</script>
@stop