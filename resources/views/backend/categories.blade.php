@extends('masterpage.backend')
@section('title') Product Category @stop
@section('header') Product Category @stop
@section('bcumb') Product Category @stop
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add products category</h3>
                </div>

                <form role="form" action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="category"
                                   placeholder="Enter category">
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
                    <h3 class="card-title">Categories List</h3>
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

                        @php
                            $i=1;
                        @endphp
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    {{ $category->slug }}
                                    {{--                                <div class="progress progress-xs">--}}
                                    {{--                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>--}}
                                    {{--                                </div>--}}
                                </td>
                                <td>
                                <span class="badge bg-success">
                                    {{ $category->active == 1 ? 'Active' : 'Inactive' }}
                                </span>
                                </td>
                                <td>
                                    <a class="text-info" href="{{ route('categories.update', $category->id) }}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger" href="{{ route('categories.destroy', $category->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
