@extends('masterpage.account')
@section('title') Prescription @stop
@section('page') Prescription Form @stop
@section('bcumb') Prescription @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <div class="card-body">
                    <form action="">

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop



