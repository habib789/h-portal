@extends('masterpage.account')
@section('title') Account @stop
@section('page')<h5 class="text-info font-weight-bold">License Verify</h5>@stop
@section('bcumb') Verify @stop
@section('content')
    <div class="card">
        <div class="dashboard-context">
            <div class="d-context ml-5 py-2">
                <h3 class="font-weight-bold">Welcome</h3>
                {{--                {{ dd(auth()->user()->doctor->id) }}--}}
                @if(auth()->user()->role=='patient')
                    <span>{{ auth()->user()->patient->first_name.' '.auth()->user()->patient->last_name  }}</span>
                @elseif(auth()->user()->role=='doctor')
                    <span>Dr. {{ auth()->user()->doctor->first_name.' '.auth()->user()->doctor->last_name  }}</span>
                @endif
            </div>
        </div>
        <div class="card p-3">
            <div class="card-body">
                <h6 class="card-title">Verify your license key</h6>
                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type') }}">
                        {{ session('message') }}
                    </div>
                @endif
{{--                {{dd(auth()->user()->doctor->id)}}--}}
                <form action="{{ route('license.update', auth()->user()->doctor->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row w-50">
                        <div class="col">
                            <input type="text" name="key"
                                   class="form-control form-control-sm @error('key') is-invalid @enderror"
                                   placeholder="Enter your license key">
                            @error('key')
                            <span class="is-invalid" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <button class="button btn btn-info">Verify</button>
                </form>
            </div>
        </div>
    </div>
@stop
