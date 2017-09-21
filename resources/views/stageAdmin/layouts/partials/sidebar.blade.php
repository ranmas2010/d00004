<aside id="sidebar">


    <div id="sidebar-wrap">

        <div class="panel-group slim-scroll" role="tablist">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#sidebarNav">
                            系統選單 <i class="fa fa-angle-up"></i>
                        </a>
                    </h4>
                </div>
                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">


                        <!-- ===================================================
                        ================= NAVIGATION Content ===================
                        ==================================================== -->
                        <ul id="navigation">

                            @foreach ($adminMenu as $val)
                                <li>
                                    <a role="button" tabindex="0"><i class="fa {{$val['icon']}}"></i> <span>{{$val['title']}}</span></a>
                                    <ul>
                                        {!! $val['subList'] !!}
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                        <!--/ NAVIGATION Content -->


                    </div>
                </div>
            </div>
            
         
        </div>

    </div>


</aside>