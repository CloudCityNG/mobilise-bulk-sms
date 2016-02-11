@extends('layouts.kanda.frontend')


@section('content')
<div class="boxx">
    <h2 class="ui header blue">
        <i class="send icon blue"></i>
        <div class="content">
            Sent SMS
        </div>
    </h2>

    @foreach($data->chunk(3) as $chunk)
        <div class="ui three cards">
            @foreach($chunk as $sent)
            <div class="card">
                <div class="content">
                    <div class="header">{{$sent->sender}}</div>
                    <div class="meta">{{$sent->created_at->diffForHumans()}}</div>
                    <div class="description">{{$sent->message}}</div>
                </div>
                <div class="extra content">
                    <i class="check icon"></i>
                    <?php $recipients = $sent->smshistoryrecipient->count() ?>
                    {{$recipients}} {{ $recipients == 1 ? 'Recipient' : 'Recipients'  }}
                </div>
                <div class="ui bottom attached button teal">
                      <i class="add icon"></i>
                      View
                </div>

            </div>
            @endforeach
        </div>
    @endforeach

    <div class="ui three cards">
      <div class="card">
        <div class="content">
          <div class="header">Elliot Fu</div>
          <div class="meta">Friend</div>
          <div class="description">
            Elliot Fu is a film-maker from New York.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <div class="header">Veronika Ossi</div>
          <div class="meta">Friend</div>
          <div class="description">
            Veronika Ossi is a set designer living in New York who enjoys kittens, music, and partying. Veronika Ossi is a set designer living in New York who enjoys kitte.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="content">
          <div class="header">Jenny Hess</div>
          <div class="meta">Friend</div>
          <div class="description">
            Jenny is a student studying Media Management at the New School
          </div>
        </div>
      </div>
    </div>

</div>
@endsection