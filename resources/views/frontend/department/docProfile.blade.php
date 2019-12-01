@extends('masterpage.frontend')
@section('css')

    <style>
        ul li h4 {
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
                                @if($ratingCount !==0)
                                    <li class="list-group-item">
                                        @if($rate == 1)
                                            <b>Ratings</b>
                                            <h4 class="float-right">&#9733; &#9734; &#9734; &#9734;
                                                &#9734;
                                                <p class="text-center"><small><strong>{{ $rate }}/5</strong></small></p>
                                            </h4>

                                        @elseif($rate == 2)
                                            <b>Ratings</b>
                                            <h4 class="float-right">&#9733; &#9733; &#9734; &#9734;
                                                &#9734;
                                                <p class="text-center"><small><strong>{{ $rate }}/5</strong></small></p>
                                            </h4>

                                        @elseif($rate == 3)
                                            <b>Ratings</b>
                                            <h4 class="float-right">&#9733; &#9733; &#9733; &#9734;
                                                &#9734;
                                                <p class="text-center"><small><strong>{{ $rate }}/5</strong></small></p>
                                            </h4>

                                        @elseif($rate == 4)
                                            <b>Ratings</b>
                                            <h4 class="float-right">&#9733; &#9733; &#9733; &#9733;
                                                &#9734;
                                                <p class="text-center"><small><strong>{{ $rate }}/5</strong></small></p>
                                            </h4>

                                        @elseif($rate == 5)
                                            <b>Ratings</b>
                                            <h4 class="float-right">&#9733; &#9733; &#9733; &#9733;
                                                &#9733;
                                                <p class="text-center"><small><strong>{{ $rate }}/5</strong></small></p>
                                            </h4>

                                        @elseif($rate == 0)
                                            <b>Ratings</b> <h4 class="float-right">Not rated yet</h4>
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
                        <div class="container">
                            <div class="col-md-9">
                                <h5 class="info font-weight-bold">Patient Saying </h5>
                            </div>
                            <div class="my-3">
                                <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                                    <div class="carousel-inner border border-info text-center">

                                            <div class="carousel-item active">
                                                @foreach($ratingReviews as $ratingReview)
                                                <p class="w-100">" {{ $ratingReview->review }} "</p>
                                                @endforeach
                                            </div>


                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-example-2" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon text-info" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-example-2" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

