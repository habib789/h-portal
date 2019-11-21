@extends('masterpage.frontend')
@section('css')
    <style>
        .card {
            padding-top: 20px;
            margin: 10px 0 20px 0;
            background-color: rgba(214, 224, 226, 0.2);
            border-top-width: 0;
            border-bottom-width: 2px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card .card-heading {
            padding: 0 20px;
            margin: 0;
        }

        .card .card-heading.simple {
            font-size: 20px;
            font-weight: 300;
            color: #777;
            border-bottom: 1px solid #e5e5e5;
        }

        .card .card-heading.image img {
            display: inline-block;
            width: 46px;
            height: 46px;
            margin-right: 15px;
            vertical-align: top;
            border: 0;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .card .card-heading.image .card-heading-header {
            display: inline-block;
            vertical-align: top;
        }

        .card .card-heading.image .card-heading-header h3 {
            margin: 0;
            font-size: 14px;
            line-height: 16px;
            color: #262626;
        }

        .card .card-heading.image .card-heading-header span {
            font-size: 12px;
            color: #999999;
        }

        .card .card-body {
            padding: 0 20px;
            margin-top: 20px;
        }

        .card .card-media {
            padding: 0 20px;
            margin: 0 -14px;
        }

        .card .card-media img {
            max-width: 100%;
            max-height: 100%;
        }

        .card .card-actions {
            min-height: 30px;
            padding: 0 20px 20px 20px;
            margin: 20px 0 0 0;
        }

        .card .card-comments {
            padding: 20px;
            margin: 0;
            background-color: #f8f8f8;
        }

        .card .card-comments .comments-collapse-toggle {
            padding: 0;
            margin: 0 20px 12px 20px;
        }

        .card .card-comments .comments-collapse-toggle a,
        .card .card-comments .comments-collapse-toggle span {
            padding-right: 5px;
            overflow: hidden;
            font-size: 12px;
            color: #999;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-comments .media-heading {
            font-size: 13px;
            font-weight: bold;
        }

        .card.people {
            position: relative;
            display: inline-block;
            width: 170px;
            height: 300px;
            padding-top: 0;
            margin-left: 20px;
            overflow: hidden;
            vertical-align: top;
        }

        .card.people:first-child {
            margin-left: 0;
        }

        .card.people .card-top {
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            width: 170px;
            height: 150px;
            background-color: #ffffff;
        }

        .card.people .card-top.green {
            background-color: #53a93f;
        }

        .card.people .card-top.blue {
            background-color: #427fed;
        }

        .card.people .card-info {
            position: absolute;
            top: 150px;
            display: inline-block;
            width: 100%;
            height: 101px;
            overflow: hidden;
            background: #ffffff;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card.people .card-info .title {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 16px;
            font-weight: bold;
            line-height: 18px;
            color: #404040;
        }

        .card.people .card-info .desc {
            display: block;
            margin: 8px 14px 0 14px;
            overflow: hidden;
            font-size: 12px;
            line-height: 16px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .card.people .card-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            display: inline-block;
            width: 100%;
            padding: 10px 20px;
            line-height: 29px;
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card.hovercard {
            position: relative;
            padding-top: 0;
            overflow: hidden;
            text-align: center;
            background-color: rgba(214, 224, 226, 0.2);
        }

        .card.hovercard .cardheader {
            background-color: #0cb8b6;
            background-size: cover;
            height: 135px;
        }

        .card.hovercard .avatar {
            position: relative;
            top: -50px;
            margin-bottom: -50px;
        }

        .card.hovercard .avatar img {
            width: 100px;
            height: 100px;
            max-width: 100px;
            max-height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(255, 255, 255, 0.5);
        }

        .card.hovercard .info {
            padding: 4px 8px 10px;
        }

        .card.hovercard .info .title {
            margin-bottom: 4px;
            font-size: 24px;
            line-height: 1;
            color: #262626;
            vertical-align: middle;
        }

        .card.hovercard .info .desc {
            overflow: hidden;
            font-size: 12px;
            line-height: 20px;
            color: #737373;
            text-overflow: ellipsis;
        }

        .card.hovercard .bottom {
            padding: 0 20px;
            margin-bottom: 17px;
        }

        .btn {
            border-radius: 50%;
            width: 32px;
            height: 32px;
            line-height: 18px;
        }

    </style>
@stop
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

    <div class="row">
        @foreach($doctors as $doctor)
            <div class="col-lg-4 col-sm-6">

                <div class="card hovercard">
                    <div class="cardheader">

                    </div>
                    <div class="avatar">
                        @if($doctor->image !== null)
                            <img src="{{ asset('uploads/images/'. $doctor->image) }}" alt=""
                                 class="img-circle img-fluid">
                        @elseif($doctor->gender== 'male')
                            <img src="{{ asset('img/maledoc.jpg') }}" alt="" class="img-circle img-fluid">
                        @elseif($doctor->gender=='female')
                            <img src="{{ asset('img/femaledoc.jpg') }}" alt="" class="img-circle img-fluid">
                        @endif
                    </div>
                    <div class="info">
                        <div class="title">
                            <a href="{{ route('DocProfile.show', $doctor->id) }}">Dr. {{ $doctor->first_name }}</a>
                        </div>
                        <div class="desc text-capitalize"><span><b>Department</b></span> {{ $doctor->department->name }}
                        </div>
                        <div class="desc"><span><b>Experience</b></span> {{ $doctor->experience }} Years of experiences
                        </div>
                        <div class="desc"><span><b>Email</b></span> {{ $doctor->user->email }}</div>
                        <div class="desc"><span><b>Phone</b></span> {{ $doctor->phone }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $doctors->links() }}
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


