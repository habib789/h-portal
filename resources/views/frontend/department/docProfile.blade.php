@extends('masterpage.frontend')

@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Doctor Profile</h1>
    </div>
@stop

@section('content')
    <div class="row">
        @include('partial.departments')
        <div class="col-md-9">
            <div class="row mt-5">
                <div class="col-md-5">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="text-center">
                                @if($doctor->gender== 'male')
                                    <img src="{{ asset('img/maledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @elseif($doctor->gender=='female')
                                    <img src="{{ asset('img/femaledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @endif
                            </div>

                            <h5 class="profile-username text-center">
                                Dr. {{ $doctor->first_name.' '.$doctor->last_name }}
                            </h5>

                            <p class="text-muted text-center">
                                Department: <b>{{ $doctor->department->name }}</b>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Total visitor</b> <a class="float-right">1,322</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">About</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                Graduation from: {{ $doctor->graduate }}
                            </p>
                            <p>
                                Achieved Degrees: {{ $doctor->degrees }}
                            </p>

                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i>Phone</strong>
                            <p class="text-muted">{{ $doctor->phone }}</p>
                            <hr>

                            @if($doctor->address !==null)
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                <p class="text-muted">{{ $doctor->address }}</p>
                                <hr>
                            @endif

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                fermentum enim neque.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-uppercase"><b>Working Hours</b></h5>
                        </div>
                        <div class="card-body">
                            @if(count($slots)>0)
                                <table class="table table-sm table-hover">
                                    @foreach($slots as $slot)
                                        <tr>
                                            <td class="font-weight-bold text-uppercase">{{ $slot->day->day_name }}</td>
                                            <td>{{ date('h:i A', $slot->start_time).' To '.date('h:i A', $slot->end_time) }}</td>
                                            <td>
                                                {{--                                            {{ dd($slot->id) }}--}}
                                                <a href="{{ route('appointment', $slot->id) }}"
                                                   class="button btn btn-info btn-sm">
                                                    BOOK
                                                    <i class="far fa-clock"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <div class="alert alert-info">
                                    Currently the doctor dont have any working schedule
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


