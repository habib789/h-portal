@extends('masterpage.frontend')

@section('cover')
    <div class="bg">
        <div class="bg-overly">
            <div class="bg-content bg-overlay">
                <h1 class="text-capitalize hungry">need a doctor?</h1>
                <h1 class="text-capitalize">We are ensuring the best Quality and consistency to our patient</h1>

            </div>
        </div>
    </div>
@stop



@section('content')
    <div class="text-center my-5">
        <div class="section-title mb-5">
            <h4 class="text-uppercase head">OUR <span class="head1 text-uppercase">departments</span></h4>
        </div>
    </div>

    <div class="row">
        @foreach($departments as $department)
            <div class="card-body col-md-4">
                <h5 class="info font-weight-bold text-uppercase  text-center">{{ $department->name }}</h5>
            </div>
        @endforeach
    </div>

{{--our doctors--}}
    <div class="my-5">
        <div class="section-title mb-5">
            <h4 class="text-uppercase head">OUR <span class="head1 text-uppercase">Doctors</span></h4>
        </div>
    </div>

@stop


{{--@section('blog')--}}
{{--    <div id="worked-with" class="my-5 pt-5">--}}
{{--        <h1 class="text-uppercase text-dark" id="blog">latest form our blog</h1>--}}
{{--        <div class="divider"></div>--}}
{{--    </div>--}}

{{--    <div class="container">--}}
{{--        <div class="row">--}}

{{--            <div class="col-sm-12 col-md-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <img src="img/pasta.jpg" class="img-fluid card-img-top" alt="">--}}
{{--                    <div class="card-body">--}}
{{--                        <p>9 june,2018</p>--}}
{{--                        <h5 class="lead font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo--}}
{{--                            veritatis</h5>--}}
{{--                        <p class="text-muted text-right"><i class="fas fa-comments"></i>2 comments</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-12 col-md-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <img src="img/chowmin.jpg" class="img-fluid card-img-top" alt="">--}}
{{--                    <div class="card-body">--}}
{{--                        <p>9 june,2018</p>--}}
{{--                        <h5 class="lead font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo--}}
{{--                            veritatis</h5>--}}
{{--                        <p class="text-muted text-right"><i class="fas fa-comments"></i>2 comments</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-12 col-md-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <img src="img/bb.jpg" class="img-fluid card-img-top" alt="">--}}
{{--                    <div class="card-body">--}}
{{--                        <p>9 june,2018</p>--}}
{{--                        <h5 class="lead font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo--}}
{{--                            veritatis</h5>--}}
{{--                        <p class="text-muted text-right"><i class="fas fa-comments"></i>2 comments</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-12 col-md-6 col-lg-3">--}}
{{--                <div class="card">--}}
{{--                    <img src="img/p.jpg" class="img-fluid card-img-top" alt="">--}}
{{--                    <div class="card-body">--}}
{{--                        <p>9 june,2018</p>--}}
{{--                        <h5 class="lead font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo--}}
{{--                            veritatis</h5>--}}
{{--                        <p class="text-muted text-right"><i class="fas fa-comments"></i>2 comments</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@stop--}}

{{--@section('contact')--}}
{{--    <div class="container my-5" id="contact">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="mt-2">--}}
{{--                    <h1 class="text-dark text-center text-uppercase">Contact</h1>--}}
{{--                    <div class="divider"></div>--}}
{{--                </div>--}}
{{--                <!--Location on map-->--}}
{{--                <div>--}}
{{--                    <iframe--}}
{{--                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.0685277718326!2d90.37483331416047!3d23.744935584592085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b50cdec7fb%3A0x37a7d9147ad6f505!2z4Kan4Ka-4Kao4Kau4Kao4KeN4Kah4Ka_IOCmsuCnh-CmlSDgprDgp4vgpqEsIOCmouCmvuCmleCmviAxMjA1!5e0!3m2!1sbn!2sbd!4v1530909005086"--}}
{{--                        width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <div class="col-md-6">--}}
{{--                <form action="">--}}
{{--                    <div class="form">--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="text" class="form-control form-control-lg" name="" id=""--}}
{{--                                   placeholder="Your full name">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <input type="email" class="form-control form-control-lg" name="" id=""--}}
{{--                                   placeholder="Your email">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                        <textarea name="" class="form-control" id="" cols="30" rows="10"--}}
{{--                                  placeholder="Leave your comment here..."></textarea>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-outline-info send px-5"><i--}}
{{--                                class="fab fa-telegram-plane mr-2 fa-2x"></i>SEND--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@stop--}}


