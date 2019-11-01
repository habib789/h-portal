@extends('masterpage.frontend')
@section('content')
    {{--    <div class="card col-md-4 my-5">--}}
    {{--        <div class="card-header bg-info">--}}
    {{--            <h4>Terms and Condition</h4>--}}
    {{--        </div>--}}
    {{--        <div class="card-body">--}}
    {{--            <p>--}}
    {{--                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus--}}
    {{--                alias asperiores autem consequuntur deleniti dolor est illo labore--}}
    {{--                laborum libero magni molestias placeat possimus quia quibusdam ratione--}}
    {{--                recusandae unde, veniam!--}}
    {{--            </p>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="card col-lg-10 col-md-10 col-sm-12 mx-auto my-5">
        <div class="card-header text-right text-uppercase">
            register as <a href="{{ route('patient.register') }}">patient</a>
        </div>
        <div class="card-body">
            <h3 class="text-center mb-3">Register as a Doctor</h3>
            @if(session()->has('message'))
                <div class="alert alert-{{ session('type') }}">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('doctor.register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="font-weight-bold">First name <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   name="first_name" id="first_name"
                                   value="{{ old('first_name') }}"/>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="font-weight-bold">Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name" id="last_name"
                                   value="{{ old('last_name') }}"/>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" id="email"
                                   value="{{ old('email') }}"/>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password"/>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="font-weight-bold">Password Confirmation <span
                                    class="text-danger">*</span></label>
                            <input type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation" id="password_confirmation"
                                   value=""/>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="font-weight-bold">Phone <span class="text-danger">*</span></label><br>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">+880</span>
                                </div>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}" id="phone">
                            </div>
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
                            <label for="graduate" class="font-weight-bold">Graduate From <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="graduate"
                                   class="form-control @error('graduate') is-invalid @enderror"
                                   id="graduate"
                                   value="{{ old('graduate') }}"/>
                            @error('graduate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Select a department <span
                                    class="text-danger">*</span></label>
                            <select name="department"
                                    class="form-control @error('department') is-invalid @enderror">
                                <option class="hidden" selected disabled>Select department
                                </option>
                                @foreach($departments as $department)
                                    <option class="text-capitalize"
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Enter your experience <span
                                    class="text-danger">*</span></label>
                            <select name="experience"
                                    class="form-control @error('experience') is-invalid @enderror">
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
                            <label for="degrees" class="font-weight-bold">Degrees <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="degrees"
                                   class="form-control @error('degrees') is-invalid @enderror"
                                   id="degrees"
                                   value="{{ old('degrees') }}"/>
                            @error('degrees')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth" class="font-weight-bold">Date of birth <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                   id="date_of_birth"
                                   value="{{ old('date_of_birth') }}"/>
                            <small class="text-muted">Minimum require age 25</small>
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Upload license paper or CV <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="paper" class="form-control @error('paper') is-invalid @enderror"
                                   value="{{ old('paper') }}"/>
                            @error('paper')
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

@stop
