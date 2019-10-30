@extends('masterpage.frontend')
@section('title')
    Checkout
@stop
@section('css')
    <style>
        /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            width: 100%;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
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
                <form class="needs-validation" action="{{ route('checkout') }}" method="post" id="payment-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_name">Customer name</label>
                            <input type="text" name="customer_name"
                                   class="form-control @error('customer_name') is-invalid @enderror"
                                   id="customer_name"
                                   value="{{ auth()->user()->patient->first_name .' '.auth()->user()->patient->last_name}}">
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


                    <h4 class="mb-3">Payment</h4>
{{--                    <div class="d-block my-3">--}}
{{--                        <div class="custom-control custom-radio">--}}
{{--                            <input id="online" name="payment" type="radio" value="online"--}}
{{--                                   class="custom-control-input"--}}
{{--                                   checked--}}
{{--                                   required>--}}
{{--                            <label class="custom-control-label" for="online">Pay Online</label>--}}
{{--                        </div>--}}

{{--                        <div class="custom-control custom-radio">--}}
{{--                            <input id="cash" name="payment" type="radio" value="cash-in-delivery"--}}
{{--                                   class="custom-control-input" required>--}}
{{--                            <label class="custom-control-label" for="cash">Cash in delivery</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <script src="https://js.stripe.com/v3/"></script>
                    <div id="show">
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <button class="button btn btn-info btn-block my-3">Proceed to checkout</button>
                </form>
                <hr class="mb-4">
            </div>
        </div>
    </div>

@stop


@section('js')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#cash').click(function () {--}}
{{--                $('#show').css('display','none');--}}
{{--            });--}}
{{--            $('#online').click(function () {--}}
{{--                $('#show').css('display','block');--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}


    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_KVy08f3dhKSS7I7wvjD0BQHf003s3ZiB2F');

        // Create an instance of Elements.
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@stop
