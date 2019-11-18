@extends('masterpage.frontend')
@section('css')
    <style>
        ul li h3{
            color: #0cb8b6;
        }
    </style>
@endsection
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
                                @if($doctor->image !== null)
                                    <img src="{{ asset('uploads/images/'. $doctor->image) }}" alt=""
                                         class="img-circle img-fluid">
                                @elseif($doctor->gender== 'male')
                                    <img src="{{ asset('img/maledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @elseif($doctor->gender=='female')
                                    <img src="{{ asset('img/femaledoc.jpg') }}" alt="" class="img-circle img-fluid">
                                @endif
                            </div>

                            <h5 class="profile-username text-center mt-2">
                                Dr. {{ $doctor->first_name.' '.$doctor->last_name }}
                            </h5>

                            <p class="text-muted text-center text-capitalize">
                                Department: <b>{{ $doctor->department->name }}</b>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Total visitor</b> <a class="float-right">1,322</a>
                                </li>
                                @if($ratingCount !==0)
                                    <li class="list-group-item">
                                        @if($rate == 1)
                                            <b>Ratings</b> <h3 class="float-right">&#9733; &#9734; &#9734; &#9734;
                                                &#9734;</h3>
                                        @elseif($rate == 2)
                                            <b>Ratings</b> <h3 class="float-right">&#9733; &#9733; &#9734; &#9734;
                                                &#9734;</h3>
                                        @elseif($rate == 3)
                                            <b>Ratings</b> <h3 class="float-right">&#9733; &#9733; &#9733; &#9734;
                                                &#9734;</h3>
                                        @elseif($rate == 4)
                                            <b>Ratings</b> <h3 class="float-right">&#9733; &#9733; &#9733; &#9733;
                                                &#9734;</h3>
                                        @elseif($rate == 5)
                                            <b>Ratings</b> <h3 class="float-right">&#9733; &#9733; &#9733; &#9733;
                                                &#9733;</h3>
                                        @elseif($rate == 0)
                                            <b>Ratings</b> <h3 class="float-right">Not rated yet</h3>
                                        @endif
                                    </li>
                                @endif
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


