@extends('layouts.kanda.frontend')

@section('content')

<div class="boxx">
    <h2 class="ui header">
        <i class="plug icon"></i>
        <div class="content">
            Dashboard
        </div>
    </h2>

        <div class="ui three statistics" style="margin-top: 40px;">
            <div class="ui blue statistic">
              <div class="value">
                <i class="mail icon"></i> {{$sent_sms}}
              </div>
              <div class="label">
                Sent SMS
              </div>
            </div>

          <div class="ui olive statistic">
            <div class="text value">
              Zero<br>
              Message(s)
            </div>
            <div class="label">
              Undelivered
            </div>
          </div>


          <div class="ui pink statistic">
            <div class="value">
              <i class="user icon"></i> 0
            </div>
            <div class="label">
              Contacts
            </div>
          </div>

        </div>

<div class="ui section divider"></div>

        <div class="ui three statistics">
          <div class="orange statistic">
            <div class="value">
              {{$currentUser->smscredit->available_credit}}
            </div>
            <div class="label">
              Credits
            </div>
          </div>
          <div class="ui violet statistic">
            <div class="text value">
              Three<br>
              Thousand<br/>
              Units
            </div>
            <div class="label">
              Purchased
            </div>
          </div>
          <div class="ui teal statistic">
            <div class="value">
              <i class="save icon"></i> 5
            </div>
            <div class="label">
              Saved Messages
            </div>
          </div>
        </div>


</div>

@endsection