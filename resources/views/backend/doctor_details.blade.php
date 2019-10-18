@extends('masterpage.backend')
@section('title') Doctor Details @stop
@section('header') Doctor Details @stop
@section('bcumb') Doctor @stop
@section('content')
    @if(session()->has('message'))
        <div class="text-center alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Doctor Details</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tr>
                            <td class="font-weight-bold">Name</td>
                            <td>{{ $doctor->first_name.' '.$doctor->last_name}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Department</td>
                            <td>{{ $doctor->department->name }}</td>
                        </tr>
                        @if($doctor->address !== null)
                            <tr>
                                <td class="font-weight-bold">Address</td>
                                <td>{{ $doctor->address }}</td>
                            </tr>
                        @endif
                        @if($doctor->license !== null)
                            <tr>
                                <form action="{{ route('doctors.update',$doctor->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <td class="font-weight-bold">License Key</td>
                                    <td>
                                        {{ $doctor->license }}
                                        <input type="hidden" name="license_key" VALUE="{{ $doctor->license }}" id="">
                                        @if($doctor->verify == 'not-verified')
                                            <button class="button btn btn-info btn-sm ml-3">Match</button>
                                        @endif
                                    </td>
                                </form>
                            </tr>
                        @endif

                        <tr>
                            <td class="font-weight-bold">Verification</td>
                            @if($doctor->verify=='not-verified')
                                <td><span class="badge bg-warning">{{ $doctor->verify }}</span></td>
                            @else
                                <td>
                                    <span class="badge bg-success">
                                        {{ $doctor->verify }}
                                    </span>
                                    <small class="text-muted">at {{ $doctor->doclicense->updated_at->diffForHumans() }}</small>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Graduate From</td>
                            <td>{{ $doctor->graduate }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Experience</td>
                            <td>{{ $doctor->experience }} years of experience</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Degrees</td>
                            <td>{{ $doctor->degrees }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">Documents</div>
                <div class="card-body">
                    <a href="">{{ $doctor->document}}</a>
                </div>
                <button class="button btn btn-info">Download</button>
            </div>
        </div>
    </div>

@stop
