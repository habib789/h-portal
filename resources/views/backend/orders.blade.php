@extends('masterpage.backend')
@section('title') Orders @stop
@section('header')  Customer Orders @stop
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr class="text-info">
                            <th style="width: 10px">Order#</th>
                            <th>Date</th>
                            <th>Ship To</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>OP Status</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td class="text-info font-weight-bold">
                                    {{ $order->total_amount }} TK
                                </td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->op_status }}</td>
                                <td>
                                    <a href="">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
