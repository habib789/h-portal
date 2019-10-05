@extends('masterpage.account')
@section('title') My Order @stop
@section('page')<h5 class="text-info font-weight-bold">MY ORDER</h5>@stop
@section('bcumb') My Order @stop
@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered">
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
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td class="text-info font-weight-bold">
                            {{ $order->total_amount }} TK
                        </td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->op_status }}</td>
                        <td>
                            <span class="badge badge-pill badge-info text-white px-2">
                                <a href="{{ route('orderDetails', $order->id) }}">View</a>
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
@stop
