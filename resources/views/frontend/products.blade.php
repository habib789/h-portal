@extends('masterpage.frontend')
@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Products</h1>
    </div>
@stop


@section('content')
    <div class="container">
        <div class="search-sec mt-3 w-50">
            <form action="{{ route('shop') }}" method="get" novalidate="novalidate">
                <div class="form-inline">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control search-slt"
                               placeholder="Enter medicine name">
                    </div>
                    <div class="form-group">
                        <button class="button btn btn-info wrn-btn">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-4 mt-3">
                @include('partial.category')
            </div>
            <div class="col-md-8 col-sm-12 mt-5">
                <div class="row" id="app">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100 card-fig">
                                <figure class="figure">
                                    <div class="fig-img mx-auto">
                                        <img src="{{ asset('uploads/images/'.$product->photo) }}"
                                             class="figure-img img-fluid rounded" alt="...">
                                    </div>
                                    @php
                                        $name = str_replace($searchItem,'<span style="background-color:#0cb8b6;color:white;">'.$searchItem.'</span>', $product->name);
                                    @endphp
                                    <figcaption class="figure-caption text-capitalize font-weight-bold text-center">

                                        <a href="">
                                            {!! $name !!}
                                        </a>

                                        <small>{{ $product->type }}</small>
                                        <p> BDT {{ number_format($product->price,2) }}</p>
                                    </figcaption>
                                    <form action="{{ route('cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button
                                            class="button btn btn-sm btn-block">add to cart
                                        </button>
                                    </form>
                                </figure>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $products->links() }}
            </div>


            <div class="modal" id="cart_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-uppercase">CART</h5>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        @if(!empty($cart))
                            <div class="modal-body">
                                <div class="form mx-auto">
                                    <div class="">
                                        <table class="table table-sm cart">
                                            <tbody>
                                            @foreach($cart as $productId => $product)
                                                <tr>
                                                    <td width="100px">
                                                        <img class="img-fluid"
                                                             src="{{ asset('uploads/images/'.$product['photo']) }}"
                                                             height="100%" width="100%" alt="">
                                                    </td>
                                                    <td>
                                                        <p>{{ $product['name'] }}</p>
                                                        <p class="text-muted"><span>{{ $product['quantity'] }}</span> ×
                                                            <span>{{ $product['price'] }}</span></p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="divider"></div>
                                        <div class="clearfix">
                                            <p class="font-weight-bold float-left">Subtotal</p>
                                            <p class="font-weight-bold float-right">BDT {{ number_format($subtotal,2) }}
                                                TK</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="info clearfix">
                                    <a href="{{ route('cart') }}" class="btn btn-info text-white float-left">View
                                        Cart</a>
                                    <a href="{{ route('checkout') }}" class="btn btn-info text-white float-left ml-2">Checkout</a>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-dolly fa-3x" style="color: #00c054;"></i>
                                </div>
                                <div class="alert alert-info mt-2">
                                    Your cart is empty! <br>
                                    You need to add some products First.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#cart_modal" data-toggle="modal" class="to_top">
        <span class="badge badge-dark shopping">{{ $count }}</span>
        <i class="fas fa-shopping-cart fa-2x"></i>
    </a>
@stop


{{--@section('js')--}}
{{--    <script>--}}
{{--        const app = new Vue({--}}
{{--            el: '#app',--}}
{{--            data: {--}}
{{--                cart: [],--}}
{{--                total: 0--}}
{{--            },--}}
{{--            methods: {--}}
{{--                addToCart: function (productId) {--}}
{{--                    axios.post('/cart', {--}}
{{--                        'product_id': productId--}}
{{--                    })--}}
{{--                        .then(function (response) {--}}
{{--                            console.log(response);--}}
{{--                        })--}}
{{--                        .catch(function (error) {--}}
{{--                            console.log(error);--}}
{{--                        })--}}

{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@stop--}}
