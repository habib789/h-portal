@extends('masterpage.frontend')
@section('title')
    Product Details
@stop
@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Product Details</h1>
    </div>
@stop


@section('content')
    <div class="col-md-2 mt-5">
        <div class='categories'>
            <p class="font-weight-bold text-uppercase">Browse Categories</p>
            @foreach($categories as $category)
                <a class="" href="">
                    <div class="text-capitalize">
                        <i class="fa fa-chevron-right"></i> &nbsp;{{ $category->name }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-7 col-sm-12">
        <p class="text-muted mt-5">Showing 1-12 of 30 Products</p>
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 card-fig">
                        <figure class="figure">
                            <div class="fig-img">
                                <img src="{{ asset('uploads/images/'.$product->photo) }}"
                                     class="figure-img img-fluid rounded" alt="...">
                            </div>
                            <figcaption class="figure-caption text-capitalize font-weight-bold text-center">
                                <a href="">
                                    {{ $product->name }}
                                </a>
                                <small>{{ $product->type }}</small>
                                <p> BDT {{ number_format($product->price,2) }}</p>
                            </figcaption>
                            <button class="btn btn-sm btn-block">add to cart</button>
                        </figure>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>

    <div class="col-md-3 col-sm-12">
        <div class="text-center">
            <div class="section-title">
                <p class="text-capitalize head mt-4"><span class="head1 text-capitalize">cart</span></p>
            </div>
        </div>
        <div class="card p-2 border border-info">
            <table class="table cart">
                <tbody>
                <tr>
                    <td width="100px">
                        <img class="img-fluid" src="img/avatar3.png" height="100%" width="100%" alt="">
                    </td>
                    <td>
                        <p>Name</p>
                        <p class="text-muted"><span>2</span> × <span>$56</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class="img-fluid" src="img/cover.png" height="100%" width="100%" alt="">
                    </td>
                    <td>
                        <div class="text-left">
                            <p class="font-weight-bold">Name</p>
                            <small><p class="text-muted"><span>2</span> × <span>$56</span></p></small>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="divider"></div>
            <div class="clearfix">
                <p class="font-weight-bold float-left">Subtotal</p>
                <p class="text-muted float-right">BDT 200.00</p>
            </div>
            <div class="info clearfix">
                <button type="submit" class="btn btn-info text-white float-left">View Cart</button>
                <button type="submit" class="btn btn-info text-white float-left ml-2">Checkout</button>
            </div>
        </div>
    </div>
@stop


