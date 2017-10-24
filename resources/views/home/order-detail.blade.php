@extends('home.layouts.master')


@section('content')

        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>訂單資訊</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>訂單詳細內容</li>
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
                    <hr>
                    <!-- order-complete start -->
                    <div class="shopping-cart-area  pt-80 pb-80">
                        <div class="tab-pane active" id="order-complete">
                            <form action="#">

                                <div class="order-info bg-white text-center clearfix mb-30">
                                    <div class="single-order-info">
                                        <h4 class="title-1 text-uppercase text-light-black mb-0">訂單編號</h4>
                                        <p class="text-uppercase text-light-black mb-0"><strong>{{$order['or_no']}}</strong></p>
                                    </div>
                                    <div class="single-order-info">
                                        <h4 class="title-1 text-uppercase text-light-black mb-0">訂單日期</h4>
                                        <p class="text-uppercase text-light-black mb-0"><strong>{{substr($order['date'],0,10)}}</strong></p>
                                    </div>
                                    <div class="single-order-info">
                                        <h4 class="title-1 text-uppercase text-light-black mb-0">總金額</h4>
                                        <p class="text-uppercase text-light-black mb-0"><strong>$ {{$order['total_price']}}</strong></p>
                                    </div>


                                </div>

                                <div class="order-info bg-white text-center clearfix mb-30">
                                    <div class="single-order-info">
                                        <h4 class="title-1 text-uppercase text-light-black mb-0">付款方式</h4>
                                        <p class="text-uppercase text-light-black mb-0"><a href="#1"><strong>{{$order['payTypeText']}}</strong></a></p>
                                    </div>


                                    <div class="single-order-info">
                                        @if($order['payType'] == 'ATM')
                                            <div >
                                                <div class="text-left">繳款銀行代碼：<a href="#1"><b>{{$order['payData']->BankCode}}</b></a></div>
                                                <div class="text-left">繳款銀行名稱：<a href="#1"><b>{{$order['payData']->bank_title}}</b></a></div>
                                                <div class="text-left">繳款帳號：<a href="#1"><b>{{$order['payData']->vAccount}}</b></a></div>
                                                <div class="text-left">繳費期限：<a href="#1"><b>{{$order['payData']->ExpireDate}}</b></a></div>
                                            </div>
                                        @endif
                                        @if($order['payType'] == 'CVS')
                                            <div>
                                                <div class="text-left">繳費代碼：<a href="#1"><b>{{$order['payData']->PaymentNo}}</b></a></div>
                                                <div class="text-left">繳費期限：<a href="#1"><b>{{$order['payData']->ExpireDate}}</b></a></div>
                                            </div>
                                        @endif
                                    </div>


                                </div>



                                <div class="shop-cart-table check-out-wrap">

                                    <!-- payment-method -->
                                    <div class="col-md-6 col-sm-6 col-sm-12 mt-xs-30">
                                        <div class="payment-method  pl-20">
                                            <h4 class="title-1 title-border text-uppercase mb-30" style="padding-bottom: 10px;">基本資料</h4>
                                            <div class="payment-accordion" >

                                                <!-- Accordion start  -->
                                                <h3 >訂單狀態：{{$order['statusText']}}</h3>
                                               @if($order['company'] != '')
                                                <div class="payment-content default">
                                                    <p>公司名稱：{{$order['company']}}</p>
                                                </div>
                                                @endif
                                                <div class="payment-content default">
                                                    <p>姓名：{{$order['name']}}</p>
                                                </div>
                                                <div class="payment-content default">
                                                    <p>地址：({{$order['zip']}}){{$order['city']}}{{$order['district']}}{{$order['address']}}</p>
                                                </div>
                                                <div class="payment-content default">
                                                    <p>E-mail：{{$order['email']}}</p>
                                                </div>
                                                <div class="payment-content default">
                                                    <p>聯絡電話：{{$order['phone']}}</p>
                                                </div>
                                                <div class="payment-content default">
                                                    <p>行動電話：{{$order['mobile']}}</p>
                                                </div>
                                                <div class="payment-content default">
                                                    <p>備註說明：{{$order['notes']}}</p>
                                                </div>
                                                <!-- Accordion end -->

                                            </div>
                                        </div>
                                    </div>

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

                                                    @if(count($order_spec) >0)
                                                        @foreach ($order_spec as $col)
                                                            <tr>
                                                                <td><a href="/work/{{$col->puid}}" target="_blank">{{$col->title}}</a>  x {{$col->qty}}</td>
                                                                <td class="text-right">${{$col->qty * $col->price}}</td>
                                                            </tr>
                                                        @endforeach
                                                        @endif
                                                    @if(!empty($order['fare_price']) && $order['fare_price'] > 0)
                                                    <tr>
                                                        <td>運費</td>
                                                        <td class="text-right">${{$order['fare_price']}}</td>
                                                    </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- order-complete end -->
                    <div class="col-md-12 col-sm-6 col-sm-12 text-center">
                        <button type="button" class="theme-btn btn-style-one" onclick="window.location.href='/my-order'">返回訂單列表</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection