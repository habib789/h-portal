@extends('masterpage.frontend')
@section('title')
    Cart Details
@stop
@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Cart</h1>
    </div>
@stop


@section('content')
    <div class="container card my-5">
        @if(!empty($cart))
            <table class="table table-bordered cart">
                <thead>
                <tr>
                    <td colspan="7">
                        <a class="btn btn-info btn-sm px-5" href="{{ route('shop') }}">Continue Shopping</a>
                    </td>
                </tr>
                <tr class="font-weight-bold">
                    <td>#</td>
                    <td></td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @php
                    $i=1;
                @endphp
                @foreach($cart as $productId => $product)
                    <tr>
                        <td width="30px">{{ $i++ }}</td>
                        <td width="150px">
                            <img src="{{ asset('uploads/images/'. $product['photo']) }}" height="100%" width="100%"
                                 alt="">
                        </td>
                        <td>
                            <div class="text-left">
                                <p class="font-weight-bold">{{ $product['name'] }}</p>
                            </div>
                        </td>
                        <td>BDT {{ number_format($product['price'],2) }}</td>
                        <td>
                            <form action="{{ route('decrease.cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}" id="">
                                <button class="button btn btn-info btn-sm">-</button>
                            </form>

                            <span class="px-2">{{ $product['quantity'] }}</span>
                            <form action="{{ route('increase.cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}" id="">
                                <button class="button btn btn-info btn-sm">+</button>
                            </form>
                        </td>
                        <td>BDT {{ number_format($product['total'],2) }}</td>
                        <td>
                            <form action="{{ route('remove.cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}" id="">
                                <button class="btn btn-outline-danger btn-sm">x</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6">
                        <a class="btn btn-danger btn-sm px-5" href="{{ route('clear.cart') }}">CLEAR CART</a>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="ml-auto w-50">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td colspan="2"><h4 class="font-weight-bold">Cart Total</h4></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Subtotal</td>
                        <td>BDT {{ number_format($subtotal,2) }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Total</td>
                        <td><h3>BDT {{ number_format($subtotal,2) }}</h3></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="card">
                                <a href="{{ route('checkout') }}" class="button btn btn-lg btn-block text-uppercase"
                                        style="font-size: small; font-weight: bold; letter-spacing: 1px">
                                    Checkout
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @else
            <br>
            <div class="alert alert-info">
                Your cart is empty! <br>
                You need to add some products First.
            </div>
            <div>
                <a class="btn btn-info btn-sm px-5" href="{{ route('shop') }}">Continue Shopping</a>
            </div>
        @endif
    </div>
@stop


