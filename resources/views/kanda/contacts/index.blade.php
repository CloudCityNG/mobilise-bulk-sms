@extends('.layouts.kanda.frontend')

@section('head')
@parent
<link rel="stylesheet" href="/css/loading.css">
@endsection

@section('modal')
@include('modals.loading')
@endsection


@section('content')

<div class="ui contact small modal" id="quic-new-contact">
  <i class="close icon"></i>
  <div class="header">
    New Contact
  </div>
  <div class="content">
        <form class="ui small form" action="" id="newContactForm">
            <div class="field">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname"/>
            </div>
            <div class="field">
                <label for="firstname">Lastname</label>
                <input type="text" name="lastname" id="lastname" placeholder="Lastname"/>
            </div>
            <div class="field">
                <label for="firstname">Email</label>
                <input type="text" name="email" id="email" placeholder="Email"/>
            </div>
            <div class="field">
                <label for="firstname">GSM</label>
                <input type="text" name="gsm" id="gsm" placeholder="GSM"/>
            </div>
            <div class="field">
                <label for="firstname">GSM II</label>
                <input type="text" name="gsm2" id="gsm2" placeholder="GSM II"/>
            </div>
            <div class="field">
                <label for="firstname">Custom</label>
                <textarea name="custom" id="custom" cols="30" rows="3"></textarea>
            </div>
        </form>
  </div>
  <div class="actions">
    <div class="ui button close" id="cancel_button">Cancel</div>
    <div class="ui button primary" id="ok_button">OK</div>
  </div>
</div>

<div class="boxx">
    <h2 class="ui header">
        <i class="user icon"></i>
        <div class="content">
            Contacts
        </div>
    </h2>

    <div class="container">
        <button class="ui right floated button primary" id="newContact" style="margin-bottom: 20px;">New Contact</button>
    </div>

    <div class="ui four cards" id="contacts-content">

        @foreach($data as $contact)
        <div class="card">
            <div class="content">
                <div class="header">{{$contact->firstname}}</div>
                <div class="meta">M: {{$contact->gsm}}</div>
                @if ($contact->gsm2)
                <div class="meta">H: {{$contact->gsm2}}</div>
                @endif
            </div>
            <div class="extra content">
                <small>
                <a href="#">Send SMS</a> |
                <a href="#">View</a> |
                <a href="#">Delete</a>
                </small>
            </div>
        </div>
        @endforeach

    </div>

</div>

@endsection

@section('foot')
@parent
<script src="/kanda/js/master.js"></script>
<script>
$(function(){

    var $modal = $('.contact.modal');
    $modal
    .modal({
//        onHide: function(){
//            alert('hidden');
//            $('#newContactForm').trigger("reset")
//        }
    })
    .modal('attach events', '.close', 'hide')
    .modal('attach events', '#newContact', 'show');


    $('body').on('click', '#ok_button', function(e){
        e.preventDefault();

        var jqXHR = $.get("/contact/new-contact", $('form#newContactForm').serialize());

        jqXHR.done(function(data){
            //empty the contacts html container
            $('#contacts-content').empty();
            //populate the contact html with received data
            $('#contacts-content').html(data.html);
            //reset the form
            resetForm('#newContactForm');
            //hide the modal
            $modal.modal('hide');
            //send a notification the contact has been added
            swal('Contact Added');
            //close modal
        });

        jqXHR.fail(function(response){
            if ( response.status === 404 )
            {
                swal("Server not found", "error");
            }
            else if ( response.status === 401 )
            {
                $(location).prop('pathname', 'user/login');
            }
            else if ( response.status === 422 )
            {
                var error = $.parseJSON(response.responseText);
                console.log(error);
            }
            if ( response.status === 500 )
            {
                swal("Unknown error. Please try later", "error");
            }
            //loop over th response

            //display the response
        });
    });


    $('#cancel_button').click(function(e){
        //close the modal
        $modal.hide();
    });
});

function resetForm($el)
{
    $($el).trigger("reset");
}
</script>
@endsection