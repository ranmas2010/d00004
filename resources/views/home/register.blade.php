@extends('home.layouts.master')


@section('content')
 
        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>加入會員</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li>加入會員</li>
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
                        <form method="post" action="" id="regiterFrom" name="regiterFrom">

                            <div class="form-group">
                                <input type="email" name="username" id="username" placeholder="帳號 *" required>
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="passwd" id="passwd" placeholder="密碼 *" required>
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="ckPasswd" id="ckPasswd" placeholder="密碼確認 *" required>
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" required placeholder="姓名 *">
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="company" placeholder="公司名稱">
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="市話">
                            </div>

                            <div class="form-group">
                                <input type="text" name="mobile" placeholder="行動電話 *" required>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">

                                <select class="changeCityData" data-next="district"  data-zip="zip" data-type="city"  name="city" id="city" required>
                                    <option value="">縣市 *</option>

                                    @foreach ($city as $col)
                                        <option value="{{$col->city}}">{{$col->city}}</option>
                                    @endforeach
                                </select>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">

                                <select class="changeCityData" data-next=""  data-zip="zip" data-type="district"  name="district" id="district" required>
                                    <option value="">區域 *</option>


                                </select>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="zip" id="zip" placeholder="郵遞區號 *" required>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" placeholder="地址 *" required>
                                <div class="_formErrorMsg"></div>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="newsletter" name="newsletter" >
                                <label for="newsletter"><span>已詳敘閱讀<a href="#" class="text-gray">網站使用條款</a></span></label>
                            </div>


                            {!! app('captcha')->display() !!}
                            <div class="form-group">
                                <button class="theme-btn btn-style-one" type="submit" id="submitBut" name="submit-form">送出</button>
                                <a href="#1" title="使用Facebook帳號登入"><img src="/timthumb.php?src=/images/facebook-sign-in.png&w=300"></a>
                            </div>

                        </form>

                    </div>
                    <!--End Contact Form -->
                </div>
                <!--Time Column-->
                <div class="time-column col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-box">
                        <h3>註冊說明</h3>

                                <div class="day-box">
                                    ※請使用E-mail做為您的帳號<br><br>
                                    ※註冊後必須至您註冊的Email中啟用您的帳號，才能登入喔<br><br>
                                    ※(*)為必填項目，請正確填入，以免影響會員權益<br><br>
                                </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--End Contact Section-->



@endsection