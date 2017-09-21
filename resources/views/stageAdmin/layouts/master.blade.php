<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

@include('stageAdmin.layouts.partials.head')

<body id="minovate" class="appWrapper">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- ====================================================
================= Application Content ===================
===================================================== -->
<div id="wrap" class="animsition">
    <!-- ===============================================
    ================= HEADER Content ===================
    ================================================ -->

    @include('stageAdmin.layouts.partials.header')
    <!--/ HEADER Content  -->
    <!-- =================================================
    ================= CONTROLS Content ===================
    ================================================== -->
    <div id="controls">
        <!-- ================================================
        ================= SIDEBAR Content ===================
        ================================================= -->

        @include('stageAdmin.layouts.partials.sidebar')
        <!--/ SIDEBAR Content -->
        <!-- =================================================
        ================= RIGHTBAR Content ===================
        ================================================== -->

        <!--/ RIGHTBAR Content -->
    </div>
    <!--/ CONTROLS Content -->

    <!-- ====================================================
    ================= CONTENT ===============================
    ===================================================== -->
    <section id="content">
            @yield('content')
    </section>
    <!--/ CONTENT -->

</div>
<!--/ Application Content -->

<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->
<script src="/assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
<script src="/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script src="/assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="/assets/js/vendor/d3/d3.min.js"></script>
<script src="/assets/js/vendor/d3/d3.layout.min.js"></script>
<script src="/assets/js/vendor/rickshaw/rickshaw.min.js"></script>
<script src="/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
<script src="/assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="/assets/js/vendor/daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="/assets/js/vendor/flot/jquery.flot.min.js"></script>
<script src="/assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
<script src="/assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>


<script src="/assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>
<script src="/assets/js/vendor/raphael/raphael-min.js"></script>
<script src="/assets/js/vendor/morris/morris.min.js"></script>
<script src="/assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>

<script src="/assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="/assets/js/vendor/datatables/js/jquery.dataTables.js"></script>
<script src="/assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
<script src="/assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="/assets/js/vendor/coolclock/coolclock.js"></script>
<script src="/assets/js/vendor/coolclock/excanvas.js"></script>
<!--/ vendor javascripts -->

<script type="text/javascript" src="/assets/js/timepicker/js/jquery-ui.js"></script>
<script type="text/javascript" src="/assets/js/timepicker/js/jquery-ui-slide.min.js"></script>
<script type="text/javascript" src="/assets/js/timepicker/js/jquery-ui-timepicker-addon.js"></script>


        <script src="/assets/js/validation/jquery.validate.js"></script><!--表單驗證-->
        <script src="/assets/js/validation/messages_zh_TW.js"></script><!--表單驗證-->

<script src="/assets/js/vendor/fancybox/source/jquery.fancybox.js"></script>

<script type="text/javascript" src="/assets/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/assets/js/ckfinder/ckfinder.js"></script>

<!--<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>-->
<script type="text/javascript" src="/assets/js/jquery.dragsort.js"></script>
<!--
<script src="/assets/js/ga_api/Chart.min.js"></script>

<script src="/assets/js/ga_api/view-selector2.js"></script>
<script src="/assets/js/ga_api/date-range-selector.js"></script>
<script src="/assets/js/ga_api/active-users.js"></script>
<script src="/assets/js/gaApi.js"></script>-->
<script src="/js/ajax.js"></script><!--表單驗證-->


<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="/assets/js/main.js"></script>
<!--/ custom javascripts -->








<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->

<!--/ Page Specific Scripts -->




<input type="hidden" id="nowOpenNo" value="{{$open_no}}">

</body>
</html>
