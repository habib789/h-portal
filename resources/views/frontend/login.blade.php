@extends('masterpage.frontend')
@section('content')
<div class="mx-auto col-lg-6 col-md-6 col-sm-12 my-5 pt-5">
    <div class="card">
        <div class="card-header">
            <h5>LOGIN TO YOUR PROFILE</h5>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('auth.login') }}" method="post">
                @csrf
                <div class="form w-75 mx-auto">
                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror"
                               type="email" name="email" placeholder="Your email"
                               autocomplete="on" autofocus="on" value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control @error('password') is-invalid @enderror"
                               type="password" name="password"
                               placeholder="Your password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group log">
                        <button type="submit" name="login"
                                class="button btn btn-info text-light send px-5">
                            <i class="fas fa-sign-in-alt mr-2 fa-2x"></i>
                            LOGIN
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right">
            <p>Dont have an account?<a class="reg"  href="{{ route('patient.register') }}">Register</a>
            </p>
        </div>
    </div>
</div>
@stop
