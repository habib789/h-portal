@extends('masterpage.backend')
@section('title') Doctors List @stop
@section('header') Doctors List @stop
@section('bcumb') Doctor @stop
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Doctors List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Graduated From</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($doctors as $doctor)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $doctor->first_name.' '. $doctor->last_name }}</td>
                                <td>{{ $doctor->phone }}</td>
                                <td>{{ $doctor->graduate }}</td>
                                <td>
                                    @if($doctor->verify == 'verified')
                                        <span class="badge bg-success">Verified</span>
                                    @elseif($doctor->verify == 'not-verified')
                                        <span class="badge bg-warning">Not-verified</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <a href="{{ route('doctors.show', $doctor->id)}}">Details</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
