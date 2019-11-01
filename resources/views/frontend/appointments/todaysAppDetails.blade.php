@extends('masterpage.account')
@section('title') Patient Details @stop
@section('page') Patient Details @stop
@section('bcumb') Patient Details @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                @foreach($patient_details as $patient_detail)
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Name</small>
                        <p>{{ $patient_detail->patient_name }}</p>
                    </div>
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Age</small>
                        <p>{{ date('Y',strtotime(today())) - date('Y',strtotime($patient_detail->patient->date_of_birth)) }} years old</p>
                    </div>
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Blood Group</small>
                        <p>{{ $patient_detail->patient->blood_group }}</p>
                    </div>
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Health Issue</small>
                        <p>{{ $patient_detail->health_issue }}</p>
                    </div>
                @endforeach
                    <a class="button btn btn-info" href="">Prescribe</a>
            </div>
        </div>
    </div>
@stop



