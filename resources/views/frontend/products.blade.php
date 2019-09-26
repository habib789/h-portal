@extends('masterpage.frontend')

@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Products</h1>
    </div>
@stop

@section('content')
    <div class="col-md-8 col-sm-12">
        <p class="text-muted mt-5">Showing 1-12 of 30 Products</p>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <a href="#"><img src="img/pressure.JPG" class="img-fluid" alt=""></a>
                    <div class="card-body pname">
                        <a href="#" class="text-decoration-none font-weight-bold text-dark">
                            Special Stethoscope
                        </a>
                        <br>
                        <div class="star">&#9733; &#9733; &#9733; &#9733; &#9734;</div>
                        <p>24.99$</p>
                        <button class="btn btn-sm">add to cart</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img src="img/stethescope.JPG" class="img-fluid" alt=""></a>
                    <div class="card-body pname">
                        <a href="#" class="text-decoration-none font-weight-bold text-dark">
                            Special Stethoscope
                        </a>
                        <br>
                        <div class="star">&#9733; &#9733; &#9733; &#9733; &#9734;</div>
                        <p>24.99$</p>
                        <button class="btn btn-sm">add to cart</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img src="img/bci.JPG" class="img-fluid" alt=""></a>
                    <div class="card-body pname">
                        <a href="#" class="text-decoration-none font-weight-bold text-dark">
                            Special Stethoscope
                        </a>
                        <br>
                        <div class="star">&#9733; &#9733; &#9733; &#9733; &#9734;</div>
                        <p>24.99$</p>
                        <button class="btn btn-sm">add to cart</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="#"><img src="img/pressure.JPG" class="img-fluid" alt=""></a>
                    <div class="card-body pname">
                        <a href="#" class="text-decoration-none font-weight-bold text-dark">
                            Special Stethoscope
                        </a>
                        <br>
                        <div class="star">&#9733; &#9733; &#9733; &#9733; &#9734;</div>
                        <p>24.99$</p>
                        <button class="btn btn-sm">add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="text-center">
            <div class="section-title">
                <p class="text-capitalize head mt-4"><span class="head1 text-capitalize">cart</span></p>
            </div>
        </div>
        <div class="card p-2">
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
                           <small> <p class="text-muted"><span>2</span> × <span>$56</span></p></small>
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


