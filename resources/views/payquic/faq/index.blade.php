@extends('payquic.layouts.master')

@section('head')
@parent

<style type="text/css">

div.content {
    border-bottom: 1px solid #eeeeee;
}

#payquic-faq {

}

div#payquic-faq > div.panel {
    padding: 20px 20px;
    border-radius: 0;
    border-top: 1px solid #eeeeee;
    border-left: none;
    border-right: none;
    border-bottom: none;
    box-shadow: none;
}

div#payquic-faq > div.panel  a {
    color: #008cdd;
    text-decoration: none;
    font-size: 14px;
}

.panel-default>.panel-heading {
  background-color: inherit;
  padding-bottom: 0;
}

.panel-group .panel-heading+.panel-collapse>.panel-body {
  border-top: none;
}

div.panel-body {
    padding-top: 0;
}
</style>
@stop

@section('content')

    <div class="row">
    <div class="col-md-12 left-side">

    @if( !is_null($data) )

        <div id="payquic-faq" class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php $counter = 1; ?>
        @foreach( $data->get() as $d )
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading_{!! $d->id !!}">
              <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_{!! $d->id !!}" aria-expanded="false" aria-controls="collapse_{!! $d->id !!}">
                     <strong>{{ $d->question  }}</strong>

                </a>
                @if ( Auth::user() )
                <span style="float: right;">
                    <a href="/faq/{!! $d->id !!}/hide">[HIDE]</a>
                    <a href="/faq/{!! $d->id !!}/edit">[EDIT]</a>
                    <a href="/faq/{!! $d->id !!}/delete">[DELETE]</a>
                </span>
                @endif

              </h4>
            </div>
            <div id="collapse_{!! $d->id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{!! $d->id !!}">
              <div class="panel-body">
                {!! $d->answer !!}
              </div>
            </div>
          </div>
          <?php $counter++ ?>
        @endforeach

        </div>

    @else
        <div class="well-sm">
            <p>
                No FAQ yet.
            </p>
        </div>
    @endif

    @if ( Auth::user() )
    <hr>
    <h4>Hidden FAQs</h4>
    @if( !is_null($hidden) )

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php $counter2 = 1; ?>
            @foreach( $hidden->get() as $h )
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading_{!! $h->id !!}">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_{!! $h->id !!}" aria-expanded="false" aria-controls="collapse_{!! $h->id !!}">
                         <strong>{{$counter2}} &nbsp; {{ $h->question  }}</strong>

                    </a>

                    <span style="float: right;">
                        <a href="/faq/{!! $h->id !!}/show">[SHOW]</a>
                        <a href="/faq/{!! $h->id !!}/edit">[EDIT]</a>
                        <a href="/faq/{!! $h->id !!}/delete">[DELETE]</a>
                    </span>


                  </h4>
                </div>
                <div id="collapse_{!! $h->id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{!! $h->id !!}">
                  <div class="panel-body">
                    {!! $h->answer !!}
                  </div>
                </div>
              </div>
              <?php $counter2++ ?>
            @endforeach

            </div>

        @else
            <div class="well-sm">
                <p>
                    No FAQ yet.
                </p>
            </div>
        @endif
    @endif
    </div>
    </div>



@stop