@extends('masterpage.backend')
@section('title') Orders Details @stop
@section('header')  Orders Details @stop
@section('bcumb')  Orders Details @stop

@section('content')
    <section class="content card">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3" id="app">
                        <div id="print">
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
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="" onclick="printContent()" class="btn btn-default"><i class="fas fa-print"></i>
                                    Print</a>
                                <a href="{{ route('pdf.create', $order->id) }}" class="button btn btn-info float-right"
                                   style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('js')
    <script>
        function printContent() {
            var restore = document.body.innerHTML;
            var printContent = document.getElementById('print').innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restore;
        }
    </script>
@stop
