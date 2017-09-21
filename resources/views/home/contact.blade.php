@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>聯絡我們</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>聯絡我們</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Contact Section-->
<section class="contact-section">
    <div class="auto-container">
        <!--Info Section-->
        <div class="info-section">
            <div class="row clearfix">
                <!--Contact Info Block-->
                <div class="contact-info-block col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="icon-box wow fadeIn" data-wow-delay="0ms">
                            <span class="icon flaticon-location-pin"></span>
                        </div>
                        <div class="text">{{$webData['address']}}</div>
                    </div>
                </div>

                <!--Contact Info Block-->
                <div class="contact-info-block col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="icon-box wow fadeIn" data-wow-delay="300ms">
                            <span class="icon flaticon-web"></span>
                        </div>
                        <div class="text">{{$webData['email']}}</div>
                    </div>
                </div>

                <!--Contact Info Block-->
                <div class="contact-info-block col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="icon-box wow fadeIn" data-wow-delay="600ms">
                            <span class="icon flaticon-smartphone"></span>
                        </div>
                        <div class="text">{{$webData['phone']}}</div>
                    </div>
                </div>

            </div>
        </div>

        <!--Form Section-->
        <div class="form-section">
            <div class="row clearfix">
                <!--Form Column-->
                <div class="form-column col-md-8 col-sm-12 col-xs-12">
                    <!-- contact Form -->
                    <div class="contact-form">
                        <!--contact Form-->
                        <form method="post" action="sendemail.php" id="contact-form">

                            <div class="form-group">
                                <input type="text" name="username" placeholder="姓名 *" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email *" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="subject" placeholder="諮詢主旨 *">
                            </div>

                            <div class="form-group">
                                <textarea name="message" placeholder="諮詢內容"></textarea>
                            </div>
                            {!! app('captcha')->display() !!}
                            <div class="form-group">
                                <button class="theme-btn btn-style-one" type="submit" name="submit-form">送出</button>
                            </div>

                        </form>

                    </div>
                    <!--End Contact Form -->
                </div>
                <!--Time Column-->
                <div class="time-column col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-box">
                        <h3>營業時間</h3>
                        <ul class="time-info">
                            <li class="clearfix">
                                <div class="day-box">周一</div><div class="time-box">10:00 - 16:00</div>
                            </li>
                            <li class="clearfix">
                                <div class="day-box">周二</div><div class="time-box">10:00 - 16:00</div>
                            </li>
                            <li class="clearfix">
                                <div class="day-box">周三 </div><div class="time-box">10:00 - 16:00</div>
                            </li>
                            <li class="clearfix">
                                <div class="day-box">周四 </div><div class="time-box">10:00 - 16:00</div>
                            </li>
                            <li class="clearfix">
                                <div class="day-box">周五 </div><div class="time-box">10:00 - 16:00</div>
                            </li>
                            <li class="clearfix">
                                <div class="day-box">周六 </div><div class="time-box">10:00 - 16:00</div>
                            </li>
                            <li class="clearfix">
                                <div class="day-box">周日 </div><div class="time-box">公休</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--End Contact Section-->

<!--Map Section-->
<section class="map-section">
    <!--Map Outer-->
    <div class="map-outer">
        <!--Map Canvas-->
        <div class="map-canvas"
             data-zoom="10"
             data-lat="-37.817085"
             data-lng="144.955631"
             data-type="roadmap"
             data-hue="#ffc400"
             data-title="Envato"
             data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">
        </div>
    </div>
</section>


@endsection