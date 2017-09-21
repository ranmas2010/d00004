@extends('stageAdmin.layouts.master')

@section('content')

    <link href="/js/ga_api/index.css" rel="stylesheet">
    <!-- Google Analytics -->
    <script>
        (function(w,d,s,g,js,fs){
            g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
            js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
            js.src='https://apis.google.com/js/platform.js';
            fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
        }(window,document,'script'));
    </script>
    <!-- End Google Analytics -->

    <link rel="stylesheet" href="/js/ga_api/chartjs-visualizations.css">
    <div class="page page-dashboard">

        <div class="pageheader">



            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="/stageAdmin"><i class="fa fa-home"></i> 系統後台</a>
                    </li>
                    <li>
                        <a href="/stageAdmin">首頁</a>
                    </li>
                </ul>

                <div class="page-toolbar">
                    <div tabindex="0" class="btn btn-lightred no-border ">
                        <div id="dateView"></div>
                    </div>
                </div>

            </div>

        </div>




        <!-- row -->
        <div class="row">



            <!-- col -->
            <div class="col-md-12">

                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header bg-greensea dvd dvd-btm">
                        <h1 class="custom-font"><strong>Google </strong>Analytics</h1>
                        <ul class="controls">
                            <li id="date-range-selector-2-container" >
                                <!--  <a role="button" tabindex="0" class="pickDate">
                                      <span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                  </a>-->
                            </li>


                        </ul>
                    </div>
                    <!-- /tile header -->

                    <!-- tile widget -->
                    <div class="tile-widget bg-greensea">

                        <div id="embed-api-auth-container" ></div>
                        <div id="view-selector-container" style="display:none;" ></div>

                        <div  style="height:auto;">


                            <!--<div id="data-chart-1-container"></div>
                            <div id="date-range-selector-1-container"></div>-->

                            <div id="data-chart-2-container"></div>
                        </div>
                    </div>

                    <!-- tile widget -->
                    <div class="tile-widget bg-greensea">
                        <div id="statistics-chart" ></div>
                    </div>
                    <!-- /tile widget -->



                </section>
                <!-- /tile -->

            </div>
            <!-- /col -->



        </div>
        <!-- /row -->











    </div>

@endsection