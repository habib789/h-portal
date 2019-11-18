@extends('masterpage.account')
@section('title') Prescription @stop
@section('page') Prescription @stop
@section('bcumb') Prescription @stop
@section('css')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .animated {
            -webkit-transition: height 0.2s;
            -moz-transition: height 0.2s;
            transition: height 0.2s;
        }

        .stars {
            margin: 20px 0;
            font-size: 24px;
            color: #d17581;
        }
    </style>
@stop

@section('content')
    <section class="content card">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Health Portal
                                    <small
                                        class="float-right">Date: {{ $report->created_at->format('d-m-Y h:i A') }}</small>
                                </h4>
                            </div>
                        </div>

                        <div class="row invoice-info card-header">
                            <div class="col-sm-12 text-right ml-auto">
                                <span
                                    class="font-weight-bold">Dr. {{ $report->doctor->first_name.' '.$report->doctor->last_name }}</span>
                                <address>
                                    {{ $report->doctor->degrees }}<br>
                                    Phone: {{ $report->doctor->phone }}<br>
                                    Email: {{ $report->doctor->user->email }}<br>
                                </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div>
                                    <strong>Patient Name</strong>
                                    <p>{{ $report->patient_name }}</p>
                                </div>
                                <div>
                                    <strong>Patient Age</strong>
                                    <p>{{ date('Y',strtotime($report->appointment_date)) - date('Y',strtotime($report->patient->date_of_birth)) }}</p>
                                </div>
                                <div>
                                    <strong>Patient Phone</strong>
                                    <p>{{ $report->patient->phone }}</p>
                                </div>
                                <div>
                                    <strong>Patient Email</strong>
                                    <p>{{ $report->patient->user->email }}</p>
                                </div>
                                <div>
                                    <strong>Patient health issue</strong>
                                    <p>{{ $report->health_issue }}</p>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                @if($rep->test !== "")
                                    <div class="card-body">
                                        <small><strong>Tests Name</strong></small><br>
                                        <div>
                                            {{ $rep->test }}
                                        </div>
                                    </div>
                                @endif

                                @if($rep->medication !== "")
                                    <div class="card-body">
                                        <small><strong>Medication</strong></small><br>
                                        <div>
                                            {{ $rep->medication }}
                                        </div>
                                    </div>
                                @endif

                                @if($rep->notes !== "")
                                    <div class="card-body">
                                        <small><strong>Notes</strong></small><br>
                                        <div>
                                            {{ $rep->notes }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="row no-print">
                            <div class="col-12">
                                <a href="" target="" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                <a href="{{ route('electronic.prescription', $report->id) }}"
                                   class="button btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Download Prescription
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    {{--                    <div class="card border-success mb-3" style="max-width: 18rem;">--}}
                    {{--                        <div class="card-header bg-transparent border-success">Review for--}}
                    {{--                            <div class="card-body text-success">--}}
                    {{--                                <form action="{{ route('ratings') }}" method="post">--}}
                    {{--                                    <input type="hidden" name="appointment_id" value="{{ $report->id }}">--}}
                    {{--                                    @csrf--}}
                    {{--                                    <div class="rating">--}}
                    {{--                                    <span>--}}
                    {{--                                        <input type="radio" id="str5" value="5" name="rating_star">--}}
                    {{--                                        <label for="str5" class="icon-star2 text-warning has"></label>--}}
                    {{--                                    </span>--}}
                    {{--                                        <span>--}}
                    {{--                                        <input type="radio" id="str4" value="4" name="rating_star">--}}
                    {{--                                        <label for="str4" class="icon-star2 text-warning has"></label>--}}
                    {{--                                        </span>--}}
                    {{--                                        <span>--}}
                    {{--                                        <input type="radio" id="str3" value="3" name="rating_star">--}}
                    {{--                                        <label for="str3" class="icon-star2 text-warning has"></label>--}}
                    {{--                                    </span>--}}
                    {{--                                        <span>--}}
                    {{--                                        <input type="radio" id="str2" value="2" name="rating_star">--}}
                    {{--                                        <label for="str2" class="icon-star2 text-warning has"></label>--}}
                    {{--                                    </span>--}}
                    {{--                                        <span class="checked">--}}
                    {{--                                        <input type="radio" id="str1" value="1" name="rating_star">--}}
                    {{--                                        <label for="str1" class="icon-star2 text-warning has"></label>--}}
                    {{--                                    </span>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <textarea class="form-control" name="review" required></textarea>--}}
                    {{--                                    </div>--}}
                    {{--                                    <button class="btn btn-success">Submit</button>--}}
                    {{--                                </form>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="well well-sm">
                        <div class="text-right">
                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Doctor
                                Review</a>
                        </div>

                        <div class="row" id="post-review-box" style="display:none;">
                            <div class="col-md-12">
                                <form action="{{ route('ratings') }}" method="post">

                                    @csrf
                                    <input id="ratings-hidden" name="rating" type="hidden">
                                    <input type="hidden" name="appointment_id" value="{{ $report->id }}" id="">
                                    <textarea class="form-control @error('review') is-invalid @enderror animated"
                                              cols="50" id="new-review" name="review"
                                              placeholder="Enter your review here..." rows="5"></textarea>
                                    @error('review')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror

                                    <div class="text-right">
                                        <div class="stars starrr" data-rating="0"></div>
                                        <a class="btn btn-danger btn-sm" href="#" id="close-review-box">

                                            <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                        <button class="button btn btn-info btn-lg" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@stop

@section('js')
    <script>
        (function (e) {
            var t, o = {className: "autosizejs", append: "", callback: !1, resizeDelay: 10},
                i = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',
                n = ["fontFamily", "fontSize", "fontWeight", "fontStyle", "letterSpacing", "textTransform", "wordSpacing", "textIndent"],
                s = e(i).data("autosize", !0)[0];
            s.style.lineHeight = "99px", "99px" === e(s).css("lineHeight") && n.push("lineHeight"), s.style.lineHeight = "", e.fn.autosize = function (i) {
                return this.length ? (i = e.extend({}, o, i || {}), s.parentNode !== document.body && e(document.body).append(s), this.each(function () {
                    function o() {
                        var t, o;
                        "getComputedStyle" in window ? (t = window.getComputedStyle(u, null), o = u.getBoundingClientRect().width, e.each(["paddingLeft", "paddingRight", "borderLeftWidth", "borderRightWidth"], function (e, i) {
                            o -= parseInt(t[i], 10)
                        }), s.style.width = o + "px") : s.style.width = Math.max(p.width(), 0) + "px"
                    }

                    function a() {
                        var a = {};
                        if (t = u, s.className = i.className, d = parseInt(p.css("maxHeight"), 10), e.each(n, function (e, t) {
                            a[t] = p.css(t)
                        }), e(s).css(a), o(), window.chrome) {
                            var r = u.style.width;
                            u.style.width = "0px", u.offsetWidth, u.style.width = r
                        }
                    }

                    function r() {
                        var e, n;
                        t !== u ? a() : o(), s.value = u.value + i.append, s.style.overflowY = u.style.overflowY, n = parseInt(u.style.height, 10), s.scrollTop = 0, s.scrollTop = 9e4, e = s.scrollTop, d && e > d ? (u.style.overflowY = "scroll", e = d) : (u.style.overflowY = "hidden", c > e && (e = c)), e += w, n !== e && (u.style.height = e + "px", f && i.callback.call(u, u))
                    }

                    function l() {
                        clearTimeout(h), h = setTimeout(function () {
                            var e = p.width();
                            e !== g && (g = e, r())
                        }, parseInt(i.resizeDelay, 10))
                    }

                    var d, c, h, u = this, p = e(u), w = 0, f = e.isFunction(i.callback), z = {
                        height: u.style.height,
                        overflow: u.style.overflow,
                        overflowY: u.style.overflowY,
                        wordWrap: u.style.wordWrap,
                        resize: u.style.resize
                    }, g = p.width();
                    p.data("autosize") || (p.data("autosize", !0), ("border-box" === p.css("box-sizing") || "border-box" === p.css("-moz-box-sizing") || "border-box" === p.css("-webkit-box-sizing")) && (w = p.outerHeight() - p.height()), c = Math.max(parseInt(p.css("minHeight"), 10) - w || 0, p.height()), p.css({
                        overflow: "hidden",
                        overflowY: "hidden",
                        wordWrap: "break-word",
                        resize: "none" === p.css("resize") || "vertical" === p.css("resize") ? "none" : "horizontal"
                    }), "onpropertychange" in u ? "oninput" in u ? p.on("input.autosize keyup.autosize", r) : p.on("propertychange.autosize", function () {
                        "value" === event.propertyName && r()
                    }) : p.on("input.autosize", r), i.resizeDelay !== !1 && e(window).on("resize.autosize", l), p.on("autosize.resize", r), p.on("autosize.resizeIncludeStyle", function () {
                        t = null, r()
                    }), p.on("autosize.destroy", function () {
                        t = null, clearTimeout(h), e(window).off("resize", l), p.off("autosize").off(".autosize").css(z).removeData("autosize")
                    }), r())
                })) : this
            }
        })(window.jQuery || window.$);

        var __slice = [].slice;
        (function (e, t) {
            var n;
            n = function () {
                function t(t, n) {
                    var r, i, s, o = this;
                    this.options = e.extend({}, this.defaults, n);
                    this.$el = t;
                    s = this.defaults;
                    for (r in s) {
                        i = s[r];
                        if (this.$el.data(r) != null) {
                            this.options[r] = this.$el.data(r)
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on("mouseover.starrr", "span", function (e) {
                        return o.syncRating(o.$el.find("span").index(e.currentTarget) + 1)
                    });
                    this.$el.on("mouseout.starrr", function () {
                        return o.syncRating()
                    });
                    this.$el.on("click.starrr", "span", function (e) {
                        return o.setRating(o.$el.find("span").index(e.currentTarget) + 1)
                    });
                    this.$el.on("starrr:change", this.options.change)
                }

                t.prototype.defaults = {
                    rating: void 0, numStars: 5, change: function (e, t) {
                    }
                };
                t.prototype.createStars = function () {
                    var e, t, n;
                    n = [];
                    for (e = 1, t = this.options.numStars; 1 <= t ? e <= t : e >= t; 1 <= t ? e++ : e--) {
                        n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))
                    }
                    return n
                };
                t.prototype.setRating = function (e) {
                    if (this.options.rating === e) {
                        e = void 0
                    }
                    this.options.rating = e;
                    this.syncRating();
                    return this.$el.trigger("starrr:change", e)
                };
                t.prototype.syncRating = function (e) {
                    var t, n, r, i;
                    e || (e = this.options.rating);
                    if (e) {
                        for (t = n = 0, i = e - 1; 0 <= i ? n <= i : n >= i; t = 0 <= i ? ++n : --n) {
                            this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")
                        }
                    }
                    if (e && e < 5) {
                        for (t = r = e; e <= 4 ? r <= 4 : r >= 4; t = e <= 4 ? ++r : --r) {
                            this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                        }
                    }
                    if (!e) {
                        return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                    }
                };
                return t
            }();
            return e.fn.extend({
                starrr: function () {
                    var t, r;
                    r = arguments[0], t = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function () {
                        var i;
                        i = e(this).data("star-rating");
                        if (!i) {
                            e(this).data("star-rating", i = new n(e(this), r))
                        }
                        if (typeof r === "string") {
                            return i[r].apply(i, t)
                        }
                    })
                }
            })
        })(window.jQuery, window);
        $(function () {
            return $(".starrr").starrr()
        })

        $(function () {

            $('#new-review').autosize({append: "\n"});

            var reviewBox = $('#post-review-box');
            var newReview = $('#new-review');
            var openReviewBtn = $('#open-review-box');
            var closeReviewBtn = $('#close-review-box');
            var ratingsField = $('#ratings-hidden');

            openReviewBtn.click(function (e) {
                reviewBox.slideDown(400, function () {
                    $('#new-review').trigger('autosize.resize');
                    newReview.focus();
                });
                openReviewBtn.fadeOut(100);
                closeReviewBtn.show();
            });

            closeReviewBtn.click(function (e) {
                e.preventDefault();
                reviewBox.slideUp(300, function () {
                    newReview.focus();
                    openReviewBtn.fadeIn(200);
                });
                closeReviewBtn.hide();

            });

            $('.starrr').on('starrr:change', function (e, value) {
                ratingsField.val(value);
            });
        });
    </script>
@stop
