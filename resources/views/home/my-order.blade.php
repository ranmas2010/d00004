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


                                    <tr id="_shopData1501045835List">
                                        <td class="product-thumbnail  text-center">
                                           2017-09-27
                                        </td>
                                        <td class="text-center">A0000000001</td>

                                        <td class="text-center">已出貨</td>

                                        <td class="product-subtotal">NT$ 999</td>
                                        <td class="product-remove">
                                            <a href="/order-detail/1505748129" class="delShopCar" data-puid="1501045835"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            <a href="#1" class="delOrder" data-puid="1501045835"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>



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
            <li><a class="prev" href="#"><span class="fa fa-angle-left"></span></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#" class="active">2</a></li>
            <li><a class="next" href="#"><span class="fa fa-angle-right"></span></a></li>
        </ul>
    </div>
</section>
<!--End Contact Section-->


@endsection