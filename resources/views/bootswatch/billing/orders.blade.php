@extends('layouts.bootswatch.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Orders</h1>

            <div class="clearfix">
                @if($data->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Transaction Ref</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <?php
                                    $class = $row->status == 'declined' ? 'warning' : 'success';
                            ?>
                            <tr class="{{$class}}">
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->item}}</td>
                                <td>{{$row->quantity.' Units'}}</td>
                                <td>{{$row->price}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->transaction_ref}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$data->render()}}
                @else
                    <div class="alert alert-info">
                        You have made no orders yet.
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection