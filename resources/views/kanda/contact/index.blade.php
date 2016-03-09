@extends('.layouts.kanda.frontend')

@section('content')

<div class="ui contact small modal">
  <i class="close icon"></i>
  <div class="header">
    New Contact
  </div>
  <div class="content">
    <p>
        <form class="ui small form" action="">
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
    </p>
  </div>
  <div class="actions">
    <div class="ui button close">Cancel</div>
    <div class="ui button primary">OK</div>
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

    <div class="ui four cards">

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
<script>
$(function(){

    $('.contact.modal').modal({
        close: ' .actions .close'
    }).modal('attach events', '#newContact', 'show');

});
</script>
@endsection