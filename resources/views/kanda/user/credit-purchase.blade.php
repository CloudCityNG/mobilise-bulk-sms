@extends('layouts.kanda.frontend')

@section('content')

<div class="boxx">

    <h2 class="ui header">
        <i class="plug icon"></i>
        <div class="content">
            Credit Purchase
        </div>
    </h2>

<div class="ui two steps">
  <div class="active step">
    <i class="payment icon"></i>
    <div class="content">
      <div class="title">Order Info</div>
    </div>
  </div>
  <div class="disabled step">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">Confirm Order</div>
    </div>
  </div>
</div>



    <table class="ui striped celled table">
      <thead>
        <tr><th>Credit Volume</th>
        <th>Price Per Unit</th>
      </tr></thead>
      <tbody>
        @foreach($data as $row)
        <tr>
            <td>
                <h4 class="ui image header">
                    <div class="content">{{$row->lower_range}} - {{$row->upper_range}}</div>
                </h4>
            </td>
            <td>₦{{$row->unit_price}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>


    <h4 class="ui header">
        <div class="content">SMS Quantity</div>
    </h4>
    @include('layouts.kanda.partials.errors')
    {!! Form::open(['url'=>'user/credit-purchase', 'class'=>'ui form', 'id'=>'custom-buy']) !!}

        <div class="field">
            <div class="ui action input">
                <input type="text" name="sms_quantity" id="sms_quantity" placeholder="">
                <button class="ui primary button">Buy Now</button>
            </div>
        </div>


        <div class="field">
            <div>₦<span class="units">0</span></div>
        </div>

    {!! Form::close() !!}

</div>

@endsection

@section('foot')
@parent
<script>

$(function(){

    var $units = $('span.units');

    $('form#custom-buy').on('keyup keydown focus onblur click onfocus', 'input#sms_quantity', function(e){

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
@endsection