<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;
use \App\Http\Controllers\httpFunction as httpFunction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ajaxFunction extends BaseController
{

	/**
	 * 建構AJAX
	 * @param Request $request
	 * @return array
	 */
	public function index(Request $request){

		$str = $request;

		$Val = json_decode(urldecode($str["Val"]) , true);
		if($str["Func"] != 'saveSpec')
		{
			$rowData = httpFunction::jsonToArray($Val);
		}
		else
		{
			$rowData = $Val;
		}


		$arr = array("Func" => $str["Func"] , "re" => "");

		//ajax判斷
		switch($str["Func"])
		{
			case "login":
				$reSaveForm = ajaxFunction::loginAdmin($rowData);
				break;
			case "saveForm":
				$reSaveForm = ajaxFunction::saveForm($rowData);
				break;
			case "delPic":
				$reSaveForm = ajaxFunction::delPic($rowData);
				break;
			case "delFiles":
				$reSaveForm = ajaxFunction::delFiles($rowData);
				break;
			case "delData":
				$reSaveForm = ajaxFunction::delData($rowData);
				break;
			case "changeIndex":
				$reSaveForm = ajaxFunction::changeIndex($rowData);
				break;
			case "changeStatus":
				$reSaveForm = ajaxFunction::changeStatus($rowData);
				break;
			case "contact":
				$reSaveForm = ajaxFunction::contact($rowData);
				break;

			case "joinMember":
				$reSaveForm = ajaxFunction::joinMember($rowData);
				break;
			case "changeCityData":
				$reSaveForm = ajaxFunction::changeCityData($rowData);
				break;
			case "webLogin":
				$reSaveForm = ajaxFunction::webLogin($rowData);
				break;
			case "addShopCar":
				$reSaveForm = ajaxFunction::addShopCar($rowData);
				break;

			case "changeQty":
				$reSaveForm = ajaxFunction::changeQty($rowData);
				break;
			case "reAllShopPice":
				$reSaveForm = ajaxFunction::reAllShopPice($rowData);
				break;
			case "orderSave":
				$reSaveForm = ajaxFunction::orderSave($rowData);
				break;

			case "editMember":
				$reSaveForm = ajaxFunction::editMember($rowData);
				break;

			case "editPassword":
				$reSaveForm = ajaxFunction::editPassword($rowData);
				break;
		}

		$arr = array_merge($arr,$reSaveForm);


		return $arr;

	}

	/**
	 * 修改密碼
	 * @param $rowData
	 * @return array
	 */
	public static function editPassword($rowData)
	{

		$re = array('re' => 'N');


		$getData = DB::select("select id from member where guid=? and passwd=? ", array($rowData['editID'],md5($rowData['old_password'])));


		if(count($getData) > 0)
		{
			$passwordData = array('editID' => $rowData['editID'] , 'passwd' => md5($rowData['new_password']));
			 DbFunction::UpdateDB('member' , $passwordData);
			$re['re'] = 'Y';
		}


		return $re;

	}


	/**
	 * 修改基本資料
	 * @param $rowData
	 * @return array
	 */
	public static function editMember($rowData)
	{

		$re = array('re' => 'N');

		$re['re'] = DbFunction::UpdateDB('member' , $rowData);

		//重新讀取

			Session::forget('memberData');
			$getData = DB::select("select * from member where guid=? ", array($rowData['editID']));
			session(['memberData' => $getData[0]]);//紀錄session



		return $re;

	}



	/**
	 * 儲存購物者
	 * @param $rowData
	 * @return array
	 */
	public static function orderSave($rowData)
	{
		$re = array('reset' => 'N');

		session(['shopCarMember' => $rowData]);//紀錄session

		$haveOver = array();//是否已超過庫存

		if(Session::has('shopCar')) {
			$tempData = session('shopCar');

			for ($ii = 0; $ii < count($tempData); $ii++) {
				//再次取得庫存

				$getData = DB::select("select inventory , safe_inventory from product where guid = ?", array($tempData[$ii]['puid']));

				if( ($getData[0]->safe_inventory + $tempData[$ii]['qty']) > $getData[0]->inventory)
				{
					$re['re'] = 'noInventory';
					$re['reQty'] = $getData[0]->inventory - $getData[0]->safe_inventory;
					$haveOver[] = 'N';//超過庫存
				}
				else{
					$haveOver[] = 'Y';//可結帳
				}

			}



			//已超過庫存
			if(in_array('N',$haveOver))
			{
				$re['reset'] = 'Y';
			}


		}



		return $re;
	}


	/**
	 * 及時更換購物總計
	 * @param $rowData
	 * @return mixed
	 */
	public  static function reAllShopPice($rowData)
	{
		//取購物車資訊---------------------------------------------
		$shopData = httpFunction::getShopList();
		$data['shopList'] = $shopData["shopList"];
		$data['shopTotalPrice'] = $shopData["totalPrice"];
		$data['shopTotalQty'] = $shopData["totalQty"];
		//取購物車資訊 END-----------------------------------------
		$data['shopTotalPriceAndFare'] = 0;//含運費總金額
		$data['fare'] = 0;//運費
		$data['fareText'] = '';//運費敘述

		$data['discountTitle'] = '';//活動名稱
		$data['discountPrice'] = 0;//折扣金額

		if(Session::has('shopCar')) {


			$data['shopTotalPriceAndFare'] = $shopData["totalPrice"];//含運費總金額

			/*$disCountData = httpFunction::disCountCalculation($rowData['store_id'], $shopData["totalPrice"]);//優惠計算

            $data['shopTotalPriceAndFare'] = $disCountData['rePrice'];
            $data['discountTitle'] = $disCountData['discountTitle'];//活動名稱
            $data['discountPrice'] = $disCountData['discountPrice'];//折扣金額
            */
			$fareData = httpFunction::fareCalculation($data['shopTotalPriceAndFare']);//運費計算

			$data['shopTotalPriceAndFare'] = $fareData["shopTotalPriceAndFare"];//含運費總金額
			$data['fare'] = $fareData["fare"];//運費
			$data['fareText'] = $fareData["fareText"];//運費敘述
		}


		return $data;
	}




	/**
	 * 更改購物數量
	 * @param $rowData
	 * @return array
	 */
	public static function changeQty($rowData)
	{
		$re = array('re'=>'Y' , 'qty' => $rowData['qty'] , 'puid' => $rowData['puid'] , 'model' => $rowData['model'] , 'reQty' => '0' , 'reSubTotal' => '');

		//判斷是否超過庫存
		$getData = DB::select("select inventory,safe_inventory from product where guid = ?  " , array($rowData["puid"]));


		//超過庫存
		if( ($getData[0]->safe_inventory + $rowData['qty']) > $getData[0]->inventory)
		{
			$re['re'] = 'noInventory';
			$re['reQty'] = $getData[0]->inventory - $getData[0]->safe_inventory;
			$rowData['qty'] = $re['reQty'];
		}

		//購物車更動數量
		if($rowData['model'] == 'car')
		{
			$newSave = array();

			if(Session::has('shopCar'))
			{
				$tempData = session('shopCar');

				for($ii=0;$ii<count($tempData);$ii++)
				{
					if($tempData[$ii]['puid'] == $rowData['puid'] )
					{
						$tempData[$ii]['qty'] = $rowData['qty'];
						$re["reSubTotal"] = $rowData['qty'] * $tempData[$ii]['price'];
					}


					$newSave[] = $tempData[$ii];//新紀錄
				}
			}

			if(count($newSave) > 0)
			{
				session(['shopCar' => $newSave]);//紀錄session
			}
		}


		return $re;
	}


	/**
	 * 加入購物車
	 * @param $rowData
	 * @return array
	 */
	public static function addShopCar($rowData)
	{
		$re = array('re' => 'Y');
		$shopCar = array();
		//已有購物紀錄
		if(Session::has('shopCar'))
		{
			$shopCar = session('shopCar');
			$canAdd = "Y";
			for($ii=0;$ii<count($shopCar);$ii++)
			{
				if($rowData["puid"] == $shopCar[$ii]['puid'])
				{
					$canAdd = "N";

				}

			}

			if($canAdd == "Y")
			{
				//取得商品相關資訊
				$getData = DB::select("select price from product where guid = ?  " , array($rowData["puid"]));
				$rowData['price'] = $getData[0]->price;
				$shopCar[] = $rowData;
				session(['shopCar' => $shopCar]);//紀錄session

			}


		}
		//尚無紀錄
		else
		{
			//取得商品相關資訊
			$getData = DB::select("select price from product where guid = ?  " , array($rowData["puid"]));
			$rowData['price'] = $getData[0]->price;

			$shopCar[] = $rowData;
			session(['shopCar' => $shopCar]);//紀錄session
			$canAdd = 'Y';
		}


		if($canAdd == "Y")
		{

			//取得此次加入的商品資料
			$getData = DB::select("select title,pic,price,category from product where guid = ?  " , array($rowData["puid"]));

			$vPic = '';
			$vPrice = $getData[0]->price;
			$specTitle = '';
			if($getData[0]->pic != '')
			{
				$picArr = explode(',',$getData[0]->pic);
				$vPic = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=80&w=80';

			}
			else
			{
				$vPic = '/timthumb.php?src=/images/noPic.png&h=80&w=80';
			}

			/*if(!empty($rowData["spec"]))
			{
				//取得規格價格
				$specData = DB::select("select title,price from sub_product_spec where spec = ? and store_id = ?  " , array($rowData["spec"],$rowData["store_id"]));

				if(count($specData) > 0) {

					$specTitle = '<p class="mb-0">規格 : '. $specData[0]->title.' </p>';
					$vPrice = $specData[0]->price;

				}
			}*/

			$re['append'] = '<div class="single-cart clearfix" id="_shopData'.$rowData["puid"].'">
																	<div class="cart-photo">
																		<a href="/work/'.$rowData["puid"].'" title="'.$getData[0]->title.'"><img src="'.$vPic.'" alt="'.$getData[0]->title.'"></a>
																	</div>
																	<div class="cart-info">
																		<h5><a href="/work/'.$rowData["puid"].'" title="'.$getData[0]->title.'">'.mb_substr($getData[0]->title,0,10).'...</a></h5>
																		<p class="mb-0">單價 : NT$ '.$vPrice.'</p>
																		<p class="mb-0">數量 : '.$rowData["qty"].' </p>																		
																		<span class="cart-delete"><a href="#1" class="delShopCar" data-puid="'.$rowData["puid"].'" ><i class="fa fa-times fa-3" aria-hidden="true"></i></a></span>
			
																	</div>
																</div>';

		}


		$re['totalPrice'] = 0;
		//計算總金額
		for($ii=0;$ii<count($shopCar);$ii++) {



			$re['totalPrice'] += ($shopCar[$ii]['qty'] * $shopCar[$ii]['price']);

		}
		$re["count"] = count($shopCar);


		return $re;

	}

	/**
	 * 使用者會員登入
	 * @param $rowData
	 * @return array
	 */
	public static function webLogin($rowData)
	{

		$re = array('re' => 'N');

		//驗證
		$rules = array(
			'g-recaptcha-response' => 'required|captcha',
		);
		$validator = Validator::make($rowData, $rules);
		$isCAPTCHA = $validator->fails();//沒勾選:true,勾選:false

		//判斷驗證碼
		if(!$isCAPTCHA) {

			$getData = DB::select("select * from member where username=? and passwd=? ", array($rowData['username'], md5($rowData['passwd'])));

			if (count($getData) > 0) {
				$re['re'] = 'Y';
				session(['memberData' => $getData[0]]);//紀錄session
			}
			else
			{
				$re['re'] = 'error';
			}
		}
		return $re;
	}

	/**
	 * 動態取得縣市區域郵遞區號
	 * @param $rowData
	 * @return array
	 */
	public static function changeCityData($rowData)
	{

		$re = array('reList' => '' , 'reZip' => '' , 'nextID' => $rowData['nextID'], 'zipID' => $rowData['zipID']);

		if($rowData['Type'] == 'city') {
			$sql = 'select district,zip from taiwan_city where city=? order by zip asc';

			$getData = DB::select($sql, array($rowData['id']));
		}
		else
		{
			$sql = 'select district,zip from taiwan_city where district=?  order by zip asc';

			$getData = DB::select($sql, array($rowData['id']));
		}


		if(count($getData) > 0)
		{
			for($ii=0;$ii<count($getData);$ii++)
			{
				if($ii == 0)
				{
					$re['reZip'] = $getData[$ii]->zip;
				}

				$re['reList'] .= '<option value="'.$getData[$ii]->district.'">'.$getData[$ii]->district.'</option>';
			}
		}


		return $re;

	}


	/**
	 * 加入會員
	 * @param $rowData
	 * @return array
	 */
	public static function joinMember($rowData)
	{

		$re = array('re' => 'N');
		//驗證
		$rules = array(
			'g-recaptcha-response' => 'required|captcha',
		);
		$validator = Validator::make($rowData, $rules);
		$isCAPTCHA = $validator->fails();//沒勾選:true,勾選:false

		//判斷驗證碼
		if(!$isCAPTCHA) {

			$rowData["passwd"] = md5($rowData["passwd"]);
			$rowData["date"] = date('Y-m-d H:i:s');
			$rowData["mail_key"] = base64_encode($rowData["username"] .'_'. $rowData["date"]);

			$rowData["guid"] = httpFunction::getGUID();

			$reData = DbFunction::InsertDB('member', $rowData);

			if ($reData['re'] == 'Y') {

				$re["re"] = 'Y';
				$checkUrl = '//' . $_SERVER["SERVER_NAME"].'/checkMember/'.$rowData["mail_key"] ;

				//發信

				$webData = httpFunction::webData('tw');
				$body = '<h2>會員驗證信</h2><hr/>'
					. '連結: <a href="'.$checkUrl.'">'.$checkUrl.'</a><br />';


				$reSend =  httpFunction::sendEmail($rowData["username"], $webData["title"], $webData["get_email"], $webData["title"], $body, '會員驗證信');

			}
		}

		return $re;

	}


	/**
	 * 登入判斷
	 * @param $rowData
	 * @return array
	 */
	public static function loginAdmin($rowData)
    {
		$re = array('re' => 'N');
		//驗證
		$rules = array(
			'g-recaptcha-response' => 'required|captcha',
		);
		$validator = Validator::make($rowData, $rules);
		$isCAPTCHA = $validator->fails();//沒勾選:true,勾選:false

		//判斷驗證碼
		if(!$isCAPTCHA)
		{
			$users = DB::table('admin_account')->where([
				['admin_id', '=', $rowData["login_admin_id"]],
				['passwd', '=', md5($rowData["login_passwd"])],
			 ])->get();

			if(count($users) !=0)
			{
				session(['admin_id' => $rowData["login_admin_id"]]);//紀錄session

				if(!empty($rowData["keep"]) && $rowData['keep'] == 'Y')
				{
					//setcookie("keepUsername",$rowData["login_admin_id"],time()+3600*24*30);

					//$response = Response::make('keepUsername');
					//$response->withCookie(Cookie::make('keepUsername', $rowData["login_admin_id"], time()+3600*24*30));
					Cookie::forever('keepUsername', $rowData["login_admin_id"]);

				}


				$re['re'] = 'Y';
			}
		}
		else
		{
			$re['re'] = 'codeErr';
		}
		
		return $re;

	}


	/**
	 * 新增修改資料
	 * @param $rowData
	 * @return array
	 */
	public static function saveForm($rowData)
    {

		$re = array('types' => $rowData["types"] , 'nextID' => '');
		if(!empty($rowData['category']))
		{
			$re['nextID'] = $rowData['category'];
		}

		//有勾選的語系
		$isUseLang = array();

		if(empty($rowData["lang"]))
		{

			$isUseLang = array($_ENV['LANG']);
		}
		else
		{
			$isUseLang =  explode(",",substr($rowData["lang"],0,-1));

		}


		unset($rowData["lang"]);

		//取得使否使用語系
	/*	$menuData = DB::select('select id from admin_menu where tables = ? and use_lang = ?' , array($rowData["tables"] , 'Y'));
		$use_lang = count($menuData);*/



		$saveData = array();

		/*if($use_lang > 0)
		{*/
					//重整語系資訊
					for($ss=0;$ss<count($isUseLang);$ss++) {

						//有勾選的才加入
							$tempData = array();
							if(empty($rowData["editID"])) {

								$tempData["guid"] = httpFunction::getGUID();
							}
						$tempData['lang'] = $isUseLang[$ss];
							foreach ($rowData as $key => $value) {

								if($key == "passwd")
								{
									$value = md5($value);
								}


								if (strstr($key, $isUseLang[$ss])) {
									$tempData[str_replace('_' . $isUseLang[$ss], "", $key)] = $value;
									//unset($tempData[$key]);
								} else {
									$tempData[$key] = $value;
								}

							}

							$saveData[$isUseLang[$ss]] = $tempData;
						//}
					}
		//}



		//新增
		if(empty($rowData["editID"]))
		{

			/*if($use_lang > 0) {*/
				foreach ($saveData as $key => $value) {



					$re['re'] = DbFunction::InsertDB($rowData["tables"], $saveData[$key]);
				}
					/*
			}
        else
        {
            $re['re'] = DbFunction::InsertDB($rowData["tables"], $rowData);

        }*/

			$re['reID'] = '';
		}
		//修改
		else
		{

			/*if($use_lang > 0)
			{*/
				//檢查該資料是否有該語系
				$langTempData = DB::select('select codes from language where status = ? order by sortIndex asc' , array('Y'));


				for($ii=0;$ii<count($langTempData);$ii++)
				{

					$langData = (array)$langTempData[$ii];


					$tempData2 = DB::select('select id from '.$rowData["tables"].' where guid = ? and lang = ?' , array($rowData["editID"] , $langData["codes"]));
					$dataQty = count($tempData2);




					if($dataQty > 0 )
					{
						$tempData2 = (array)$tempData2[0];
						//資料庫有資料 x 修改無資料 --> 刪除
						if(!in_array($langData["codes"],$isUseLang))
						{
							$delData = array('PK' => 'id' , 'id' =>$tempData2["id"]);
							DbFunction::DeleteDB($rowData["tables"], $delData);

						}
						//資料庫有資料 x 修改有資料 --> 修改
						if(in_array($langData["codes"],$isUseLang) )
						{
							$saveData[$langData["codes"]]["editID"] = (int)$tempData2["id"];
							$re['re'] = DbFunction::UpdateDB($rowData["tables"] , $saveData[$langData["codes"]]);
						}

					}
					else
					{
						if(in_array($langData["codes"],$isUseLang)) {

							//資料庫無資料 x 修改有資料 --> 新增
							$saveData[$langData["codes"]]["guid"] = $rowData["editID"];
							$saveData[$langData["codes"]]["lang"] = $langData["codes"];
							$re['re'] = DbFunction::InsertDB($rowData["tables"], $saveData[$langData["codes"]]);


						}

					}


				}



			/*}
			else
			{
				if(!empty($rowData['passwd']))
				{
					unset($rowData["passwd_chk"]);

					$rowData['passwd'] = md5($rowData['passwd']);
				}
				$re['re'] = DbFunction::UpdateDB($rowData["tables"] , $rowData);
			}*/


			$re['reID'] = $rowData["editID"];
		}



		return $re;
	}

	/**
	 * 刪除圖片
	 * @param $rowData
	 * @return array
	 */
	public static  function delPic($rowData)
	{
		$arr = array();
		$temp = str_replace("_upload/images/","",$rowData["pic"]);
		$pic = explode(".",$temp);
		$re = '';
		if(is_file($rowData["pic"]))
		{
			unlink($rowData["pic"]);
		}

		if(!empty($rowData["editID"]))
		{

			$getData = DB::select('select id,'.$rowData["Field"].' from '.$rowData["tables"].' where guid = ?' , array($rowData["editID"]));


			$reData = (array)$getData[0];

			if(count($reData) != 0)
			{
				$saveArr = array();

				$saveArr[$rowData["Field"]] = str_replace($temp.',',"",$reData[$rowData["Field"]]);//過濾已刪除的圖片
				$saveArr["editID"] = $rowData["editID"];
				$re = DbFunction::UpdateDB($rowData["tables"] , $saveArr);
				
				
			}


		}

		$arr['re'] = $pic[0];
		$arr['reField'] = $rowData["Field"];
		$arr['rePic'] = $temp;
		$arr['act'] = $re;

		return $arr;
	}


	/**
	 * 刪除檔案
	 * @param $rowData
	 * @return array
	 */
	public static  function delFiles($rowData)
	{
		$arr = array();
		$temp = str_replace("_upload/files/","",$rowData["files"]);
		$files = explode(".",$temp);
		$re = '';
		if(is_file($rowData["files"]))
		{
			unlink($rowData["files"]);
		}

		if(!empty($rowData["editID"]))
		{

			$getData = DB::select('select id,'.$rowData["Field"].' from '.$rowData["tables"].' where guid = ?' , array($rowData["editID"]));


			$reData = (array)$getData[0];

			if(count($reData) != 0)
			{
				$saveArr = array();

				$saveArr[$rowData["Field"]] = str_replace($temp.',',"",$reData[$rowData["Field"]]);//過濾已刪除的圖片
				$saveArr["editID"] = $rowData["editID"];
				$re = DbFunction::UpdateDB($rowData["tables"] , $saveArr);


			}


		}

		$arr['re'] = $files[0];
		$arr['reField'] = $rowData["Field"];
		$arr['reFiles'] = $temp;
		$arr['act'] = $re;

		return $arr;
	}


	/**
	 * 刪除資料
	 * @param $rowData
	 * @return array
	 */
	public static function delData($rowData){


		$Val = explode(",",$rowData["editID"]);

		$picUseArr = explode(",",$_ENV['PIC_COL']);
		$filesUseArr = explode(",",$_ENV['FILES_COL']);

		foreach($Val as $key => $value)
		{

			if($value != "") {


				$delData = array();

				$getData = DB::select('select * from ' . $rowData["tables"] . ' where guid = ?', array($value));
				$tempData = (array)$getData[0];

				//判斷是否擁有圖片欄位
				for ($ss = 0; $ss < count($picUseArr); $ss++) {
					if (!empty($tempData[$picUseArr[$ss]])) {

						//刪除圖片
						$picArr = explode(",", $tempData[$picUseArr[$ss]]);

						for ($p = 0; $p < count($picArr); $p++) {

							if ($picArr[$p] != '') {

								if (is_file("_upload/images/" . $picArr[$p])) {
									unlink("_upload/images/" . $picArr[$p]);
								}
							}
						}

					}
				}

				//判斷是否擁有檔案欄位
				for ($ss = 0; $ss < count($filesUseArr); $ss++) {
					if (!empty($tempData[$filesUseArr[$ss]])) {

						//刪除圖片
						$filesArr = explode(",", $tempData[$filesUseArr[$ss]]);

						for ($p = 0; $p < count($filesArr); $p++) {

							if ($filesArr[$p] != '') {

								if (is_file("_upload/files/" . $filesArr[$p])) {
									unlink("_upload/files/" . $filesArr[$p]);
								}
							}
						}

					}
				}

				$delData['PK'] = "guid";
				$delData['id'] = $value;

				DbFunction::DeleteDB($rowData["tables"], $delData);
			}
		}

		$arr = array('re' => 'Y');

		return $arr;
	}


	/**
	 * 調整排序
	 * @param $rowData
	 * @return mixed
	 */
	public static function changeIndex($rowData)
	{

		$newIndex = 0;

		if($rowData["act"] != 'inputs')
		{
			//上移
			if($rowData["act"] == 'up')
			{
				if($rowData["indexed"] != '0')
				{
					$newIndex =  $rowData["indexed"] - 1;
				}
			}
			//下
			if($rowData["act"] == 'down')
			{
				$newIndex =  $rowData["indexed"] + 1;
			}

		}
		else
		{

			$newIndex =  $rowData["indexed"];
		}

		$saveArr = array('sortIndex' => $newIndex , 'editID' => $rowData['editID']);

		$re = DbFunction::UpdateDB($rowData["tables"] , $saveArr);

		$arr['reID'] = $rowData['editID'];
		$arr['re'] = $newIndex;

		return $arr;

	}

	/**
	 * 修改排序
	 * @param $rowData
	 * @return array
	 */
	public static function changeStatus($rowData){

		$status = 'Y';

		if($rowData["status"] == 'Y')
		{
			$status = 'N';
		}

		$saveArr = array('status' => $status , 'editID' =>  $rowData['editID']);

		$re = DbFunction::UpdateDB($rowData["tables"] , $saveArr);

		return $re;
	}

	/**
	 * 聯絡我們
	 * @param $rowData
	 * @return array
	 */
	public static  function contact($rowData){





		$re = array('re' => 'N');
		//驗證
		$rules = array(
			'g-recaptcha-response' => 'required|captcha',
		);
		$validator = Validator::make($rowData, $rules);
		$isCAPTCHA = $validator->fails();//沒勾選:true,勾選:false

		//判斷驗證碼
		if(!$isCAPTCHA)
		{

			unset($rowData["g-recaptcha-response"]);
			$rowData['guid'] = httpFunction::getGUID();
			$rowData['date'] = date('Y-m-d H:i:s');
			$re['re'] = DbFunction::InsertDB('contact' , $rowData);

			$webData = httpFunction::webData('tw');

			$contents = httpFunction::readFileData(public_path() . '/email/mailer.html');
			$contents = str_replace( '{$use_title}', '線上諮詢',$contents);
			$contents = str_replace( '{$web_url}', "http://".$_SERVER['HTTP_HOST'],$contents);
			$contents = str_replace( '{$web_address}', $webData['address'],$contents);
			$contents = str_replace( '{$web_phone}', $webData['phone'],$contents);
			//$contents = str_replace( '{$web_email}', $webData['email'],$contents);
			foreach($rowData as $key => $value)
			{
				$contents = str_replace( '{$'.$key.'}', $value,$contents);
			}

		      httpFunction::sendEmail($webData["get_email"] ,$webData["title"],$webData["get_email"],$webData["title"],$contents,'線上諮詢訊息');


		}
		else
		{
			$re['re'] = 'codeErr';
		}
		return $re;

	}
}