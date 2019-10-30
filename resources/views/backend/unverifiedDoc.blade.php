@extends('masterpage.backend')
@section('title') Doctors List @stop
@section('header') Doctors Verify List @stop
@section('bcumb') Doctor @stop
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Unverified doctors List</h3>
                </div>
                <div class="card-body p-0">
                    @if(count($doctors) > 0)
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Graduated From</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Send Mail</th>
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
                                    @if($doctor->verify == 'not-verified')
                                        <span class="badge bg-warning">Not-verified</span>
                                    @elseif($doctor->verify == 'invalid-license')
                                        <span class="badge bg-danger">Invalid License</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <a href="{{ route('doctors.show', $doctor->id)}}">Check</a>
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('unverified.notify',$doctor->id) }}"><i class="far fa-envelope text-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @else
                        <div class="alert alert-info">
                            Currently, there are no unverified doctors.
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>

@stop
