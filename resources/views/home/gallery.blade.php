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

            <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="/images/gallery/1.jpg" alt="">
                        <div class="overlay-box">
                            <div class="content">
                                <a class="lightbox-image" href="/images/gallery/1.jpg" title="Image Title Here" data-fancybox-group="example-gallery"><span class="icon flaticon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="/images/gallery/2.jpg" alt="">
                        <div class="overlay-box">
                            <div class="content">
                                <a class="lightbox-image" href="/images/gallery/2.jpg" title="Image Title Here" data-fancybox-group="example-gallery"><span class="icon flaticon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="/images/gallery/3.jpg" alt="">
                        <div class="overlay-box">
                            <div class="content">
                                <a class="lightbox-image" href="/images/gallery/3.jpg" title="Image Title Here" data-fancybox-group="example-gallery"><span class="icon flaticon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="/images/gallery/4.jpg" alt="">
                        <div class="overlay-box">
                            <div class="content">
                                <a class="lightbox-image" href="/images/gallery/4.jpg" title="Image Title Here" data-fancybox-group="example-gallery"><span class="icon flaticon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="/images/gallery/5.jpg" alt="">
                        <div class="overlay-box">
                            <div class="content">
                                <a class="lightbox-image" href="/images/gallery/5.jpg" title="Image Title Here" data-fancybox-group="example-gallery"><span class="icon flaticon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="/images/gallery/6.jpg" alt="">
                        <div class="overlay-box">
                            <div class="content">
                                <a class="lightbox-image" href="/images/gallery/6.jpg" title="Image Title Here" data-fancybox-group="example-gallery"><span class="icon flaticon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Styled Pagination -->
        <div class="styled-pagination text-center">
            <ul class="clearfix">
                <li><a class="prev" href="#"><span class="fa fa-angle-left"></span></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#" class="active">2</a></li>
                <li><a class="next" href="#"><span class="fa fa-angle-right"></span></a></li>
            </ul>
        </div>

    </div>
</section>
<!--End Gallery Section-->

@endsection