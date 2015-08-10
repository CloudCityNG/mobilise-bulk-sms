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
        <tr>
            <td class="uk-table-middle">100 - 4,999</td>
            <td class="uk-table-middle">₦1.90</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>
        <tr>
            <td class="uk-table-middle">5,000 - 9,999</td>
            <td class="uk-table-middle">₦1.80</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>
        <tr>
            <td class="uk-table-middle">10,000 - 49,999</td>
            <td class="uk-table-middle">₦1.70</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>
        <tr>
            <td class="uk-table-middle">50,000 - 99,999</td>
            <td class="uk-table-middle">₦1.60</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>
        <tr>
            <td class="uk-table-middle">100,000 - 499,999</td>
            <td class="uk-table-middle">₦1.50</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>
        <tr>
            <td class="uk-table-middle">500,000 - 999,999</td>
            <td class="uk-table-middle">₦1.40</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>
        <tr>
            <td class="uk-table-middle">1,000,000 - 5,000,000</td>
            <td class="uk-table-middle">₦1.30</td>
            <td class="uk-table-middle"><a class="uk-button uk-button-success" href="#">Buy It!</a></td>
        </tr>

    </table>

    <hr class="uk-grid-divider">

    <form class="uk-form uk-form-horizontal" id="custom-buy">
        <div class="uk-form-row">
            {!! Form::label('amount', 'Credit Amount', ['class'=>'uk-form-label']) !!}
            <div class="uk-form-controls">
                {!! Form::text('amount', Input::old('amount'), ['placeholder'=>'Credit Amount']) !!}
                {!! Form::button('Buy It!', ['type'=>'button','class'=>'uk-button uk-button-primary','id'=>'submit_']) !!}
            </div>
        </div>
        <div class="uk-form-row">

            <div class="uk-form-controls">
                <div><span class="units">0</span> Units</div>
            </div>
        </div>

    </form>

</div>

@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script>

$(function(){

    var $units = $('span.units');

    $('form#custom-buy').on('keyup keydown focus', 'input#amount', function(e){

        var $this = $(this);
        var $amount =  $this.val();

        switch ( true ){

            case ( $amount > 0 && $amount < 4999):
                $units.html( parseFloat( $amount * 1.90 ).toFixed(2))
                break;
            case ( $amount > 5000 && $amount < 9999):
                $units.html( parseFloat( $amount * 1.80 ).toFixed(2))
                break;
            case ( $amount > 10000 && $amount < 49999):
                $units.html( parseFloat( $amount * 1.70 ).toFixed(2))
                break;
            case ( $amount > 50000 && $amount < 99999):
                $units.html( parseFloat( $amount * 1.60 ).toFixed(2))
                break;
            case ( $amount > 100000 && $amount < 499999):
                $units.html( parseFloat( $amount * 1.50 ).toFixed(2))
                break;
            case ( $amount > 500000 && $amount < 999999):
                $units.html( parseFloat( $amount * 1.40 ).toFixed(2))
                break;
            case ( $amount > 1000000 && $amount < 5000000):
                $units.html( parseFloat( $amount * 1.40 ).toFixed(2))
                break;


        }
    });
});
</script>
@stop