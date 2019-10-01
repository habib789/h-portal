@extends('masterpage.frontend')
@section('title')
    Checkout
@stop
@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Checkout</h1>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cart as $productID => $product)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $product['name'] }}</h6>
                                <small class="text-muted">{{ $product['quantity'] . ' x ' . $product['price'] }}</small>
                            </div>
                            <span class="text-muted">{{ number_format($product['total'],2) }}</span>
                        </li>
                    @endforeach

                    <li class="list-group-item d-flex justify-content-between">
                        <span class="font-weight-bold">Subtotal (BDT)</span>
                        <strong>{{ number_format($subtotal,2) }} TK</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="font-weight-bold">Shipping Cost</span>
                        <strong>50 TK</strong>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span class="font-weight-bold">Total (BDT)</span>
                        <strong>{{ number_format($total,2) }} TK</strong>
                    </li>
                </ul>
            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{ route('checkout') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_name">Customer name</label>
                            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror"
                                   id="customer_name" value="{{ auth()->user()->patient->first_name .' '.auth()->user()->patient->last_name}}">
                            @error('customer_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="customer_phone">Customer phone</label>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">+880</span>
                                </div>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="address">Shipping Address</label>
                                <textarea class="form-control @error('customer_address') is-invalid @enderror"
                                          name="customer_address" id="address" cols="30"
                                          rows="3">{{ old('customer_address') }}</textarea>
                            </div>
                            @error('customer_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="button btn btn-info btn-block my-3" type="submit">Proceed to checkout</button>
                </form>
                {{--                    <div class="custom-control custom-checkbox">--}}
                {{--                        <input type="checkbox" class="custom-control-input" id="same-address">--}}
                {{--                        <label class="custom-control-label" for="same-address">Shipping address is the same as my--}}
                {{--                            billing address</label>--}}
                {{--                    </div>--}}
                {{--                    <div class="custom-control custom-checkbox">--}}
                {{--                        <input type="checkbox" class="custom-control-input" id="save-info">--}}
                {{--                        <label class="custom-control-label" for="save-info">Save this information for next time</label>--}}
                {{--                    </div>--}}
                {{--                    <hr class="mb-4">--}}

                {{--                    <h4 class="mb-3">Payment</h4>--}}

                {{--                    <div class="d-block my-3">--}}
                {{--                        <div class="custom-control custom-radio">--}}
                {{--                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked--}}
                {{--                                   required>--}}
                {{--                            <label class="custom-control-label" for="credit">Credit card</label>--}}
                {{--                        </div>--}}
                {{--                        <div class="custom-control custom-radio">--}}
                {{--                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>--}}
                {{--                            <label class="custom-control-label" for="debit">Debit card</label>--}}
                {{--                        </div>--}}
                {{--                        <div class="custom-control custom-radio">--}}
                {{--                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>--}}
                {{--                            <label class="custom-control-label" for="paypal">PayPal</label>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="cc-name">Name on card</label>--}}
                {{--                            <input type="text" class="form-control" id="cc-name" placeholder="" required>--}}
                {{--                            <small class="text-muted">Full name as displayed on card</small>--}}
                {{--                            <div class="invalid-feedback">--}}
                {{--                                Name on card is required--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="cc-number">Credit card number</label>--}}
                {{--                            <input type="text" class="form-control" id="cc-number" placeholder="" required>--}}
                {{--                            <div class="invalid-feedback">--}}
                {{--                                Credit card number is required--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-3 mb-3">--}}
                {{--                            <label for="cc-expiration">Expiration</label>--}}
                {{--                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>--}}
                {{--                            <div class="invalid-feedback">--}}
                {{--                                Expiration date required--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-3 mb-3">--}}
                {{--                            <label for="cc-cvv">CVV</label>--}}
                {{--                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>--}}
                {{--                            <div class="invalid-feedback">--}}
                {{--                                Security code required--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <hr class="mb-4">--}}

            </div>
        </div>
    </div>

@endsection
