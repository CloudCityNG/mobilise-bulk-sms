@extends('layouts.bootswatch.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Payments</h1>

            <div class="clearfix">
                @if($data->count())
                    <table class="table">
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
                        @foreach($data as $row)
                            <tr class="success">
                                <td>{{$row->verified_date}}</td>
                                <td>₦{{number_format($row->price/100,2)}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->item}}</td>
                                <td><a href="#!" class="btn btn-default btn-xs">invoice</a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$data->render()}}
                @else
                    <div class="alert alert-info">
                        You have no payments yet.
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection