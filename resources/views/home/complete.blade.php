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
                        <li class=""><a href="#" aria-expanded="true">購物車</a></li>
                        <li><a href="#"  aria-expanded="false">基本資料</a></li>
                        <li class="active"><a href="#" data-toggle="tab">完成購物</a></li>

                    </ul>
                    <hr>
                    <!-- order-complete start -->
                    <div class="shopping-cart-area  pt-80 pb-80">
                    <div class="tab-pane active" id="order-complete">
                        <form action="#">
                            <div class="thank-recieve bg-white mb-30">
                                <p style="font-size: 21px;">感謝您的購買！</p>
                            </div>
                            <hr>
                            <div class="order-info bg-white text-center clearfix mb-30">
                                <div class="single-order-info">
                                    <h4 class="title-1 text-uppercase text-light-black mb-0">訂單編號</h4>
                                    <p class="text-uppercase text-light-black mb-0"><strong>m 2653257</strong></p>
                                </div>
                                <div class="single-order-info">
                                    <h4 class="title-1 text-uppercase text-light-black mb-0">訂單日期</h4>
                                    <p class="text-uppercase text-light-black mb-0"><strong>june 15, 2016</strong></p>
                                </div>
                                <div class="single-order-info">
                                    <h4 class="title-1 text-uppercase text-light-black mb-0">總金額</h4>
                                    <p class="text-uppercase text-light-black mb-0"><strong>$ 170.00</strong></p>
                                </div>
                                <div class="single-order-info">
                                    <h4 class="title-1 text-uppercase text-light-black mb-0">付款方式</h4>
                                    <p class="text-uppercase text-light-black mb-0"><a href="#"><strong>check payment</strong></a></p>
                                </div>
                            </div>
                            <div class="shop-cart-table check-out-wrap">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-sm-12">
                                        <div class="our-order payment-details pr-20">
                                            <h4 class="title-1 title-border text-uppercase mb-30">訂購明細</h4>
                                            <table style="margin-top: 10px;" >
                                                <thead>
                                                <tr>
                                                    <th><strong>Product</strong></th>
                                                    <th class="text-right"><strong>Total</strong></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Dummy Product Name  x 2</td>
                                                    <td class="text-right">$86.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Dummy Product Name  x 1</td>
                                                    <td class="text-right">$69.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Cart Subtotal</td>
                                                    <td class="text-right">$155.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping and Handing</td>
                                                    <td class="text-right">$15.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Vat</td>
                                                    <td class="text-right">$00.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Order Total</td>
                                                    <td class="text-right">$170.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- payment-method -->
                                    <div class="col-md-6 col-sm-6 col-sm-12 mt-xs-30">
                                        <div class="payment-method  pl-20">
                                            <h4 class="title-1 title-border text-uppercase mb-30" style="padding-bottom: 10px;">付款方式</h4>
                                            <div class="payment-accordion" >

                                                <!-- Accordion start  -->
                                                <h3 class="payment-accordion-toggle active">Direct Bank Transfer</h3>
                                                <div class="payment-content default">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
                                                </div>
                                                <!-- Accordion end -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <!-- order-complete end -->

                </div>
            </div>
        </div>
    </div>
</section>


@endsection