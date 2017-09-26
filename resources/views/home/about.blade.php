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

            @if(count($designer)>0)

            @foreach ($designer as $col)
                    <!--Teacher Block-->
            <div class="teacher-block">
                <div class="inner-box">
                    <div class="image-box">
                        <img src="{!!  $col['pic'] !!}g" alt="{{$col['pic_alt']}}" />
                    </div>
                    <h3>{{$col['title']}}</h3>
                    <div class="designation">{{$col['subject']}}</div>
                    <div class="text">{!! $col['notes'] !!}</div>
                    <ul class="social-links-one">
                        @if(!empty($col['facebook']))
                            <li><a href="{{$col['facebook']}}" target="_blank"><span class="fa fa-facebook-square"></span></a></li>
                        @endif
                        @if(!empty($col['twitter']))
                            <li><a href="{{$col['twitter']}}" target="_blank"><span class="fa fa-twitter-square"></span></a></li>
                        @endif
                        @if(!empty($col['instagram']))
                            <li><a href="{{$col['instagram']}}" target="_blank"><span class="fa fa-instagram"></span></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div>
    <!--Background Patten-->

</section>
<!--End Teachers Section-->




@endsection