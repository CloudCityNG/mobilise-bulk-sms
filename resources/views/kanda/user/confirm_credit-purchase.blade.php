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
  <div class="completed step">
    <i class="payment icon"></i>
    <div class="content">
      <div class="title">Order Info</div>
    </div>
  </div>
  <div class="active step">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">Confirm Order</div>
    </div>
  </div>
</div>

<div class="ui centered cards">
  <div class="card">
    <div class="content">

      <div class="header">
        {{$transaction_info->title_name}}
      </div>
      <div class="meta">
        {{$transaction_info->item}}
      </div>
      <div class="description">
        <p>
        You requested to purchase {{$sms_quantity}} units of SMS for ₦{{$total_cost}}
        </p>
        <p><strong>Transaction Id: {{$transaction_info->txid}}</strong></p>
        <p><strong>Order Number: {{$transaction_info->order_number}}</strong></p>
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
<?php

$url = "user/credit-purchase/approve/$transaction_info->order_number/txid/$transaction_info->txid/poid/$transaction_info->poid/quantity/$transaction_info->quantity/unitprice/$transaction_info->unit_price/price/$transaction_info->price/item/$transaction_info->item";
$url = url($url);
?>
        <a class="ui primary button" href="{{$url}}">Approve</a>
        {{--<input class="ui primary button" type="submit" value="Approve"/>--}}
        {{--<div class="ui green button" id="approve">Approve</div>--}}
        <a class="ui red button" id="decline" href="/user/payment-return?action=decline&order={{$transaction_info->order_number}}">Decline</a>
        {{--<div class="ui red button" id="decline">Decline</div>--}}
      </div>
    </div>
  </div>

  </div>
    txid : {{$transaction_info->txid}}
    <br/>
    order number: {{$transaction_info->order_number}}



</form>

</div>
@endsection

