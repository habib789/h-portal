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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if($doctor->license == 'pending' && $doctor->verify == 'not-verified')
                        <h6 class="card-title">Please verify your license key</h6>
                        {{--{{dd(auth()->user()->doctor->id)}}--}}
                        <form action="{{ route('licenseKey.update', auth()->user()->doctor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" name="key" value="{{ old('key') }}"
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
                            <button class="button btn btn-info">Update License</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
