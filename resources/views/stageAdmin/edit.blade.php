@extends('stageAdmin.layouts.master')

@section('content')
<section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>{{$title}}編輯</strong></h1>
                                    <ul class="controls">

                                        {!! $prevUrl !!}

                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">

                                    
  						 <form name="form" id="serviceForm"  name="serviceForm" action="" method="post" class="form-horizontal" >
 						     <input type="hidden" id="act" value="saveForm" >
                             <input type="hidden" id="editID" name="editID" value="{{$editID}}" > 
                             <input type="hidden" id="tables" name="tables" value="{{$tables}}" >     
                             <input type="hidden" id="types" name="types" value="{{$types}}" >
                                 @foreach ($setColData as $col)

                                         {!! $col !!}


                                        <hr class="line-dashed line-full">
                                      @endforeach 
                                       


                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <button type="reset" class="btn btn-lightred">重製</button>
                                                <button type="submit" id="submitBut" class="btn btn-default">確定送出</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                                <!-- /tile body -->

                            </section>
@endsection