@extends('layouts.kanda.admin')


@section('content')
<?php
setlocale(LC_MONETARY, 'en_US');
?>


    <div class="ui top attached tabular menu">
      <a class="item active" data-tab="first">Details</a>
      <a class="item" data-tab="second">Orders</a>
      <a class="item" data-tab="third">Transactions</a>
      <a class="item" data-tab="fourth">Update Balance</a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="first">
      <h3>Details</h3>
        <table class="ui small very basic collapsing celled table" style="min-width: 300px;">
            <tbody>
                <tr>
                    <td>Username</td>
                    <td>{{$user->username}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>Total Credits</td>
                    <td>{{$user->smscredit->available_credit}}</td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="ui bottom attached tab segment" data-tab="second">
      <h3>Orders</h3>
      @if ( $orders->count() )
      <table class="ui small celled padded table">
        <thead>
            <tr>
                <th class="single line">Order ID</th>
                <th>Price</th>
                <th>Item</th>
                <th>Status</th>
                <th>Transaction Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->order_id}}</td>
                <td class="single line">{{number_format($order->price/100, 2)}}</td>
                <td>{{$order->item}}</td>
                <td class="right aligned">{{$order->status}}<br><a href="#">Check status</a></td>
                <td>{{$order->transaction_code}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {!! $orders->render() !!}
      @else
        <div class="ui warning message">
          <i class="close icon"></i>
          No Orders yet.
        </div>
      @endif
    </div>


    <div class="ui bottom attached tab segment" data-tab="third">
      <h3>Transactions</h3>
      @if( $trans->count() )
      <table class="ui small celled padded table">
              <thead>
                  <tr>
                      <th>Mode</th>
                      <th>Status</th>
                      <th>trans code</th>
                      <th>trans ref</th>
                      <th>created</th>
                      <th>completed</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($trans as $tran)
                  <tr>
                        <td>{{$tran->mode}}</td>
                      <td>{{$tran->status}}</td>
                      <td class="single line">{{$tran->transaction_code}}</td>
                      <td class="single line">{{$tran->transaction_ref}}</td>
                      <td class="single line">{{$tran->created_at}}</td>
                      <td class="single line">{{$tran->updated_at}}</td>
                  </tr>
                  @endforeach
              </tbody>
       </table>
       {!! $trans->render() !!}
      @else
        <div class="ui warning message">
          <i class="close icon"></i>
          No Transactions yet.
        </div>
      @endif
    </div>

    <div class="ui bottom attached tab segment" data-tab="fourth">
        <h3>Update Balance</h3>
        <div class="ui teal label" style="margin-bottom: 20px;">
            <i class="money icon"></i>
                {{$user->smscredit->available_credit}}
                Units
        </div>

        <form class="ui form update-balance">
            <div class="ui fluid action input">
              <input type="text" name="sms_quantity" id="sms_quantity" placeholder="Units...">
              <div class="ui button">Add Units</div>
            </div>

            <div class="field" style="margin-top: 20px;">
                N<span id="amount"></span>
            </div>
        </form>

    </div>



@endsection


@section('foot')
@parent
<script>
$(document).ready(function(){
    $('.menu .item').tab();


    $('form.update-balance').on('keyup keydown focus blur', 'input#sms_quantity', function(e){
        //e.preventDefault();
        var $units = $(this).val();
        $('#amount').html( calcAmountFromUnits($units) );
    });




    function calcAmountFromUnits($units)
    {
        var out;
        switch(true)
        {
            case ( $units < 0 ):
                out = parseFloat( $units * 0 ).toFixed(2);
                break;
            case ( $units >= 0 && $units <= 4999):
                out = parseFloat( $units * 1.90 ).toFixed(2);
                break;
            case ( $units >= 5000 && $units <= 9999):
                out = parseFloat( $amount * 1.80 ).toFixed(2);
                break;
            case ( $units >= 10000 && $units <= 49999):
                out = parseFloat( $units * 1.70 ).toFixed(2);
                break;
            case ( $units >= 50000 && $units <= 99999):
                out = parseFloat( $units * 1.60 ).toFixed(2);
                break;
            case ( $units >= 100000 && $units <= 499999):
                out = parseFloat( $units * 1.50 ).toFixed(2);
                break;
            case ( $units >= 500000 && $units <= 999999):
                out = parseFloat( $units * 1.40 ).toFixed(2);
                break;
            case ( $units >= 1000000 ):
                out = parseFloat( $units * 1.30 ).toFixed(2);
                break;
        }

        return out;
    }


});
</script>
@endsection