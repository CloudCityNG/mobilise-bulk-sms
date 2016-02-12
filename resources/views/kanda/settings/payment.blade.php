@extends('layouts.kanda.frontend')


@section('content')
<div class="boxx">
    <h3 class="ui header blue box-header">
        <i class="payment icon blue"></i>
        <div class="content">
            Your Payment History
        </div>
    </h3>

    @if($data->count())
    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Charge</th>
                <th>Status</th>
                <th>Description</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $trans)
            <tr>
                <td>{{$trans->verified_date}}</td>
                <td>N{{number_format($trans->price/100, 2)}}</td>
                <td>{{$trans->status}}</td>
                <td>{{$trans->item  }}</td>
                <td><a href="#">view</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $data->render() !!}
    @else
    <div class="ui warning message">
      <i class="close icon"></i>
      You do not have any successful Payments yet.
    </div>
    @endif

</div>
@endsection