@extends('masterpage.account')
@section('title') Account information @stop
@section('page')<h5 class="text-info font-weight-bold">Account Information</h5>@stop
@section('bcumb') Account information @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card p-2">
                <table class="table table-sm table-hover">
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
                            <td class="font-weight-bold">License Key</td>
                            <td>{{ $doctor->license }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td class="font-weight-bold">Verification</td>
                        @if($doctor->verify=='not-verified')
                            <td><span class="badge bg-warning">{{ $doctor->verify }}</span></td>
                        @elseif($doctor->verify=='verified')
                            <td>
                            <span class="badge bg-success text-light">
                                {{ $doctor->verify }}
                            </span>
                            </td>
                        @elseif($doctor->verify=='invalid-license')
                            <td>
                            <span class="badge bg-danger text-light">
                                {{ $doctor->verify }}
                            </span>
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
                    <tr>
                        <td class="font-weight-bold">Date of Birth</td>
                        <td>{{ $doctor->age }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href="{{ route('info.show', $doctor->id) }}"
                               class="button btn btn-info btn-sm btn-block">Update Info</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @if($doctor->license == null && $doctor->verify == 'not-verified')
                        <h6 class="card-title">Please verify your license key</h6>
                        {{--{{dd(auth()->user()->doctor->id)}}--}}
                        <form action="{{ route('license.update', auth()->user()->doctor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" name="key"
                                           class="form-control form-control-sm @error('key') is-invalid @enderror"
                                           placeholder="Enter your license key">
                                    @error('key')
                                    <span class="is-invalid" role="alert">
                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                            </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <button class="button btn btn-info">Verify</button>
                        </form>
                    @elseif($doctor->verify == 'invalid-license')
                        <p>Your have entered wrong license key or invalid license. To verify yourself, please enter the
                            right license key in order to provide your services. </p>
                        <a class="text-info" href="{{ route('licenseForm.update') }}">Update License</a>
                    @elseif($doctor->license !== null && $doctor->verify == 'invalid-license')
                        <p>Your have entered wrong license key or invalid license. To verify yourself, please enter the
                            right license key in order to provide your services. </p>
                    @elseif($doctor->license !== null && $doctor->verify == 'not-verified')
                        <p>Your account is under investigation. You will be notified withing 24 hours about successful verification</p>
                    @else
                        <h6 class="card-title">Notice</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
