@extends('masterpage.backend')
@section('title') Departments-update @stop
@section('header') Update Departments @stop
@section('bcumb') Departments @stop
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update Department</h3>
                </div>

                <form role="form" action="{{ route('departments.update', $dept->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="department">Department Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="department" value="{{ $dept->name }}"
                                   placeholder="Enter department name">
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                <option class="hidden" selected disabled>Active Status</option>
                                <option value="1" @if($dept->active == 1) selected @endif>Active</option>
                                <option value="0" @if($dept->active == 0) selected @endif>Inactive</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
