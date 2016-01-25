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

<form action="{{$transaction_info->checkout_url}}" method="post" class="ui form">
<input type="hidden" name="firstname" value="testuser"/>
    <input type="hidden" name="lastname" value="testuserlastname"/>
    <input type="hidden" name="return_script" value="{{$transaction_info->return_uri}}"/>
    <input type="hidden" name="country" value="{{$transaction_info->country}}"/>
    <input type="hidden" name="shipping" value="{{$transaction_info->shipping}}"/>
    <input type="hidden" name="currency" value="{{$transaction_info->currency}}"/>
    <input type="hidden" name="price" value="{{$transaction_info->price}}"/>
    <input type="hidden" name="item" value="{{$transaction_info->item}}"/>
    <input type="hidden" name="txid" value="{{$transaction_info->txid}}"/>
    <input type="hidden" name="poid" value="{{$transaction_info->poid}}"/>
    <input type="hidden" name="return_uri" value="{{$transaction_info->return_uri}}"/>
    <input type="hidden" name="merchant_key" value="{{$transaction_info->merchant_key}}"/>
    <input type="hidden" name="merchant_id" value="{{$transaction_info->merchant_id}}"/>
    <input type="hidden" name="rg_color" value="#6077bc"/>
    <input type="hidden" name="bg_color" value="#f4f6f9"/>
    <input type="hidden" name="title_name" value="{{$transaction_info->title_name}}"/>
    <input type="hidden" name="logo_url" value="{{$transaction_info->logo_url}}"/>
    <input type="hidden" name="cmd" value="checkout"/>

    {{--<input class="ui primary button" type="submit" value="Proceed to Checkout"/>--}}

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
        <br/>
        You requested to purchase {{$sms_quantity}} units of SMS for ₦{{$total_cost}}
        <br/>
        <br/>
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
        <input class="ui primary button" type="submit" value="Approve"/>
        {{--<div class="ui green button" id="approve">Approve</div>--}}
        <div class="ui red button" id="decline">Decline</div>
      </div>
    </div>
  </div>

  </div>



</form>

</div>
@endsection

