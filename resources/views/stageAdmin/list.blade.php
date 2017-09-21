@extends('stageAdmin.layouts.master')

@section('content')
<section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>{{$title}}管理</strong></h1>
                                    <ul class="controls">
                                        {!! $prevUrl !!}
                                        <li style="background-color: #666666; color: #FF0000;">
                                            <a href="/stageAdmin/edit/{{$types}}" role="button" tabindex="0" id="add-entry" style="color: #FFFFFF;"><i class="fa fa-plus mr-5"></i>新增</a>
                                        </li>
                                        <li style="background-color: #992200; color: #FF0000;">
                                            <a href="#1" role="button" id="delAll" tabindex="0" style="color: #FFFFFF;"><i class="fa fa-times mr-5"></i>刪除勾選資料</a>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /tile header -->
    <input type="hidden" id="tables"  value="{{$tables}}">
    <input type="hidden" id="types" value="{{$types}}">
    <input type="hidden" id="sortKey" value="0">
    <input type="hidden" name="listColumns" id="listColumns" value='{!!$listColumns!!}'>
    <input type="hidden"  id="nextID" value="{{$nextID}}">
                                <!-- tile body -->
                                <div class="tile-body">
                                    @if($tables == 'product')
                                    <div style="padding-bottom: 10px; float: right;" >
                                        分類篩選:
                                        <label>
                                        <select name="searchRank" id="searchRank" class="form-control input-sm">
                                            <option value="">請選擇</option>
                                            @foreach ($productCategorys as $col)
                                            <option value="{{$col['title']}}" disabled>{{$col['title']}}</option>
                                                @foreach ($col['next'] as $sub)
                                                    <option value="{{$sub->title}}" > └{{$sub->title}}</option>
                                                @endforeach

                                            @endforeach
                                        </select>
                                        </label>
                                    </div>
                                    @endif


                                    <div class="table-responsive">




                                                    <table class="table table-custom dataTable no-footer" id="myTable" role="grid" aria-describedby="editable-usage_info">
                                            <thead>
                                            <tr role="row">

                                                @foreach ($useColData as $col)
                                                <th class="sorting" tabindex="0" aria-controls="editable-usage" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 351px;">{!!$col['Comment']!!}</th>
                                                @endforeach
                                                <th style="width: 160px;" class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Actions">操作</th></tr>
                                            </thead>
                                            <tbody>
                                            
                                            
                                            



                                            </tbody>
                                        </table></div></div>
                                <!-- /tile body -->

                            </section>

@endsection