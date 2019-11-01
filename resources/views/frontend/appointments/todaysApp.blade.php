@extends('masterpage.account')
@section('title') Today's Appointments @stop
@section('page') Today's Appointments @stop
@section('bcumb') Today's Appointments @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                @if(count($todayAppointments) > 0)
                    <table class="table table-sm table-hover">
                        <tr class="font-weight-bold">
                            <td>Patient Name</td>
                            <td>Appointment Date</td>
                            <td>Preferred Time</td>
                            <td>Action</td>
                        </tr>
                        @foreach($todayAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>{{ $appointment->appointment_date->format('M,d Y') }}</td>
                                <td>{{ date('h:i A',$appointment->appointment_time) }}</td>
                                <td>
                                    @if($appointment->appointment_status == 'prescribed')
                                        <span class="badge bg-success">Prescribed</span>
                                    @elseif($appointment->appointment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('details.Appointments', $appointment->patient->id) }}">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div class="p-5">
                        <p class="alert alert-info">!!Just relax!! There are no appointments today.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop



