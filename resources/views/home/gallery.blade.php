@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url(/images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>活動寫真</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
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

            @if(count($gallery)>0)
            @foreach ($gallery as $col)
                    <!--Gallery Item-->
            <div class="gallery-item col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <div class="image-box"><img src="{!! $col['pic'] !!}" alt="">
                        <div align="center">{{$col['title']}}</div>
                        <div class="overlay-box">
                            <div class="content">


                                @foreach ($col['picArr'] as $key => $val)
                                    <a class="lightbox-image" href="/_upload/images/{!! $val !!}" title="{{$col['picAltArr'][$key]}}" data-fancybox-group="example-gallery{{$col['id']}}"><span class="icon flaticon-plus"></span></a>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
<!--End Gallery Section-->

@endsection