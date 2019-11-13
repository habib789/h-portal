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
                    <form action="{{ route('prescription.update',$patientReport->appointment_id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="test" class="font-weight-bold">Medical Test</label> <span><small>(Optional)</small></span><br>
                                    <textarea class="form-control @error('test') is-invalid @enderror text-left" name="test" id="test" placeholder="Write some medical tests if needed." rows="4">
                                        @if($patientReport->test !=="")
                                            {{ $patientReport->test }}
                                        @endif
                                    </textarea>
                                    @error('test')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="medication" class="font-weight-bold">Medication Details</label><br>
                                    <small class="text-muted">Please type in your medication along with prescribed dosage information.</small>
                                    <textarea class="form-control @error('medication') is-invalid @enderror text-left" name="medication" id="medication" placeholder="Example-Medicine name/1+0+1/after or before meal" rows="4">
                                        @if($patientReport->medication !=="")
                                            {{ $patientReport->medication }}
                                        @endif
                                    </textarea>
                                    @error('medication')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="font-weight-bold">Notes<span
                                            class="text-danger">*</span></label><br>
                                    <textarea class="form-control @error('notes') is-invalid @enderror text-left" name="notes" id="notes" placeholder="Write notes" rows="4">
                                        @if($patientReport->notes !=="")
                                            {{ $patientReport->notes }}
                                        @endif
                                    </textarea>
                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button class="button btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop



