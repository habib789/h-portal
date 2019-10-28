@extends('masterpage.frontend')

@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Departments</h1>
    </div>
@stop

@section('content')
    <div class="row">

        @include('partial.departments')

        @foreach($doctors as $doctor)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch mt-5">
                <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                        Doctor Profile
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><strong>Dr. {{ $doctor->first_name.' '. $doctor->last_name }}</strong></h2>
                                <p class="text-muted text-sm"><b>Department: </b> {{ $doctor->department->name }} </p>
                                <p class="text-muted text-sm"><b>Experiences: </b> {{ $doctor->experience }} years of
                                    experiences</p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    @if($doctor->address !== null)
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            {{ $doctor->address }}
                                        </li>
                                    @endif
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                        Phone #: {{ $doctor->phone }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                @if($doctor->gender== 'male')
                                    <img src="{{ asset('img/maledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @elseif($doctor->gender=='female')
                                    <img src="{{ asset('img/femaledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="{{ route('DocProfile.show', $doctor->id) }}" class="button btn btn-sm btn-info">
                                <i class="fas fa-user"></i> View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop


