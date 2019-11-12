@extends('masterpage.frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
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
                <form action="{{ route('appointment',$slot->id) }}" method="post">
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
@stop

