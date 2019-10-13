@extends('masterpage.account')
@section('title') Account @stop
@section('page')<h5 class="text-info font-weight-bold">Dashboard</h5>@stop
@section('bcumb') Dashboard @stop
@section('content')
    <div class="card">
        <div class="dashboard-context">
           <div class="d-context ml-5 py-2">
               <h3 class="font-weight-bold">Welcome</h3>
               @if(auth()->user()->role=='patient')
                   <span>{{ auth()->user()->patient->first_name.' '.auth()->user()->patient->last_name  }}</span>
               @elseif(auth()->user()->role=='doctor')
                   <span>{{ auth()->user()->doctor->first_name.' '.auth()->user()->patient->last_name  }}</span>
               @endif
           </div>
        </div>
    </div>
@stop
