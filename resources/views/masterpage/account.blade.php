<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Health Portal')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

@include('partial.nav')

<!--Cover-->
@yield('cover')
{{--main-container--}}
<div class="container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="ml-auto">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('myProfile') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('bcumb')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row mt-3">
        <div class="col-md-3">
            @includeWhen($sidebar,'partial.accountSidebar')
        </div>
        <div class="col-md-9">
            <h5 class="info font-weight-bold">@yield('page')</h5>
            @yield('content')
        </div>
    </div>
</div>

{{--<div class="container my-5">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-6 col-sm-12 col-lg-4 my-3">--}}
{{--            <div class="foodcart">--}}
{{--                <div class="imgbox"><img class='img-fluid' src='img/bb.jpg'></div>--}}
{{--                <div class="details">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="display-3"><sup>Taka</sup>100</h2>--}}
{{--                        <p class="lead">Burger</p>--}}
{{--                        <span>Quantity :</span><select name="quantity"--}}
{{--                                                       class="custom-select w-25 custom-select-sm bg-dark text-light">--}}
{{--                            <option value="1">One</option>--}}
{{--                            <option value="2">Two</option>--}}
{{--                            <option value="3">Three</option>--}}
{{--                            <option value="4">Four</option>--}}
{{--                            <option value="5">Five</option>--}}
{{--                            <option value="6">Six</option>--}}
{{--                            <option value="7">Seven</option>--}}
{{--                            <option value="8">Eight</option>--}}
{{--                            <option value="9">Nine</option>--}}
{{--                            <option value="10">Ten</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<!--	About-->--}}
{{--<div class="parallax-window" id="ab" data-parallax="scroll" data-image-src="img/slider3.jpg">--}}
{{--    <div id="worked-with" class="mt-5 pt-5">--}}
{{--        <h1 class="text-uppercase">About</h1>--}}
{{--        <div class="divider"></div>--}}
{{--    </div>--}}
{{--    <div class="container w-75">--}}
{{--        <q class="lead text-center text-light quote">--}}
{{--            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis fugit temporibus dolores blanditiis--}}
{{--            accusamus nulla hic perferendis veritatis voluptatum consequatur minus quasi consequuntur, repudiandae--}}
{{--            necessitatibus praesentium non facere asperiores culpa.--}}
{{--        </q>--}}
{{--    </div>--}}
{{--</div>--}}

{{--blog--}}
@yield('blog')
<!-- contact -->
@yield('contact')
{{--footer--}}
@include('partial.footer')

<script src="{{ mix('js/app.js') }}"></script>
<script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
<script>
    $(window).on('scroll', function () {
        if ($(window).scrollTop()) {
            $('nav').addClass('black');
        } else {
            $('nav').removeClass('black');
        }
    })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('js/parallax.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll-master/jquery.nicescroll.min.js') }}"></script>
<script>
    $(function () {
        $("body").niceScroll({
            cursorcolor: "#1dd1a1",
            cursorborder: 0,
            cursorwidth: "8px",
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.navbar .dmenu').hover(function () {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });
    });
</script>
@include('sweetalert::alert')

</body>
</html>
