
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>LOGIN</title>
        <link rel="icon" type="image/ico" href="/assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/vendor/animate.css">
        <link rel="stylesheet" href="/assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/js/vendor/animsition/css/animsition.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->

    </head>


    <body id="minovate" class="appWrapper">


        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">

            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">Web</span>System</h3></div>

                <div class="container w-420 p-15 bg-white mt-40 text-center">


                    <h2 class="text-light text-greensea">Log In</h2>

                    <form name="form" id="serviceForm"  name="serviceForm" action="" method="post" class="form-validation mt-20" novalidate="">
 						<input type="hidden" id="act" value="login" >
                        <div class="form-group">
                            <input type="text" id="login_admin_id" name="login_admin_id" required class="form-control underline-input" placeholder="Account" value="{{$keepUsername}}">
                        </div>

                        <div class="form-group">
                            <input type="password" id="login_passwd" name="login_passwd" required placeholder="Password" class="form-control underline-input">
                        </div>

                        <div class="form-group">
                            {!! app('captcha')->display() !!}
                        </div>



                        <div class="form-group  mt-20">
                            <button type="submit" id="submitBut" class="btn btn-greensea b-0 br-2 mr-5">登入</button>

                            <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                               <!-- <input type="checkbox" name="keep" id="keep" value="Y"><i></i> 記住我-->
                            </label>

                        </div>

                    </form>

                    <hr class="b-3x">



                    <div class="bg-slategray lt wrap-reset mt-40">
                        <p class="m-0">
                            　
                        </p>
                    </div>

                </div>

            </div>

        </div>
        <!--/ Application Content -->

        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->

       <script src="/assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>

        <script src="/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
        <script src="/assets/js/vendor/jRespond/jRespond.min.js"></script>
        <script src="/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
        <script src="/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
        <script src="/assets/js/vendor/screenfull/screenfull.min.js"></script>
        <!--/ vendor javascripts -->

        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/validation/jquery.validate.js"></script><!--表單驗證-->
        <script src="/assets/js/validation/messages_zh_TW.js"></script><!--表單驗證-->
        <script src="/js/ajax.js"></script><!--表單驗證-->
        <!--/ custom javascripts -->


    </body>
</html>
