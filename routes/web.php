<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \App\Http\Controllers\httpFunction as httpFunction;
use \App\Http\Controllers\ajaxFunction as ajaxFunction;
use \App\Http\Controllers\uploadFunction as uploadFunction;
use \App\Http\Controllers\member\Controller as memberFunction;
use Illuminate\Support\Facades\Route;



//==========================================================================================================
//==========================================================================================================

//首頁
Route::get('/', 'Controller@index');

//最新消息
Route::get('/news/{page?}/{category?}', 'Controller@news');

//最新消息-內頁
Route::get('/new/{guid?}', 'Controller@newsDetail');

//ABOUT
Route::get('/about', 'Controller@about');

//作品
Route::get('/works/{page?}/{category?}/{subCategory?}', 'Controller@works');

//作品-內頁
Route::get('/work/{guid?}', 'Controller@worksDetail');

//相簿
Route::get('/gallery', 'Controller@gallery');

//加入會員
Route::get('/register', 'Controller@register');

//發送完畢
Route::get('/send/{type?}', 'Controller@sendMsg');

//啟用會員
Route::get('/checkMember/{codes}', 'Controller@checkMember');

//購物列表
Route::get('/car', 'Controller@car');
Route::get('/checkout', 'Controller@checkout');
Route::get('/pay', 'Controller@pay');
Route::post('/payEnd', 'Controller@payEnd');
Route::get('/complete', 'Controller@complete');
Route::post('/payRe', 'Controller@payRe');

//登入
Route::get('/login', 'Controller@login');

//聯絡我們
Route::get('/contact', 'Controller@contact');

//會員專區
Route::get('/my-account', 'Controller@myAccount');

//修改基本資料
Route::get('/my-profile', 'Controller@myProfile');
//修改密碼
Route::get('/my-password', 'Controller@myPassword');
//會員登出
Route::get('/logout', 'Controller@logout');

//==========================================================================================================
//==========================================================================================================








/***
 * 後台介面
 */

Route::get('/stageAdmin',function(){
	
	 $data = array();
     $data["title"] = "管理後台";

	$data['open_no'] = '';
	$data['productCategorys'] = httpFunction::dataCategorys('product_categorys' , 'Y' , '=' , 0 , 'tw');//第一層分類

    //判斷登入
    if(Session::has('admin_id'))
    {
		$data['adminMenu'] = httpFunction::adminMenu('Y');
        return view('stageAdmin.index' , $data);
    }
    else
    {
		
		$data['keepUsername'] = '';
		if(Cookie::has('keepUsername'))
		{
			$data['keepUsername'] = Cookie::get('keepUsername');
		}

		$data["title"] = "Login";
        return view('stageAdmin.loginFrom',$data);
    }
});


/***
 * 後台介面(參數)
 */

Route::get('stageAdmin/{uri}/{types?}/{id?}',function($uri, $types  = null , $id = null ){
	
	if($uri == "logout")
	{
		Session::forget('admin_id');
		return redirect('stageAdmin');//轉跳頁面
		exit;
	}

	$data = array();


	$colData = array();

	//取得資料
	if($types != null)
	{
		$data = DB::select('select * from admin_menu where types = ?', array($types));
		$data = (array)$data[0];
	}
	$data['productCategorys'] = httpFunction::dataCategorys('product_categorys' , 'Y' , '=' , 0 , 'tw');//第一層分類

	//$data["title"] = "管理後台";
	$valData = array();//修改用
	$useColData = array();//列表用
	$listColumns = '';//列表用

	$data['prevUrl'] = '';//回上層用
	$data['adminMenu'] = httpFunction::adminMenu('Y');//後台選單
	$colData = httpFunction::getTableColumns($data["tables"]);

	$data['colData'] = $colData;
	//新增修改時使用，取得欄位相關資料，以利建立欄位
	if($uri == "edit")
	{
		$data['editID'] = '';

		//有傳入鍵值
		if($id != null)
		{
			$valDataTemp = DB::select('select * from '.$data["tables"].' where guid = ?', array($id));
			//$valDataTemp = (array)$valDataTemp;
			$valData = array();

			for($ii=0;$ii<count($valDataTemp);$ii++)
			{
				$tempData = (array)$valDataTemp[$ii];

				if(!isset($tempData["lang"]))
				{
					$tempData["lang"] = $_ENV["LANG"];
				}
				if($data["tables"] == 'admin_account')
				{
					session(['edit_admin_id' => $tempData["admin_id"]]);//紀錄session
				}

				$valData[$tempData["lang"]] = $tempData;
			}

		

			$data['editID'] = $id;
		}
		if($data['have_list'] == 'Y')
		{
			$data['prevUrl'] = '<li class=""><a href="/stageAdmin/list/'.$data['types'].'" tabindex="0" class="tile-close"><i class="fa fa-arrow-left"></i>返回列表</a></li>';
		}

		$colData = httpFunction::getTableColumns($data["tables"],'Y');//格式化,僅取得欄位對應的名稱



		$setColData = httpFunction::setColumns($colData,$valData ,$data["tables"]);
		$data['setColData'] = $setColData;
	}
	if($uri == "list")
	{
		$data['nextID'] = '';


		$useColData = httpFunction::useColumns($colData);
		$data['useColData'] = $useColData;
		for($ii=0;$ii<count($useColData);$ii++) {
			$listColumns .= '{ "data": "' . $useColData[$ii]["Field"] . '" },';
		}

		$data['listColumns'] = $listColumns;

		//有傳入鍵值
		if($id != null)
		{
			$data['nextID'] = $id;
			$data['prevUrl'] = '<li class=""><a href="/stageAdmin/list/productCategorys" tabindex="0" class="tile-close"><i class="fa fa-arrow-left"></i>返回列表</a></li>';
		}



	}

	 //判斷登入
    if(Session::has('admin_id'))
    {		
		if(!empty($uri))
		{				
			 return view('stageAdmin.'.$uri , $data);			
		}
		else
		{				
		     return view('stageAdmin.index',$data);			
		}		
    }
    else
    {
	
         return redirect('stageAdmin');//轉跳頁面
		 exit;
    }
	
});

//呼叫AJAX
Route::post('ajax/create', 'ajaxFunction@index');



/***
 * Ajax(會員帳號)
 */
Route::get('/ajax/ckAccount', function() {
	$username = $_GET['username'];
	$getData = DB::select("select id from member where  username=? " , array($username ));
	if(count($getData) > 0)
	{
		$re = "false";
	}
	else
	{
		$re = "true";
	}
	return $re;
});
/**
 * 列表資料
 */
Route::post('ajax/list', function() {

	$dataType = Request::all();
	$re = httpFunction::setListData((array)$dataType);
	return $re;
});

/**
 * 上傳檔案或圖片等
 */
Route::post('upload/{types}', function($types) {

	$getData = Request::all();


	switch($types)
	{
		case "images":
			$re = uploadFunction::imagesUpload($getData);
			break;
		case "files":
			$re = uploadFunction::filesUpload($getData);
			break;
	}
	return $re;
});

