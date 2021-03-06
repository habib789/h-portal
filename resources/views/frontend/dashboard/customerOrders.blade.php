@extends('masterpage.account')
@section('title') My Order @stop
@section('page') MY ORDER @stop
@section('bcumb') My Order @stop
@section('content')
    <div class="card">
        <div class="card-body p-0">
            @if(count($orders) > 0)
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
                            <td>{{ $order->created_at->format('F d, Y') }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td class="text-info font-weight-bold">
                                {{ $order->total_amount }} TK
                            </td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->op_status }}</td>
                            <td>
                            <span class="badge bg-info">
                                <a class="text-white text-decoration-none px-1"
                                   href="{{ route('orderDetails', $order->id) }}">View</a>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-5">
                    <p class="alert alert-info">You haven't order any items yet.</p>
                    <a class="btn btn-info" href="{{ route('shop') }}"> Go To Shop</a>
                </div>
            @endif
        </div>
        {{ $orders->links() }}
    </div>
@stop
