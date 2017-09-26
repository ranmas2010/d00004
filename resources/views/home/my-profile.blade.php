@extends('home.layouts.master')


@section('content')
 
        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>修改基本資料</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li><a href="/my-account">會員專區</a></li>
                <li>修改基本資料</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Contact Section-->
<section class="contact-section">
    <div class="auto-container">

        <!--Form Section-->
        <div class="form-section">
            <div class="row clearfix">
                <!--Form Column-->
                <div class="form-column col-md-8 col-sm-12 col-xs-12">
                    <!-- contact Form -->
                    <div class="contact-form">
                        <!--contact Form-->
                        <form method="post" action="" id="profileFrom" name="profileFrom">
                            <input type="hidden" name="editID"  value="{{$memberData->guid}}">

                            <div class="form-group">
                                <input type="text" name="name" required placeholder="姓名 *" value="{{$memberData->name}}">
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="company" placeholder="公司名稱" value="{{$memberData->company}}">
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="市話" value="{{$memberData->phone}}">
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="mobile" placeholder="行動電話 *" required value="{{$memberData->mobile}}">
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">

                                <select class="changeCityData" data-next="district"  data-zip="zip" data-type="city"  name="city" id="city" required>
                                    <option value="">縣市 *</option>

                                    @foreach ($city as $col)
                                        <option value="{{$col->city}}" @if($memberData->city == $col->city) selected @endif>{{$col->city}}</option>
                                    @endforeach
                                </select>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">

                                <select class="changeCityData" data-next=""  data-zip="zip" data-type="district"  name="district" id="district" required>
                                    <option value="">區域 *</option>

                                    @foreach ($district as $col)
                                        <option value="{{$col->district}}" @if($memberData->district == $col->district) selected @endif>{{$col->district}}</option>
                                    @endforeach

                                </select>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="zip" id="zip" placeholder="郵遞區號 *" required value="{{$memberData->zip}}">
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" placeholder="地址 *" required value="{{$memberData->address}}">
                                <div class="_formErrorMsg"></div>
                            </div>





                            <div class="form-group">
                                <button class="theme-btn btn-style-one" type="submit" id="submitBut" name="submit-form">送出</button>
                            </div>

                        </form>

                    </div>
                    <!--End Contact Form -->
                </div>

            </div>
        </div>

    </div>
</section>
<!--End Contact Section-->



@endsection