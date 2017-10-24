@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url({!! $topCategory['pic'] !!});">
    <div class="auto-container">
        <div class="inner-box">
            <h1>常見問題</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>常見問題</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!--Blog-->
                <section class="blog-classic">



                    <ul class="accordion-box">
                        <li class="accordian-title">{{$topCategory['title']}}</li>

                        @foreach ($qa as $key => $col)



                                <!--Block-->
                        <li class="accordion block active-block">
                            <div class="acc-btn @if($key == 0) active @endif"><div class="icon-outer"><span class="icon fa fa-arrow-circle-right"></span> </div>{{$col['title']}}</div>
                            <div class="acc-content @if($key == 0) current @endif">
                                <div class="content"><p>
                                        {!! $col['description'] !!}
                                    </p></div>
                            </div>
                        </li>

                        @endforeach




                    </ul>






                    @if($totalNum <= 0)
                        <div class="news-style-two col-md-12 col-sm-12 col-xs-12 text-center">
                            ※無相關資訊
                        </div>

                    @endif
                </section>

                <!-- Styled Pagination -->
                <div class="styled-pagination">
                    <ul class="clearfix">

                        {!! $pageList !!}
                    </ul>
                </div>

            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar">

                    <!--Services Category Widget-->
                    <div class="sidebar-widget category-widget">
                        <div class="sidebar-title">
                            <h3>訊息分類</h3>
                        </div>
                        <ul>


                            @foreach ($subCategory as $col)
                                <li><a href="/qa/1/{{$col->guid}}">{{$col->title}} <span>({{$col->countNum}})</span></a></li>
                            @endforeach

                        </ul>
                    </div>

                    <!--Services Post Widget-->
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h3>Latest Post</h3>
                        </div>
                        <!--Post-->
                        <article class="post">
                            <figure class="post-thumb img-circle"><a href="#"><img src="/images/resource/post-thumb-1.jpg" alt=""></a></figure>
                            <div class="text"><a href="#">Activities Improves Mind</a></div>
                            <div class="post-info">Posted by Adam Rose</div>
                        </article>
                        <!--Post-->
                        <article class="post">
                            <figure class="post-thumb img-circle"><a href="#"><img src="/images/resource/post-thumb-2.jpg" alt=""></a></figure>
                            <div class="text"><a href="#">Make Learning Fun for Your Kids</a></div>
                            <div class="post-info">Posted by Adam Rose</div>
                        </article>
                        <!--Post-->
                        <article class="post">
                            <figure class="post-thumb img-circle"><a href="#"><img src="/images/resource/post-thumb-3.jpg" alt=""></a></figure>
                            <div class="text"><a href="#">What Do Kids Learn in Preschool?</a></div>
                            <div class="post-info">Posted by Adam Rose</div>
                        </article>
                    </div>

                    <!--Services Gallery Widget-->
                    <div class="sidebar-widget gallery-posts">
                        <div class="sidebar-title">
                            <h3>Gallery</h3>
                        </div>
                        <div class="images-outer clearfix">
                            <!--Image Box-->
                            <figure class="image-box"><a href="images/resource/classic-1.jpg" class="lightbox-image" title="Image Title Here" data-fancybox-group="footer-gallery"><img src="/images/resource/gallery-thumb-1.jpg" alt=""></a></figure>
                            <!--Image Box-->
                            <figure class="image-box"><a href="images/resource/classic-2.jpg" class="lightbox-image" title="Image Title Here" data-fancybox-group="footer-gallery"><img src="/images/resource/gallery-thumb-2.jpg" alt=""></a></figure>
                            <!--Image Box-->
                            <figure class="image-box"><a href="images/resource/classic-3.jpg" class="lightbox-image" title="Image Title Here" data-fancybox-group="footer-gallery"><img src="/images/resource/gallery-thumb-3.jpg" alt=""></a></figure>
                            <!--Image Box-->
                            <figure class="image-box"><a href="images/resource/classic-4.jpg" class="lightbox-image" title="Image Title Here" data-fancybox-group="footer-gallery"><img src="/images/resource/gallery-thumb-4.jpg" alt=""></a></figure>
                            <!--Image Box-->
                            <figure class="image-box"><a href="images/resource/classic-1.jpg" class="lightbox-image" title="Image Title Here" data-fancybox-group="footer-gallery"><img src="/images/resource/gallery-thumb-5.jpg" alt=""></a></figure>
                            <!--Image Box-->
                            <figure class="image-box"><a href="images/resource/classic-2.jpg" class="lightbox-image" title="Image Title Here" data-fancybox-group="footer-gallery"><img src="/images/resource/gallery-thumb-6.jpg" alt=""></a></figure>
                        </div>
                    </div>

                    <!--Services Tags Widget-->
                    <div class="sidebar-widget popular-tags">
                        <div class="sidebar-title">
                            <h3>Tags</h3>
                        </div>
                        <a href="#">Music</a>
                        <a href="#">Toys</a>
                        <a href="#">Sports</a>
                        <a href="#">Childwood</a>
                        <a href="#">Education</a>
                        <a href="#">Nutritions</a>
                        <a href="#">Link</a>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</div>



@endsection