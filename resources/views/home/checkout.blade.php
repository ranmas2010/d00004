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
                        <li class=""><a href="/car" aria-expanded="true">購物車</a></li>
                        <li class="active"><a href="/checkout"  aria-expanded="false">基本資料</a></li>
                        <li><a href="#" data-toggle="tab">完成購物</a></li>

                    </ul>

                    <div class="shopping-cart-area  pt-80 pb-80">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="shopping-cart">

                                        <!-- Tab panes -->
                                        <div class="tab-content">


                                            <!-- check-out start -->
                                            <div class="tab-pane active" id="check-out">
                                                <form action="" id="orderForm" name="orderForm" method="post">

                                                    <div class="shop-cart-table check-out-wrap">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 contact-form">
                                                                <div class="billing-details pr-20 form-group">
                                                                    <h4 class="title-1 title-border text-uppercase mb-30">購買者資訊</h4>
                                                                    <div class="form-group">
                                                                        <input type="text" name="name" id="name" placeholder="姓名 *" required value="@if(count($memberData)>0){{$memberData->name}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="company" id="company" placeholder="公司名稱"  value="@if(count($memberData)>0){{$memberData->company}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="phone" id="phone" placeholder="連絡電話 *" required value="@if(count($memberData)>0){{$memberData->phone}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="mobile" id="mobile" placeholder="手機號碼 *" required value="@if(count($memberData)>0){{$memberData->mobile}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="email" name="email" id="email" placeholder="E-mail *" required value="@if(count($memberData)>0){{$memberData->username}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <input type="text" name="zip" id="zip" placeholder="郵遞區號 *" required value="@if(count($memberData)>0){{$memberData->zip}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                    <select class="custom-select mb-15 changeCityData" class="changeCityData" data-next="district"  data-zip="zip" data-type="city"  name="city" id="city" required>
                                                                        <option value="">縣市</option>
                                                                        @foreach ($city as $col)
                                                                            <option value="{{$col->city}}" @if(count($memberData) > 0 && $memberData->city == $col->city) selected @endif>{{$col->city}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                            <select class="custom-select mb-15 changeCityData" data-next=""  data-zip="zip" data-type="district"  name="district" id="district" required>
                                                                            <option value="">區域</option>
                                                                                @if(count($district)>0)
                                                                                    @foreach ($district as $col)
                                                                                        <option value="{{$col->district}}" @if(count($memberData) > 0 && $memberData->district == $col->district) selected @endif >{{$col->district}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                        </select>
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <input type="text" name="address" id="address" placeholder="地址 *" required value="@if(count($memberData)>0){{$memberData->address}}@endif">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <select class="custom-select mb-15"  name="invoice" id="invoice" required>
                                                                            <option value="1">發票捐贈</option>
                                                                            <option value="2">二聯式發票</option>
                                                                            <option value="3">三聯式發票</option>
                                                                        </select>
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div>


                                                                    <div class="form-group invoiceLay" style="display: none;">
                                                                        <input type="text" name="invoice_title" id="invoice_title" placeholder="公司抬頭 *" required value="">
                                                                        <input type="text" name="invoice_code" id="invoice_code" placeholder="統一編號 *" required value="">
                                                                        <div class="_formErrorMsg"></div>
                                                                    </div> 

                                                                    <div class="form-group">
                                                                    <textarea class="custom-textarea" name="notes" id="notes" placeholder="其他備註..." ></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="our-order payment-details mt-60 pr-20">
                                                                    <h4 class="title-1 title-border text-uppercase mb-30">訂單列表</h4>
                                                                    <table>
                                                                        <thead>
                                                                        <tr>
                                                                            <th><strong>品項</strong></th>
                                                                            <th class="text-right"><strong>小計</strong></th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach ($shopList as $col)
                                                                        <tr>
                                                                            <td>{{$col['productTitle']}}  x {{$col['qty']}}</td>
                                                                            <td class="text-right">${{$col['price']*$col['qty']}}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>運費</td>
                                                                            <td class="text-right">${{$fare}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>總金額</td>
                                                                            <td class="text-right">${{$shopTotalPriceAndFare}}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <!-- payment-method -->
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <hr>
                                                                <div class="payment-method mt-60  pl-20">
                                                                    <h4 class="title-1 title-border text-uppercase mb-30">付款方式</h4>
                                                                    <div class="payment-accordion">
                                                                        <!-- Accordion start  -->
                                                                        <h3 class="payment-accordion-toggle  changePayType active"><label><input type="radio" class="payType" name="payType" checked value="Credit"> 線上刷卡</label></h3>
                                                                        <div class="payment-content default">
                                                                            <p>支援VISA、MASTER、JBC等卡片，一次付清</p>
                                                                        </div>
                                                                        <!-- Accordion end -->
                                                                        <!-- Accordion start -->
                                                                        <h3 class="payment-accordion-toggle changePayType"><label><input type="radio" class="payType" name="payType"  value="ATM"> ATM匯款</label></h3>
                                                                        <div class="payment-content">
                                                                            <p>系統會提供您專屬個人的匯款帳戶，請盡快匯款，3天後該匯款帳戶會失效，需重新訂購</p>
                                                                        </div>
                                                                        <!-- Accordion end -->
                                                                        <!-- Accordion start -->
                                                                        <h3 class="payment-accordion-toggle changePayType"><label><input type="radio" class="payType" name="payType"  value="CVS">超商代碼</label></h3>
                                                                        <div class="payment-content">
                                                                            <p>系統會提供您所選擇之超商編號，取得編碼後請前往超商相關機台輸入編號取得繳費條碼</p>

                                                                        </div>
                                                                        <!-- Accordion end -->
                                                                        <hr>
                                                                        <button type="submit" data-text="下一步" class="theme-btn btn-style-for">確認結帳</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- check-out end -->
                                            <!-- order-complete start -->
                                            <div class="tab-pane" id="order-complete">
                                                <form action="#">
                                                    <div class="thank-recieve bg-white mb-30">
                                                        <p>Thank you. Your order has been received.</p>
                                                    </div>
                                                    <div class="order-info bg-white text-center clearfix mb-30">
                                                        <div class="single-order-info">
                                                            <h4 class="title-1 text-uppercase text-light-black mb-0">order no</h4>
                                                            <p class="text-uppercase text-light-black mb-0"><strong>m 2653257</strong></p>
                                                        </div>
                                                        <div class="single-order-info">
                                                            <h4 class="title-1 text-uppercase text-light-black mb-0">Date</h4>
                                                            <p class="text-uppercase text-light-black mb-0"><strong>june 15, 2016</strong></p>
                                                        </div>
                                                        <div class="single-order-info">
                                                            <h4 class="title-1 text-uppercase text-light-black mb-0">Total</h4>
                                                            <p class="text-uppercase text-light-black mb-0"><strong>$ 170.00</strong></p>
                                                        </div>
                                                        <div class="single-order-info">
                                                            <h4 class="title-1 text-uppercase text-light-black mb-0">payment method</h4>
                                                            <p class="text-uppercase text-light-black mb-0"><a href="#"><strong>check payment</strong></a></p>
                                                        </div>
                                                    </div>
                                                    <div class="shop-cart-table check-out-wrap">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-sm-12">
                                                                <div class="our-order payment-details pr-20">
                                                                    <h4 class="title-1 title-border text-uppercase mb-30">our order</h4>
                                                                    <table>
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
                                                                    <h4 class="title-1 title-border text-uppercase mb-30">payment method</h4>
                                                                    <div class="payment-accordion">
                                                                        <!-- Accordion start  -->
                                                                        <h3 class="payment-accordion-toggle active">Direct Bank Transfer</h3>
                                                                        <div class="payment-content default">
                                                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
                                                                        </div>
                                                                        <!-- Accordion end -->
                                                                        <!-- Accordion start -->
                                                                        <h3 class="payment-accordion-toggle">Cheque Payment</h3>
                                                                        <div class="payment-content">
                                                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                                        </div>
                                                                        <!-- Accordion end -->
                                                                        <!-- Accordion start -->
                                                                        <h3 class="payment-accordion-toggle">PayPal</h3>
                                                                        <div class="payment-content">
                                                                            <p>Pay via PayPal; you can pay with your credit card if you don�t have a PayPal account.</p>
                                                                            <a href="#"><img src="img/payment/1.png" alt="" /></a>
                                                                            <a href="#"><img src="img/payment/2.png" alt="" /></a>
                                                                            <a href="#"><img src="img/payment/3.png" alt="" /></a>
                                                                            <a href="#"><img src="img/payment/4.png" alt="" /></a>
                                                                        </div>
                                                                        <!-- Accordion end -->
                                                                        <button class="button-one submit-button mt-15" data-text="place order" type="submit">place order</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- order-complete end -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection