@extends('masterpage.account')
@section('title') Account @stop
@section('page') Dashboard @stop
@section('bcumb') Dashboard @stop
@section('content')
    <div class="card">
        @if(auth()->user()->role=='patient')
            <div class="dashboard-context">
                <div class="d-context ml-5 py-2">
                    <h3 class="font-weight-bold">Welcome</h3>
                    <span>{{ auth()->user()->patient->first_name.' '.auth()->user()->patient->last_name  }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div style="max-height: 150px; max-width: 105px;" class="mx-auto">
                                @if(auth()->user()->patient->image!==null)
                                    <img src="{{ asset('uploads/images/'. $patient->image) }}" alt=""
                                         class="img-circle img-fluid">
                                @elseif(auth()->user()->patient->gender=='female' && auth()->user()->patient->image=="")
                                    <img src="{{ asset('img/femaledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @elseif(auth()->user()->patient->gender == 'male' && auth()->user()->patient->image=="")
                                    <img src="{{ asset('img/maledoc.jpg') }}" alt="error"
                                         class="img-circle img-fluid">
                                @endif
                                <div class="my-2">
                                    <a href="{{ route('uploadPatientPhoto') }}"
                                       class="button btn btn-info btn-sm text-capitalize px-2">Upload Photo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
