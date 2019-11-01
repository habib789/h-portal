@extends('masterpage.account')
@section('title') Update info @stop
@section('page') Account Information @stop
@section('bcumb') Update info @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('UserInfo.update', $patient->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="font-weight-bold">First name <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   name="first_name" id="first_name"
                                   value="{{ $patient->first_name }}"/>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="font-weight-bold">Last name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name" id="last_name"
                                   value="{{$patient->last_name }}"/>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="email" class="font-weight-bold">Email</label>--}}
                        {{--                            <input type="email" class="form-control @error('email') is-invalid @enderror"--}}
                        {{--                                   name="email" id="email"--}}
                        {{--                                   value="{{ old('email') }}"/>--}}
                        {{--                            @error('email')--}}
                        {{--                            <span class="invalid-feedback" role="alert">--}}
                        {{--                                                <strong>{{ $message }}</strong>--}}
                        {{--                                            </span>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="password" class="font-weight-bold">Password <span--}}
                        {{--                                    class="text-danger">*</span></label>--}}
                        {{--                            <input type="password" class="form-control @error('password') is-invalid @enderror"--}}
                        {{--                                   name="password" id="password"/>--}}
                        {{--                            @error('password')--}}
                        {{--                            <span class="invalid-feedback" role="alert">--}}
                        {{--                                <strong>{{ $message }}</strong>--}}
                        {{--                            </span>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="password_confirmation" class="font-weight-bold">Password Confirmation <span--}}
                        {{--                                    class="text-danger">*</span></label>--}}
                        {{--                            <input type="password"--}}
                        {{--                                   class="form-control @error('password_confirmation') is-invalid @enderror"--}}
                        {{--                                   name="password_confirmation" id="password_confirmation"--}}
                        {{--                                   value=""/>--}}
                        {{--                            @error('password_confirmation')--}}
                        {{--                            <span class="invalid-feedback" role="alert">--}}
                        {{--                                        <strong>{{ $message }}</strong>--}}
                        {{--                                        </span>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}
                        <div class="form-group">
                            <label for="phone" class="font-weight-bold">Phone</label><br>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">+880</span>
                                </div>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ $patient->phone }}" id="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Gender <span
                                    class="text-danger">*</span></label>
                            <select name="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                <option class="hidden" selected disabled>Select gender
                                </option>

                                <option class="text-capitalize"
                                        value="male" @if($patient->gender=='male') selected @endif>Male
                                </option>
                                <option class="text-capitalize"
                                        value="female" @if($patient->gender=='female') selected @endif>
                                    Female
                                </option>

                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="blood_group" class="font-weight-bold">Blood Group<span
                                    class="text-danger">*</span></label>
                            <select name="blood_group"
                                    class="form-control @error('blood_group') is-invalid @enderror">
                                <option class="hidden" selected disabled>Select gender
                                </option>

                                <option class="text-uppercase"
                                        value="A+" @if($patient->blood_group=='A+') selected @endif>A+
                                </option>
                                <option class="text-uppercase" value="A-"
                                        @if($patient->blood_group=='A-') selected @endif>A-
                                </option>
                                <option class="text-uppercase" value="B+"
                                        @if($patient->blood_group=='AB+') selected @endif>AB+
                                </option>
                                <option class="text-uppercase" value="B-"
                                        @if($patient->blood_group=='B-') selected @endif>B-
                                </option>
                                <option class="text-uppercase" value="O+"
                                        @if($patient->blood_group=='O+') selected @endif>O+
                                </option>
                                <option class="text-uppercase" value="O-"
                                        @if($patient->blood_group=='O-') selected @endif>O-
                                </option>
                                <option class="text-uppercase" value="AB+"
                                        @if($patient->blood_group=='AB+') selected @endif>AB+
                                </option>
                                <option class="text-uppercase" value="AB-"
                                        @if($patient->blood_group=='AB-') selected @endif>AB-
                                </option>

                            </select>
                            @error('blood_group')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth" class="font-weight-bold">Date of birth <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth"
                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                   id="date_of_birth"
                                   value="{{ date('Y-m-d', strtotime($patient->date_of_birth)) }}"/>
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Address</label><br>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id=""
                                      cols="30" rows="4">
                                {{ $patient->address }}
                            </textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button class="button btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
