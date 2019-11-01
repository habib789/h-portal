@extends('masterpage.backend')
@section('title') Appointments List @stop
@section('header') Appointments List @stop
@section('bcumb') Appointments @stop
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Appointments List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Patient Name</th>
                            <th>Phone</th>
                            <th>Appointment Date</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>{{ $appointment->patient->phone }}</td>
                                <td>{{ $appointment->appointment_date->format('M,d Y') }}</td>
                                <td>{{ $appointment->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($appointment->appointment_status == 'prescribed')
                                        <span class="badge bg-success">Prescribed</span>
                                    @elseif($appointment->appointment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <a href="">Details</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>

@stop
