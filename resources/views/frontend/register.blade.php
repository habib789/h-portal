@extends('masterpage.frontend')
@section('content')
    <div class="col-md-12 mx-auto">
        <div class="card col-lg-10 col-md-10 col-sm-12 mx-auto my-5">
            <div class="card-header text-right text-uppercase">
                register as <a href="{{ route('doctor.register') }}">doctor</a>
            </div>
            <div class="card-body">
                <h3 class="text-center">Register as a Patient</h3>
                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('patient.register') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name" class="font-weight-bold">First name <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control  @error('first_name') is-invalid @enderror"
                                       name="first_name" placeholder="First Name *" value="{{ old('first_name') }}"/>
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
                                       name="last_name" placeholder="Last Name *" value="{{ old('last_name') }}"/>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Password *" value="{{ old('password') }}"/>
                                <small>Minimum 6 characters</small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="font-weight-bold">Confirmation Password <span
                                        class="text-danger">*</span></label>
                                <input type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation"
                                       placeholder="Confirm Password *"
                                       value=""/>
                                @error('password_confirmation')
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
                                <label for="email" class="font-weight-bold">Email<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Your Email *"
                                       value="{{ old('email') }}"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="input-group form-group">
                                <label for="phone" class="font-weight-bold">Phone <span
                                        class="text-danger">*</span></label><br>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+880</span>
                                    </div>
                                    <input type="text" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}"
                                           placeholder="Your Phone">
                                </div>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="blood_group" class="font-weight-bold">Blood Group<span
                                        class="text-danger">*</span></label>
                                <select name="blood_group"
                                        class="form-control @error('blood_group') is-invalid @enderror">
                                    <option class="hidden" selected disabled>Please select your blood group
                                    </option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                @error('blood_group')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth" class="font-weight-bold">Date of Birth<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth"
                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                       placeholder="Date of Birth*"/>
                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="role" value="patient">
                            <input type="submit" class="btn btn-info btn-block text-light" value="Register"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <p>Already have an account?<a class="reg" href="{{ route('auth.login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>

@stop
