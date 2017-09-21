@extends('home.layouts.master')


@section('content')


        <!--Page Title-->
<section class="page-title" style="background-image:url({!! $product_categorys['pic'] !!});">
    <div class="auto-container">
        <div class="inner-box">
            <h1>{{$product_categorys['title']}}</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>作品專區</li>
                <li>{{$product_categorys['title']}}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<section class="product-category-section">

    <div class="sidebar-widget popular-tags" style="margin-bottom: 0px;">
        <ul>
        @foreach ($productCategorys as $col)
        @if($category == $col['guid'])
                @foreach ($col['next'] as $sub)
             <li style="display: inline-block; height: 45px;" > <a class="btn-style-three @if($subCategory == $sub->guid) active3 @endif" href="/works/1/{{$col['guid']}}/{{$sub->guid}}">{{$sub->title}}</a></li>
                @endforeach
            @endif
        @endforeach
            </ul>

    </div>
</section>


<section class="classes-section">
    <div class="auto-container">

        <!--Classes Search Bar-->
        <div class="classes-search">
            <div class="clearfix">

                <div class="pull-left">
                    @if($totalNum > 0)
                    <div class="items-label">顯示 {{$sNum}}-{{$eNum}} 筆 共 {{$totalNum}} 項作品</div>
                    @endif
                </div>

                <div class="pull-right">
                    <div class="search-boxed">
                        <form action="blog-single.html" method="post">
                            <input type="search" value="" placeholder="Search..." required />
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="row clearfix">
            @foreach ($product as $col)
            <!--News Style Two-->
            <div class="news-style-two col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <!--Image Column-->
                    <div class="image-column">
                        <div class="image">
                            <a href="/work/{{$col['guid']}}" title="{{$col['title']}}"><img src="{!! $col['pic'] !!}" alt="{{$col['pic_alt']}}"></a>
                            <span class="category">{{$col['categoryTitle']}}</span>
                            <div class="overlay-layer">
                                <a href="/work/{{$col['guid']}}"><span class="icon flaticon-unlink"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--Content Column-->
                    <div class="content-column">
                        <div class="inner">
                           <!-- <div class="post-date">Feb 29, 2017</div>-->
                            <h3><a href="/work/{{$col['guid']}}" title="{{$col['title']}}">{{$col['title']}}</a></h3>
                            <div class="text">NT$ {{$col['price']}}</div>
                            <a href="/work/{{$col['guid']}}" class="theme-btn btn-style-one" style="padding: 12px 20px"><i class="fa fa-search-plus" aria-hidden="true"></i> 詳細內容</a>
                            <a href="#1" class="theme-btn btn-style-for addShopCar" data-puid="{{$col['guid']}}" data-qty="1" ><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> 加入購物車</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @if($totalNum <= 0)
                <div class="news-style-two col-md-12 col-sm-12 col-xs-12 text-center">
                    ※無相關作品
                    </div>

            @endif
        </div>

        <!-- Styled Pagination -->
        <div class="styled-pagination text-center">
            <ul class="clearfix">
                {!! $pageList !!}
            </ul>
        </div>

    </div>
</section>

@endsection