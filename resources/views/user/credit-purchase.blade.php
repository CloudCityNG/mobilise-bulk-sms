@extends('layouts.frontend.master')


@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge"></div>
    <h1 class="uk-panel-title uk-title">Credits Purchase</h1>
    <p class="uk-lead">Purchase Credit Units</p>


    <table class="uk-table uk-tale-hover uk-table-striped uk-table-condensed">

        <tr>
            <th>Credit Volume</th>
            <th>Price per Unit</th>
            <th></th>
        </tr>
        @foreach($data as $row)
        <tr>
            <td class="uk-table-middle">{{$row->lower_range}} - {{$row->upper_range}}</td>
            <td class="uk-table-middle">₦{{$row->unit_price}}</td>
            <?php $row_id = Illuminate\Support\Facades\Crypt::encrypt($row->id) ?>
            <td class="uk-table-middle"></td>
        </tr>
        @endforeach


    </table>

    <hr class="uk-grid-divider">
    @include('layouts.frontend.partials.errors')
    {!! Form::open(['url'=>'user/credit-purchase', 'class'=>'uk-form uk-form-horizontal', 'id'=>'custom-buy']) !!}
        <div class="uk-form-row">
            {!! Form::label('sms_quantity', 'SMS Quantity', ['class'=>'uk-form-label']) !!}
            <div class="uk-form-controls">
                {!! Form::text('sms_quantity', Input::old('sms_quantity'), ['placeholder'=>'SMS Quantity','maxlength'=>7]) !!}
                {!! Form::button('Buy It!', ['type'=>'submit','class'=>'uk-button uk-button-primary','id'=>'submit_']) !!}
            </div>
        </div>
        <div class="uk-form-row">

            <div class="uk-form-controls">
                <div>₦<span class="units">0</span></div>
            </div>
        </div>

    {!! Form::close() !!}

</div>

@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script>

$(function(){

    var $units = $('span.units');

    $('form#custom-buy').on('keyup keydown focus onblur click', 'input#sms_quantity', function(e){

        var $this = $(this);
        var $amount =  ( $this.val() != "" ) ? $this.val() : 0 ;

        switch ( true ){
            case ( $amount < 0 ):
                $units.html( parseFloat( $amount * 0 ).toFixed(2))
                break;
            case ( $amount >= 0 && $amount <= 4999):
                $units.html( parseFloat( $amount * 1.90 ).toFixed(2))
                break;
            case ( $amount >= 5000 && $amount <= 9999):
                $units.html( parseFloat( $amount * 1.80 ).toFixed(2))
                break;
            case ( $amount >= 10000 && $amount <= 49999):
                $units.html( parseFloat( $amount * 1.70 ).toFixed(2))
                break;
            case ( $amount >= 50000 && $amount <= 99999):
                $units.html( parseFloat( $amount * 1.60 ).toFixed(2))
                break;
            case ( $amount >= 100000 && $amount <= 499999):
                $units.html( parseFloat( $amount * 1.50 ).toFixed(2))
                break;
            case ( $amount >= 500000 && $amount <= 999999):
                $units.html( parseFloat( $amount * 1.40 ).toFixed(2))
                break;
            case ( $amount >= 1000000 ):
                $units.html( parseFloat( $amount * 1.30 ).toFixed(2))
                break;
        }
    });

    $('input#sms_quantity').trigger("click");
});
</script>
@stop