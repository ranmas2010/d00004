@extends('home.layouts.master')


@section('content')


        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>購物車</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>購物車</li>

            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page-->
<section class="welcome-section">
    <div class="auto-container">




        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="shopping-cart " >
                    <!-- Nav tabs -->
                    <ul class="cart-page-menu row  ">
                        <li class="active "><a href="/car" aria-expanded="true">購物車</a></li>
                        <li class=""><a href="/checkout"  aria-expanded="false">基本資料</a></li>
                        <li><a href="#" data-toggle="tab">完成購物</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- shopping-cart start -->
                        <div class="tab-pane active" id="shopping-cart">
                            <form action="#">
                                <div class="shop-cart-table">
                                    <div class="table-content table-responsive" style="overflow-x:visible;">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th class="product-thumbnail">商品名稱</th>
                                                <th class="product-price">售價</th>
                                                <th class="product-quantity">數量</th>
                                                <th class="product-subtotal">小計</th>
                                                <th class="product-remove">刪除</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($shopList as $col)

                                            <tr id="_shopData{{$col['puid']}}List">
                                                <td class="product-thumbnail  text-left">
                                                    <!-- Single-product start -->
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <a href="/work/{{$col['puid']}}" title="{{$col['productTitle']}}"><img src="{{$col['productPic']}}" alt="{{$col['productTitle']}}" /></a>
                                                        </div>
                                                        <div class="product-info">
                                                            <h4 class="post-title"><a class="text-light-black" href="/work/{{$col['puid']}}" title="{{$col['productTitle']}}">{{$col['productTitle']}}</a></h4>

                                                        </div>
                                                    </div>
                                                    <!-- Single-product end -->
                                                </td>
                                                <td class="product-price">NT$ {{$col['price']}}</td>

                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus"><div class="dec qtybutton">
                                                            <a href="#1" class="changeQty" data-type="del" data-model="car" data-puid="{{$col['puid']}}" ><i class="fa fa-minus-square" aria-hidden="true"></i></a></div>

                                                        <input type="text" value="{{$col['qty']}}" name="qty" id="qty_{{$col['puid']}}" data-puid="{{$col['puid']}}"  data-type="add" data-model="car" class="cart-plus-minus-box qty qtyIn">
                                                        <input type="hidden" class="safe_inventory" name="safe_inventory" value="{{$col["safe_inventory"]}}"><!--庫存量-->
                                                        <div class="inc qtybutton"> <a href="#1" class="changeQty" data-type="add" data-model="car" data-puid="{{$col['puid']}}"><i class="fa fa-plus-square" aria-hidden="true"></i></a></div></div>
                                                </td>

                                                <td class="product-subtotal">NT$ <span class="subtotal{{$col['puid']}}">{{$col['price']*$col['qty']}}</span></td>
                                                <td class="product-remove">
                                                    <a href="#1" class="delShopCar" data-puid="{{$col['puid']}}" ><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row ">


                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="customer-login payment-details floatright">
                                            <h4 class="title-1 title-border text-uppercase">購 物 總 計</h4>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="text-left">商品總計</td>
                                                    <td class="text-right">NT$ <span class="vTotalPriceList">{{$shopTotalPrice}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">運費</td>
                                                    <td class="text-right" class="fareArea">NT$ <span class="fareAreaPrice">{{$fare}}<br>{!! $fareText !!}</span></td>
                                                </tr>

                                                <tr>
                                                    <td class="text-left">應付金額</td>
                                                    <td class="text-right">NT$ <span class="vTotalPriceListAll">{{$shopTotalPriceAndFare}}</span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 ">
                                    <div class="text-center">

                                        <button type="button" data-text="下一步" class="theme-btn btn-style-for" onclick="window.location.href='/checkout'">下一步</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                        <!-- shopping-cart end -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection