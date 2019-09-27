@extends('masterpage.backend')
@section('title') Products @stop
@section('header') Products @stop
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add products</h3>
                </div>

                <form role="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                            <div class="form-group">
                                <label for="cat">Select product category</label>
                                <select name="category_id" id="cat"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                    <option class="hidden" selected disabled>Select category</option>
                                    @foreach($categories as $category)
                                        <option class="text-capitalize" value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <div class="form-group">
                            <label for="Product">Product Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="Product"
                                   placeholder="Enter product name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="text" name="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   id="price"
                                   placeholder="Enter product price" value="{{ old('price') }}">
                            @error('price')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                            <input type="text" name="quantity"
                                   class="form-control @error('quantity') is-invalid @enderror"
                                   id="quantity"
                                   placeholder="Enter product quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">Product Type</label>
                            <input type="text" name="type"
                                   class="form-control @error('type') is-invalid @enderror"
                                   id="type"
                                   placeholder="Enter product type" value="{{ old('type') }}">
                            @error('type')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo">Product Photo</label>
                            <input type="file" name="photo"
                                   class="form-control @error('photo') is-invalid @enderror"
                                   id="photo"
                                   placeholder="Enter product photo" value="{{ old('photo') }}">
                            @error('photo')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-block">Add</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Slug</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($products as $product)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->type }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>
                                    {{ $product->slug }}
                                    {{--                                <div class="progress progress-xs">--}}
                                    {{--                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>--}}
                                    {{--                                </div>--}}
                                </td>
                                <td>
                                <span class="badge bg-success">
                                    {{ $product->active == 1 ? 'Active' : 'Inactive' }}
                                </span>
                                </td>
                                <td>
                                    <a class="text-info" href="{{ route('products.update', $product->id) }}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger" href="{{ route('products.destroy', $product->id) }}">
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
