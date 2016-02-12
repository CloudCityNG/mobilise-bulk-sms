@extends('layouts.kanda.frontend')


@section('content')
<div class="boxx">
    <h3 class="ui header blue box-header">
        <i class="payment icon blue"></i>
        <div class="content">
            Your Order History
        </div>
    </h3>
    @if ($data->count())
    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>price</th>
                <th>Status</th>
                <th>Transaction Ref</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $trans)
            <tr>
                <td>{{$trans->created_at}}</td>
                <td>{{$trans->item}}</td>
                <td>{{$trans->quantity . 'Units'}}</td>
                <td>N{{number_format($trans->price/100, 2)}}</td>
                <td>{{$trans->status}}</td>
                <td>{{$trans->transaction_ref}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $data->render() !!}
    @else
    <div class="ui warning message">
      <i class="close icon"></i>
      You do not have any Orders yet.
    </div>
    @endif

</div>
@endsection