@extends('masterpage.frontend')
@section('content')
    <div class="col-md-12 mx-auto pt-5">
        <div class="card col-lg-10 col-md-10 col-sm-12 mx-auto my-5">
            <div class="card-header text-right text-uppercase">
                register as <a href="{{ route('patient.register') }}">patient</a>
            </div>
            <div class="card-body">
                <h3 class="">Register as a Doctor</h3>
                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('doctor.register') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" placeholder="First Name *"
                                           value="{{ old('first_name') }}"/>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" placeholder="Last Name *"
                                           value="{{ old('last_name') }}"/>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" placeholder="Your Email *"
                                           value="{{ old('email') }}"/>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="Password *"/>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation"
                                           placeholder="Confirm Password *"
                                           value=""/>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">+880</span>
                                    </div>
                                    <input type="text" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}"
                                           placeholder="Your Phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="male" checked>
                                            <span> Male </span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="female">
                                            <span>Female </span>
                                        </label>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="graduate" class="form-control @error('graduate') is-invalid @enderror"
                                       placeholder="Graduated from*"
                                       value="{{ old('graduate') }}"/>
                                @error('graduate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="department" class="form-control @error('department') is-invalid @enderror">
                                    <option class="hidden" selected disabled>Select department
                                    </option>
                                    <option value="Ortho">Orthopedics</option>
                                </select>
                                @error('department')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <select name="experience" class="form-control @error('experience') is-invalid @enderror">
                                    <option class="hidden" selected disabled>Your experience level
                                    </option>
                                    <option value="2">More than 2 years</option>
                                    <option value="5">More than 5 years</option>
                                    <option value="10">More than 10 years</option>
                                </select>
                                @error('experience')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="degrees" class="form-control @error('degrees') is-invalid @enderror"
                                       placeholder="Enter degrees you have achieved*"
                                       value="{{ old('degrees') }}"/>
                                @error('degrees')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="age" class="form-control @error('age') is-invalid @enderror"
                                       placeholder="Age*"
                                       value="{{ old('age') }}"/>
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="role" value="doctor" id="">
                            <input type="submit" class="btn btn-info btn-block text-light" value="Register"/>
                        </div>
                    </div>
                </form>
                <div class="card-footer text-right">
                    <p>Already have an account?<a class="reg" href="{{ route('auth.login') }}">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


@stop
