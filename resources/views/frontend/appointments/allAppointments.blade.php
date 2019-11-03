@extends('masterpage.account')
@section('title') Appointments @stop
@section('page') Appointments @stop
@section('bcumb') Appointments @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                @if(count($Appointments) > 0)
                    <table class="table table-sm table-hover">
                        <tr class="font-weight-bold">
                            <td>Patient Name</td>
                            <td>Appointment Date</td>
                            <td>Preferred Time</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        @foreach($Appointments as $appointment)
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
                                    <a href="{{ route('all.AppointmentsDetails', $appointment->patient->id) }}">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div class="p-5">
                        <p class="alert alert-info">There are no appointments.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop



