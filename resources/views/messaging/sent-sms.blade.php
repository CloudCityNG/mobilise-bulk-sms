@extends('layouts.frontend.master')

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Sent SMS</h1>
    <p class="uk-lead">All sent SMS</p>


    @if( $data->count() )
    <div id="table-container">

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
                                    <li><a href="#" id="dlr" data-recipients-id="{{$record->id}}">Delivery Report</a></li>
                                    <li><a href="#" id="resend" data-resend-id="{{$record->id}}">Resend</a></li>
                                    <li><a href="#" id="delete" data-delete-id="{{$record->id}}">Delete</a></li>
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

@section('modal')
@include('modals.sent-sms-dlr')
@include('modals.send-sms-modal')
@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/js/global.js"></script>
<script>

//set DLR table display modal
var dlrModal = UIkit.modal('#sent-sms-dlr-modal');
var smsModal = UIkit.modal('#send-sms-modal');

//register modal closer
registerCloseModal('#SentSmsDlrModalButton', dlrModal);
registerCloseModal('#sendSmsModalCancel', smsModal);

//check delivery report
$('#table-container').on('click', 'a#dlr', function(e){
    e.preventDefault();
    var $this = $(this);
    var $id = $this.attr('data-recipients-id');

    var jqXHR = $.get('/messaging/sent-sms/'+ $id + '/dlr');

    jqXHR.done( function(data){
        //grab the data
        var $out = data.html
        //empty the modal content
        $('#sent-sms-dlr-modal .content').empty();

        //feed it to the modal
        $('#sent-sms-dlr-modal .content').html( $out );

        //display the modal
        dlrModal.show()
    });

    jqXHR.fail (function(data){
        handleError(data.status);
    })

});

//resend
$('body').on('click', 'a#resend', function(e){
    e.preventDefault();
        //hide any previous errors
        $('.errors').hide();
        var $this = $(this);
        var $id = $this.attr('data-resend-id');

        //request for the sms details
        var jqXHR = $.get('/messaging/sent-sms/' + $id + '/get');
        jqXHR.done(function(data){
            //reset the form first
            resetForm('form.modal-send-sms');

            //set the form values from the request
            var $formValues = data.out[0]
            //var recipients = $formValues.smshistoryrecipient;
            var recipients = [];
            $.each($formValues.smshistoryrecipient, function(index, value){
                //console.log(value.destination)
                recipients.push(value.destination)
            })

            $('#recipients').val(recipients.join());
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


//delete
 $('#table-container').on('click', 'a#delete', function(e){
    e.preventDefault();
    var $this = $(this);
    var id = $this.attr('data-delete-id');

    UIkit.modal.confirm("Are you sure you want to delete?", function(){

        var jqXHR = $.get('/messaging/sent-sms/' + id + '/del');

        jqXHR.done( function(data){

            //$this.closest('tr').remove();
            $this.closest('tr').slideUp("slow", function(){
                $(this).remove();
            });
            alert_("Done");

        } );

        jqXHR.fail( function(data){
            handleError(data.status);
        });
    });
 });
</script>
@stop