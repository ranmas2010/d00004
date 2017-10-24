@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>會員專區</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>我的訂單</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Contact Section-->
<section style="padding-top: 30px; padding-bottom: 30px;">
    <div class="auto-container">
        <!--Info Section-->
        <div class="info-section">
            <div class="row clearfix">

                <div class="tab-pane active" id="shopping-cart">
                    <form action="#">
                        <div class="shop-cart-table">
                            <div class="table-content table-responsive" style="overflow-x:visible;">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail">訂單日期</th>
                                        <th class="product-price">訂單編號</th>
                                        <th class="product-quantity">訂單狀態</th>
                                        <th class="product-subtotal">總計</th>
                                        <th class="product-remove"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(count($orderData)>0)
                                    @foreach ($orderData as $col)
                                    <tr id="_shopData{{$col['guid']}}List">
                                        <td class="product-thumbnail  text-center">
                                          {{substr($col['date'],0,10)}}
                                        </td>
                                        <td class="text-center">{{$col['or_no']}}</td>

                                        <td class="text-center">{{$col['statusText']}}</td>

                                        <td class="product-subtotal">NT$ {{$col['total_price']}}</td>
                                        <td class="product-remove text-left">
                                            <a href="/order-detail/{{$col['guid']}}" class="delShopCar" data-puid="1501045835"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            @if($col['status'] == 'N')
                                            <a href="#1" class="delOrder" data-value="{{$col['guid']}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                    @else
                                        <tr >

                                            <td class="text-center" colspan="5">無購買紀錄!</td>


                                        </tr>

                                    @endif




                                    </tbody>
                                </table>
                            </div>
                        </div>





                    </form>
                </div>




            </div>
        </div>


    </div>

    <div class="styled-pagination text-center">
        <ul class="clearfix">
            {!! $pageList !!}
        </ul>
    </div>
</section>
<!--End Contact Section-->


@endsection