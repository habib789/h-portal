@extends('masterpage.backend')
@section('title') Departments @stop
@section('header') Departments @stop
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add Medical Departments</h3>
                </div>

                <form role="form" action="{{ route('departments.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="department">Department Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="department"
                                   placeholder="Enter department">
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Add</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Department List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @php
                                $i=1;
                            @endphp
                            @foreach($departments as $department)
                                <td>{{$i++}}</td>
                                <td>{{ $department->name }}</td>
                                <td>
                                    {{ $department->slug }}
                                    {{--                                <div class="progress progress-xs">--}}
                                    {{--                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>--}}
                                    {{--                                </div>--}}
                                </td>
                                <td>
                                <span class="badge bg-success">
                                    {{ $department->active == 1 ? 'Active' : 'Inactive' }}
                                </span>
                                </td>
                                <td>
                                    <a class="text-info" href="{{ route('departments.update', $department->id) }}">Update</a>
                                </td>
                                <td>
                                    <a class="text-danger" href="{{ route('departments.destroy', $department->id) }}">Delete</a>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
