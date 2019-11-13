@extends('masterpage.account')
@section('title') Patient Details @stop
@section('page') Patient Details @stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
@stop
@section('bcumb') Patient Details @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card">

                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Name</small>
                        <p>{{ $patient_detail->patient_name }}</p>
                    </div>
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Age</small>
                        <p>{{ date('Y',strtotime(today())) - date('Y',strtotime($patient_detail->patient->date_of_birth)) }}
                            years old</p>
                    </div>
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Blood Group</small>
                        <p>{{ $patient_detail->patient->blood_group }}</p>
                    </div>
                    <div class="card-header">
                        <small class="text-capitalize font-weight-bold">Patient Health Issue</small>
                        <p>{{ $patient_detail->health_issue }}</p>
                    </div>
                <a class="button btn btn-info" href="{{ route('prescription',$patient_detail->id) }}">Prescribe</a>
            </div>
        </div>
    </div>
@stop





