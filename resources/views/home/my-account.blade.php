@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>會員專區</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>會員專區</li>
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
                            <span class="icon flaticon-shopping-cart"></span>
                        </div>
                        <div class="text"><h3><a href="/my-order"> 我的訂單</a></h3></div>
                    </div>
                </div>

                <!--Contact Info Block-->
                <div class="contact-info-block col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="icon-box wow fadeIn" data-wow-delay="300ms">
                            <span class="icon flaticon-edit"></span>
                        </div>
                        <div class="text"><h3><a href="/my-profile"> 修改基本資料</a></h3></div>
                    </div>
                </div>

                <!--Contact Info Block-->
                <div class="contact-info-block col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="icon-box wow fadeIn" data-wow-delay="600ms">
                            <span class="icon flaticon-eye-open"></span>
                        </div>
                        <div class="text"><h3><a href="/my-password"> 修改密碼</a></h3></div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</section>
<!--End Contact Section-->


@endsection