@extends('masterpage.frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
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
        <h1 class="font-weight-bold">Appointment</h1>
    </div>
@stop

@section('content')
    <h2 class="text-uppercase font-weight-bold mt-5">make an appointment now</h2>
    <div class="row my-2">
        <div class="card col-md-6">
            <div class="card-body">
                <form action="{{ route('appointment',$slot->id) }}" method="post"  id="payment-form">
                    @csrf
                    <div class="form-group">
                        <label for="patient_name" class="font-weight-bold">Patient Name<span
                                class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('patient_name') is-invalid @enderror"
                               name="patient_name" id="patient_name"
                               value="{{ $patient->first_name.' '.$patient->last_name }}"/>
                        @error('patient_name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="doctor_name" class="font-weight-bold">Doctor Name<span
                                class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('doctor_name') is-invalid @enderror"
                               name="doctor_name" id="doctor_name"
                               value="Dr. {{ $slot->doctor->first_name.' '.$slot->doctor->last_name }}" readonly/>
                        @error('doctor_name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="appointment_date" class="font-weight-bold">Appointment Date</label>
                        <input type="date"
                               class="form-control @error('appointment_date') is-invalid @enderror"
                               name="appointment_date" id="appointment_date"
                               value="{{ old('appointment_date') }}"/>
                        <small>Select a date within next 7 days</small>
                        @error('appointment_date')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="appointment_time" class="font-weight-bold">Appointment Time</label>
                        <input type="text" name="appointment_time" id="timepick"
                               class="appointment_time form-control @error('appointment_time') is-invalid @enderror"
                               value="{{ old('appointment_time') }}"/>
                        <small>Select time
                            between {{ date('h:i A',$slot->start_time).'-'.date('h:i A',$slot->end_time) }}</small>
                        @error('appointment_time')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="health_issue" class="font-weight-bold">Health Issue<span
                                class="text-danger">*</span></label><br>
                        <textarea class="form-control @error('health_issue') is-invalid @enderror text-left"
                                  name="health_issue" id="health_issue"
                                  placeholder="Describe your health issue in few words" rows="4"></textarea>
                        @error('health_issue')
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>

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

                    <div class="form-group">
                        <label for="appointment_fee" class="font-weight-bold">Appointment Fee</label>
                        <input type="text"
                               class="form-control @error('appointment_fee') is-invalid @enderror"
                               name="appointment_fee" id="appointment_fee"
                               value="{{ number_format('500',2) }}" readonly/>
                        @error('appointment_fee')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <input type="hidden" name="doctor_id" id="" value="{{ $slot->doctor->id }}">
                    <input type="hidden" name="department_id" id="" value="{{ $slot->doctor->department->id }}">
                    <input type="hidden" name="patient_id" id="" value="{{ $patient->id }}">
                    <input type="hidden" name="time_slot_id" id="" value="{{ $slot->id }}">
                    <button class="button btn btn-info btn-lg">BOOK APPOINTMENT</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#timepick').timepicker({
                'timeFormat': 'h:i A',
                'interval': 20,
                'scrollbar': true,
                'minTime': '8',
                'maxTime': '10:00pm',
            });
        });
    </script>

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

