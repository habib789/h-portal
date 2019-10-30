<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title', 'Health Portal')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<section class="content card">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Health Portal
                                <small class="float-right">Date: {{ $order->created_at }}</small>
                            </h4>
                        </div>
                    </div>

                    <div class="row invoice-info">
                        <div class="col-sm-4">
                            Customer : <span class="font-weight-bold">{{ $order->customer_name }}</span>
                            <address>
                                <strong>Shipping Address</strong><br>
                                {{ $order->customer_address }}<br>
                                Phone: {{ $order->phone }}<br>
                            </address>
                        </div>

                        <div class="col-sm-4">
                            <br>
                            <b>Order ID:</b> #{{ $order->id }}<br>
                            <b>Payment Due:</b> {{ $order->payment_status }}<br>
                            @if($order->transaction_code !== null )
                                <b>Transaction code:</b> {{ $order->transaction_code }}<br>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                    {{ dd($order) }}--}}
                                @php $i=1; @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $product->product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->price * $product->quantity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6 ml-auto">
                            <p class="lead">Amount Due</p>
                            <div class="table">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>BDT 50.00 TK</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>BDT {{ number_format($order->total_amount,2) }} TK</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
