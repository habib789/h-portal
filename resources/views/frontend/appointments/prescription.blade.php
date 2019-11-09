@extends('masterpage.account')
@section('title') Medication @stop
@section('page') Medication @stop
@section('bcumb') Medication @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <div class="card-header">
                    <i class="fas fa-capsules fa-3x" style="color: #0cb8b6;"></i>
                    Prescription From
                </div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="patient_name" class="font-weight-bold">First name <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('patient_name') is-invalid @enderror"
                                           name="patient_name" id="first_name"
                                           value="{{ old('patient_name') }}"/>
                                    @error('patient_name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="test" class="font-weight-bold">Medical Test<span
                                            class="text-muted">(Optional)</span></label><br>
                                    <small class="text-muted">Write some medical test if needed</small>
                                    <textarea class="form-control text-left" name="test" id="medication" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="medication" class="font-weight-bold">Medication Details <span
                                            class="text-danger">*</span></label><br>
                                    <small class="text-muted">Please type in your medication along with prescribed dosage information.</small>
                                    <textarea class="form-control text-left" name="medication" id="medication" placeholder="Example-Medicine name/1+0+1/after or before meal" rows="4"></textarea>
                                    @error('medication')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <button class="button btn btn-info">Prescribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop



