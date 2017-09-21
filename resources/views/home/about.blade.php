@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url({!!$about['pic'] !!});">
    <div class="auto-container">
        <div class="inner-box">
            <h1>{{$about['banner_title']}}</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>關於我們</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Welcome Section-->
<section class="welcome-section">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="sec-title centered">
            <div class="title-icon"><img src="/images/icons/sec-title-icon-1.png" alt="" /></div>
            <h2>{{$about['subject']}}</h2>
            <div class="title">{{$about['notes']}}</div>
            <!--編輯器-->
          {!! $about['description'] !!}
                <!--編輯器 END-->
            </div>
        </div>
        <!--Image-->

    </div>
</section>
<!--End Welcome Section-->

<!--Teachers Section-->
<section class="teachers-section no-padding-btm">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="sec-title centered">
            <div class="title-icon"><img src="/images/icons/sec-title-icon-1.png" alt="" /></div>
            <h2>設計團隊</h2>
            <div class="title">Design's Team</div>
            <div class="text">We are group of teachers who really love childrens and enjoy every moment of teaching</div>
        </div>

        <div class="three-item-carousel owl-carousel owl-theme">

            <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="/images/teacher/MOZIteacher-1.png" alt="" />
                    </div>
                    <h3>+進</h3>
                    <div class="designation">企劃總監</div>
                    <div class="text">The ship set ground on the shore of this uncharted a desert isle with that this group would s form a family.</div>
                    <ul class="social-links-one">
                        <li><a href="#"><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
                    </ul>
                </div>
            </div>

            <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="/images/teacher/MOZIteacher-2.png" alt="" />
                    </div>
                    <h3>羊叔</h3>
                    <div class="designation">設計總監</div>
                    <div class="text">The ship set ground on the shore of this uncharted a desert isle with that this group would s form a family.</div>
                    <ul class="social-links-one">
                        <li><a href="#"><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
                    </ul>
                </div>
            </div>

            <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="/images/teacher/p7403741a556455019.jpg" alt="" />
                    </div>
                    <h3>川普</h3>
                    <div class="designation">美國總統</div>
                    <div class="text">The ship set ground on the shore of this uncharted a desert isle with that this group would s form a family.</div>
                    <ul class="social-links-one">
                        <li><a href="#"><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
                    </ul>
                </div>
            </div>

            <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="/images/resource/teacher-1.jpg" alt="" />
                    </div>
                    <h3>STEVEN SMITH</h3>
                    <div class="designation">Sports Teacher</div>
                    <div class="text">The ship set ground on the shore of this uncharted a desert isle with that this group would s form a family.</div>
                    <ul class="social-links-one">
                        <li><a href="#"><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
                    </ul>
                </div>
            </div>

            <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="/images/resource/teacher-2.jpg" alt="" />
                    </div>
                    <h3>David warner</h3>
                    <div class="designation">Drawing Teacher</div>
                    <div class="text">The ship set ground on the shore of this uncharted a desert isle with that this group would s form a family.</div>
                    <ul class="social-links-one">
                        <li><a href="#"><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
                    </ul>
                </div>
            </div>

            <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="/images/resource/teacher-3.jpg" alt="" />
                    </div>
                    <h3>Steve alia</h3>
                    <div class="designation">Language Teacher</div>
                    <div class="text">The ship set ground on the shore of this uncharted a desert isle with that this group would s form a family.</div>
                    <ul class="social-links-one">
                        <li><a href="#"><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter-square"></span></a></li>
                        <li><a href="#"><span class="fa fa-linkedin-square"></span></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!--Background Patten-->

</section>
<!--End Teachers Section-->




@endsection