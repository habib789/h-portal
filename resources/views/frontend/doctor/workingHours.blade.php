@extends('masterpage.account')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
@stop
@section('title') Working Hours @stop
@section('page') Working Hours @stop
@section('bcumb') Working Hours @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-7">
            <div class="card p-2">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold" for="days">Select working day</label>
                        <select name="days"
                                class="form-control @error('days') is-invalid @enderror">
                            <option class="hidden" selected disabled>Select day
                            </option>
                            @foreach($days as $day)
                                <option class="text-capitalize" value="{{ $day->id }}">{{ $day->day_name }}</option>
                            @endforeach

                        </select>
                        @error('days')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="timepick">
                        <div class="form-group">
                            <label for="time" class="font-weight-bold">Start Time</label>
                            <input type="text" name="start_time"
                                   class="time form-control @error('start_time') is-invalid @enderror"
                                   value="{{ old('start_time') }}"/>
                            @error('start_time')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time" class="font-weight-bold">End Time</label>
                            <input type="text" name="end_time"
                                   class="time form-control @error('end_time') is-invalid @enderror"
                                   value="{{ old('end_time') }}"/>
                            @error('end_time')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <button class="button btn btn-info">Add schedule</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5><b>Working Schedule</b></h5>
                </div>
                <div class="card-body">
                    @if(count($slots) > 0)
                        <table class="table table-sm table-hover">
                            @foreach($slots as $slot)
                                <tr>
                                    <td class="font-weight-bold text-uppercase">{{ $slot->day->day_name }}</td>
                                    <td>{{ date('h:i A',$slot->start_time).' To '.date('h:i A',$slot->end_time) }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="alert alert-info">
                            Currently you dont set any working schedule. Please add your schedule and let patient allow to reach you
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop



@section('js')
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#timepick .time').timepicker({
                'timeFormat': 'h:i A',
            });
        });
    </script>
@stop
