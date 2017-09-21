@extends('home.layouts.master')


@section('content')
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.10&appId=424575077578711";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


        <!--Page Title-->
<section class="page-title" style="background-image:url({!! $topCategory['pic'] !!});">
    <div class="auto-container">
        <div class="inner-box">
            <h1>blog Details</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>{{$topCategory['title']}}</li>
                <li>{{$news['title']}}</li>
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
                <section class="blog-single">

                    <!--News Style Four-->
                    <div class="news-style-four">
                        <div class="inner-box">
                            <!--Image Column-->
                            <div class="image">
                                <img src="{!! $news['pic'] !!}" alt="{{$news['pic_alt']}}" />
                            </div>
                            <!--Content Column-->
                            <div class="content-column">
                                <div class="inner">
                                    <div class="post-date">{{$news['date']}}</div>
                                    <h3>{{$news['title']}}</h3>
                                    <ul class="post-meta">
                                        <li>by <span>Adam rose</span></li>
                                        <li><a href="blog-single.html"><span class="icon fa fa-commenting-o"></span> 7 Comments</a></li>
                                        <li><a href="blog-single.html"><span class="icon fa fa-eye"></span>{{$news['views']}} Views</a></li>
                                    </ul>
                                    <div class="text">
                                        {!! $news['description'] !!}
                                    </div>

                                    <div class="fb-comments" data-width="100%" data-href="http://{{$serverName}}/new/{{$news["guid"]}}" data-numposts="5"></div>



                                </div>
                            </div>
                        </div>
                    </div>



                </section>

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
                                <li><a href="/news/1/{{$col->guid}}">{{$col->title}} <span>({{$col->countNum}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!--Services Post Widget-->
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h3>相關新聞</h3>
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