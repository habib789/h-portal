@extends('masterpage.account')
@section('title') Account @stop
@section('page') Dashboard @stop
@section('bcumb') Dashboard @stop
@section('content')
    @if(auth()->user()->role=='doctor')
        <div class="card">

            <div class="dashboard-context">
                <div class="d-context ml-5 py-2">
                    <h3 class="font-weight-bold">Welcome</h3>
                    <span> Dr. {{ auth()->user()->doctor->first_name.' '.auth()->user()->doctor->last_name  }}</span>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div style="max-height: 150px; max-width: 105px;">
                            @if($doc->image!==null)
                                <img src="{{ asset('uploads/images/'. $doc->image) }}" alt="" class="img-circle img-fluid">
                            @elseif(auth()->user()->doctor->gender=='female')
                                <img src="{{ asset('img/femaledoc.jpg') }}" alt="" class="img-circle img-fluid">
                            @elseif(auth()->user()->doctor->gender == 'male')
                                <img src="{{ asset('img/maledoc.jpg') }}" alt="" class="img-circle img-fluid">
                            @endif
                        </div>
                        <div class="mx-auto my-2">
                            <a href="{{ route('uploadPhoto') }}" class="button btn btn-info btn-sm text-capitalize px-3">Upload Photo</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <p>Total Appointments <span style="font-size: 18px;"
                                                        class="badge badge-secondary">{{ $total_appointment }}</span>
                            </p>
                        </div>
                        <div class="card-header">
                            <p>Successful Visits <span style="font-size: 18px;" class="badge badge-success">{{ $success_appointment }}</span>
                            </p>
                        </div>
                        <div class="card-header">
                            <p>Pending Appointments <span style="font-size: 18px;" class="badge badge-danger">{{ $pending_appointment }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
