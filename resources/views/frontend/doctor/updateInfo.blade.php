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
            <form action="{{ route('info.update', $docInfo->id) }}" method="post">
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
                                   value="{{ $docInfo->first_name }}"/>
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
                                   value="{{$docInfo->last_name }}"/>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="font-weight-bold">Phone</label><br>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">+880</span>
                                </div>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ $docInfo->phone }}" id="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Address</label><br>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="4">
                                {{ $docInfo->address }}
                            </textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Gender <span
                                    class="text-danger">*</span></label>
                            <select name="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                <option class="hidden" selected disabled>Select gender
                                </option>

                                <option class="text-capitalize"
                                        value="male" @if($docInfo->gender=='male') selected @endif>Male
                                </option>
                                <option class="text-capitalize"
                                        value="female" @if($docInfo->gender=='female') selected @endif>
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
                            <label for="graduate" class="font-weight-bold">Graduate From <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="graduate"
                                   class="form-control @error('graduate') is-invalid @enderror"
                                   id="graduate"
                                   value="{{ $docInfo->graduate }}"/>
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
                                            value="{{ $department->id }} " @if($docInfo->department) selected @endif>{{
                                        $department->name }}
                                    </option>
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
                                <option value="2" @if($docInfo->experience) selected @endif>More than 2 years</option>
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
                                   value="{{ $docInfo->degrees }}"/>
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
                                   value="{{ date('Y-m-d', strtotime($docInfo->date_of_birth)) }}"/>
                            @error('date_of_birth')
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
