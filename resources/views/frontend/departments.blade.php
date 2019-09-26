@extends('masterpage.frontend')

@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Departments</h1>
    </div>
@stop

@section('content')
    <div class="col-md-8">
        <div class="row">

        </div>
    </div>
    <div class="col-md-4 mt-5">

        <div class="text-left">
            <div class="section-title">
                <p class="text-capitalize head mt-5"><span class="head1 text-capitalize m-3">Departments</span></p>
            </div>
        </div>
        <div class="card-body">
            @foreach($departments as $department)

                <a class="text-capitalize text-decoration-none" href="">
                    <div class="dept p-2">
                        {{ $department->name }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@stop


