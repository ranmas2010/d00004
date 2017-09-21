@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>Gallery</h1>
            <ul class="bread-crumb">
                <li><a href="index.html">Home</a></li>
                <li>Gallery</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Gallery Section-->
<section class="gallery-section">
    <div class="auto-container">
        <div class="row clearfix">


            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="error-content text-center">

                            <h2 class="text-light-black mt-60">{{$title}}</h2>
                            <h4 class="text-light-black">{{$subTitle}}</h4>

                            {!!$notes!!}
                            <div class="pt-10 pb-10" ></div>

                            <button class="theme-btn btn-style-one" type="button" id="submitBut" name="submit-form"  onclick="window.location.href='/'">返回首頁</button>

                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</section>
<!--End Gallery Section-->

@endsection