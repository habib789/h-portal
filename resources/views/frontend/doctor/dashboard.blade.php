@extends('masterpage.account')
@section('title') Account @stop
@section('page') Dashboard @stop
@section('bcumb') Dashboard @stop
@section('content')
    <div class="card">
        @if(auth()->user()->role=='doctor')
            <div class="dashboard-context">
                <div class="d-context ml-5 py-2">
                    <h3 class="font-weight-bold">Welcome</h3>
                    <span> Dr. {{ auth()->user()->doctor->first_name.' '.auth()->user()->doctor->last_name  }}</span>
                </div>
            </div>
        @endif
    </div>
@stop
