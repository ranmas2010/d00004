@extends('home.layouts.master')


@section('content')
 
        <!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg);">
    <div class="auto-container">
        <div class="inner-box">
            <h1>修改密碼</h1>
            <ul class="bread-crumb">
                <li><a href="/">Home</a></li>
                <li><a href="/my-account">會員專區</a></li>
                <li>修改密碼</li>
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
                        <form method="post" action="" id="pwdFrom" name="pwdFrom">
                            <input type="hidden" name="editID"  value="{{$memberData->guid}}">

                            <div class="form-group">
                                <input type="password" name="old_password" id="old_password" required placeholder="舊密碼 *" value="">
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_password" id="new_password" placeholder="新密碼 *" value="">
                                <div class="_formErrorMsg"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="chk_password" id="chk_password" placeholder="請在輸入一次密碼 *" value="">
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