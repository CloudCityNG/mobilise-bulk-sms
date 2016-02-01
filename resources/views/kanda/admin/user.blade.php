@extends('layouts.kanda.admin')


@section('content')
<?php
setlocale(LC_MONETARY, 'en_US');
?>


    <div class="ui top attached tabular menu">
      <a class="item active" data-tab="first">Details</a>
      <a class="item" data-tab="second">Orders</a>
      <a class="item" data-tab="third">Transactions</a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="first">
      <h3>details</h3>
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
                      <td>{{$tran->status}}</td>
                      <td class="single line">{{$tran->transaction_code}}</td>
                      <td class="single line">{{$tran->transaction_ref}}</td>
                      <td class="single line">{{$tran->created_at}}</td>
                      <td class="single line">{{$tran->updated_at}}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
      @else
        <div class="ui warning message">
          <i class="close icon"></i>
          No Transactions yet.
        </div>
      @endif
    </div>



@endsection


@section('foot')
@parent
<script>
$(document).ready(function(){
    $('.menu .item').tab();
});
</script>
@endsection