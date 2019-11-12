@extends('masterpage.account')
@section('title') My Appointments @stop
@section('page') My Appointments @stop
@section('bcumb') My Appointments @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                @if(count($appointments) > 0)
                    <table class="table table-sm table-hover">
                        <tr class="font-weight-bold">
                            <td>Patient Name</td>
                            <td>Doctor Name</td>
                            <td>Doctor Department</td>
                            <td>Appointment Date</td>
                            <td>Preferred Time</td>
                            <td>Appointment Created</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>Dr. {{ $appointment->doctor->first_name}}</td>
                                <td class="text-capitalize">{{ $appointment->department->name}}</td>
                                <td>{{ $appointment->appointment_date->format('M,d Y') }}</td>
                                <td>{{ date('h:i A',$appointment->appointment_time) }}</td>
                                <td>{{ $appointment->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($appointment->appointment_status == 'prescribed')
                                        <span class="badge bg-success text-white">Prescribed</span>
                                    @elseif($appointment->appointment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                @if($appointment->appointment_status == 'prescribed')
                                    <td>
                                        <a href="{{ route('myMediRecords', $appointment->id) }}">Prescription</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div class="alert alert-info">
                        You dont make any appointment yet!!
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop



