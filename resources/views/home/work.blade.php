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
            <h1>{{$product['title']}}</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>{{$topCategory['title']}}</li>
                <li>{{$product['categoryTitle']}}</li>
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
                <!--Classes Single-->
                <section class="classes-single">
                    <div class="inner-box">
                        <div class="classes-carousel">
                            <div class="carousel-outer">

                                <ul class="image-carousel owl-carousel owl-theme">
                                    @foreach ($productPic as $indexKey => $pic)
                                    <li><a href="/_upload/images/{{$pic}}" class="lightbox-image" title="@if(!empty($productPicAlt[$indexKey])) {{$productPicAlt[$indexKey]}} @endif"><img src="/timthumb.php?src=/_upload/images/{{$pic}}&h=425&w=770" alt="@if(!empty($productPicAlt[$indexKey])) {{$productPicAlt[$indexKey]}} @endif"></a></li>
                                    @endforeach
                                          </ul>

                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    @foreach ($productPic as $indexKey => $pic)
                                    <li><img src="/timthumb.php?src=/_upload/images/{{$pic}}&h=65&w=70" alt="@if(!empty($productPicAlt[$indexKey])) {{$productPicAlt[$indexKey]}} @endif"></li>
                                    @endforeach

                                </ul>

                                <!--Course Price-->
                                <div class="course-price">${{$product['price']}}</div>

                            </div>
                        </div>
                        <!--Lower Box-->
                        <div class="lower-content">
                            <!--Upper Box-->
                            <div class="upper-box">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h3>{{$product['title']}}</h3>
                                        <!--<div class="class-date">Feb 29, 2017</div>-->
                                        <div class="rating">
                                            <span class="fa fa-heart"></span>
                                            <span class="fa fa-heart"></span>
                                            <span class="fa fa-heart"></span>
                                            <span class="fa fa-heart"></span>
                                            <span class="light fa fa-heart-o"></span>
                                        </div>
                                    </div>

                                    <div class="pull-right">
                                        <div class="product-quantity">
                                            <div class="cart-plus-minus"><div class="dec qtybutton">
                                                    <a href="#1" class="changeQty" data-type="del" data-model="work" data-puid="{{$product['guid']}}"><i class="fa fa-minus-square" aria-hidden="true"></i></a></div>

                                                <input type="text" value="1" name="qty" id="qty"  data-model="work" data-puid="{{$product['guid']}}" class="cart-plus-minus-box qty qtyIn" style="width: 70px;">

                                                <div class="inc qtybutton">
                                                    <a href="#1" class="changeQty" data-type="add" data-model="work" data-puid="{{$product['guid']}}"><i class="fa fa-plus-square" aria-hidden="true"></i></a></div></div>
                                        </div>
                                        <a href="#" class="theme-btn btn-style-one">加入購物車</a>
                                    </div>


                                </div>
                            </div>
                            <!--Lower Box-->
                            <div class="lower-box">
                                <div class="text">

                                   {!! $product['description'] !!}
                                     </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--Accordion Box-->
                <ul class="accordion-box">
                    <li class="accordian-title">相關問與答</li>


                    <div class="fb-comments" data-width="100%" data-href="http://{{$serverName}}/work/{{$product["guid"]}}" data-numposts="5"></div>


                </ul>

            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar">

                    <!--Services Category Widget-->
                    <div class="sidebar-widget category-widget">
                        <div class="sidebar-title">
                            <h3>{{$topCategory['title']}}</h3>
                        </div>
                        <ul>
                            @foreach ($subCategory as $col)
                            <li><a href="/works/1/{{$col->category}}/{{$col->guid}}">{{$col->title}} <span>({{$col->countNum}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!--Services Post Widget-->
                    <!--
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h3>Latest Post</h3>
                        </div>

                        <article class="post">
                            <figure class="post-thumb img-circle"><a href="#"><img src="/images/resource/post-thumb-1.jpg" alt=""></a></figure>
                            <div class="text"><a href="#">Activities Improves Mind</a></div>
                            <div class="post-info">Posted by Adam Rose</div>
                        </article>

                        <article class="post">
                            <figure class="post-thumb img-circle"><a href="#"><img src="/images/resource/post-thumb-2.jpg" alt=""></a></figure>
                            <div class="text"><a href="#">Make Learning Fun for Your Kids</a></div>
                            <div class="post-info">Posted by Adam Rose</div>
                        </article>

                        <article class="post">
                            <figure class="post-thumb img-circle"><a href="#"><img src="/images/resource/post-thumb-3.jpg" alt=""></a></figure>
                            <div class="text"><a href="#">What Do Kids Learn in Preschool?</a></div>
                            <div class="post-info">Posted by Adam Rose</div>
                        </article>
                    </div>
                    -->
                    <!--Services Gallery Widget-->


                    <!--Services Tags Widget-->
                    @if(count($subProduct)>0)
                    <div class="sidebar-widget popular-tags">
                        <div class="sidebar-title">
                            <h3>相關作品</h3>
                        </div>
                        @foreach ($subProduct as $col)
                        <a href="/work/{{$col->guid}}" title="{{$col->title}}">{{$col->title}}</a>
                        @endforeach
                    </div>
                    @endif
                        <!--內頁廣告-->
                    <div class="sidebar-widget">
                        <ul>
                            <li><img src="/_upload/images/1707261515400.jpg"></li>
                            <li><img src="/_upload/images/1707261515400.jpg"></li>
                        </ul>

                    </div>
                </aside>
            </div>

        </div>
    </div>
</div>



@endsection