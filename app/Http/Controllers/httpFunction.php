<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FieldController as FieldController;


class httpFunction extends Controller
{


	/**
	 * 計算運費
	 * @param $totalPrice
	 * @return array
	 */
	public static function fareCalculation($totalPrice)
	{
		$data = array();

		$data['shopTotalPriceAndFare'] = $totalPrice;//含運費總金額
		$data['fare'] = 0;//運費
		$data['fareText'] = '';//運費敘述

		//運費計算
		$sql = 'select * from fare where guid=? ';
		$getData = DB::select($sql,array('1') );

		if(count($getData) > 0)
		{
			//需運費
			if($getData[0]->status != 'N')
			{
				//需運費(有滿額優惠)
				if($getData[0]->status == 'Y') {

					if($totalPrice < $getData[0]->free)
					{
						$data['fare'] = $getData[0]->price;//運費
						$data['shopTotalPriceAndFare'] = $data['shopTotalPriceAndFare'] + $getData[0]->price;

					}
					else
					{
						$data['fareText'] = '<span style="color:#FF0000">(滿 NT$ '.$getData[0]->free.'免運費)</span>';//運費敘述
					}

				}
				//需運費(無滿額優惠)
				else
				{
					$data['fare'] = $getData[0]->price;//運費
					$data['shopTotalPriceAndFare'] = $data['shopTotalPriceAndFare'] + $getData[0]->price;

				}



			}

		}

		return $data;
	}


	/**
	 * 取得購物列表
	 * @return array|Session
	 */
	public static function getShopList()
	{
		$re = array();
		$re['shopList'] = array();
		$re['totalPrice'] = 0;
		$re['totalQty'] = 0;
		$tempData = array();
		if(Session::has('shopCar'))
		{
			$tempData = session('shopCar');

			for($ii=0;$ii<count($tempData);$ii++)
			{
				//取得商品名稱與規格名稱
				$getData = DB::select("select title,pic,price,category,inventory,safe_inventory from product where guid = ?   " , array($tempData[$ii]['puid']));
				$tempData[$ii]["productTitle"] = '';
				$tempData[$ii]["productPic"] = '';
				$tempData[$ii]["productCategory"] = '';
				$tempData[$ii]["specTitle"] = '';
				$tempData[$ii]["specTitleList"] = array();
				$tempData[$ii]["inventory"] = 0;
				$tempData[$ii]["safe_inventory"] = 0;



				if(count($getData) > 0)
				{

					$tempData[$ii]["productTitle"] = $getData[0]->title;
					$tempData[$ii]["price"] = $getData[0]->price;

					$tempData[$ii]["inventory"] = $getData[0]->inventory;
					$tempData[$ii]["safe_inventory"] = $getData[0]->safe_inventory;

					$tempData[$ii]["productCategory"] = $getData[0]->category;

					if($getData[0]->pic != '')
					{
						$picArr = explode(',',$getData[0]->pic);
						$tempData[$ii]["productPic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=80&w=80';

					}
					else
					{
						$tempData[$ii]["productPic"] = '/timthumb.php?src=/images/noPic.png&h=80&w=80';
					}

					//取得規格
					/*if(!empty($tempData[$ii]['spec']))
					{
						$specArr = explode(',',$tempData[$ii]['spec']);

						$specTitleList = array();

						for($ss=0;$ss<count($specArr);$ss++)
						{
							if($specArr[$ss] != "")
							{
								$getData2 = DB::select("select title,category from sub_spec where guid = ?  and store_id = ? " , array($specArr[$ss],$store_id));
								if(count($getData2) > 0)
								{
									//取得規格類別
									$getData3 = DB::select("select title from sub_spec_categorys where guid = ? and store_id = ?  " , array($getData2[0]->category,$store_id));

									if(count($getData3) > 0) {
										$specTitleList[] = $getData3[0]->title.':'.$getData2[0]->title;
									}



								}

							}
						}


						//取得規格價格
						$getData = DB::select("select title,price,inventory,safe_inventory from sub_product_spec where spec = ? and store_id = ?  " , array($tempData[$ii]['spec'],$store_id));

						if(count($getData) > 0) {

							$tempData[$ii]["specTitle"] =  $getData[0]->title;
							$tempData[$ii]["price"] = $getData[0]->price;
							$tempData[$ii]["inventory"] = $getData[0]->inventory;
							$tempData[$ii]["safe_inventory"] = $getData[0]->safe_inventory;

						}

						$tempData[$ii]["specTitleList"] = $specTitleList;

					}*/

				}

				$re['totalPrice'] += ($tempData[$ii]["price"] * $tempData[$ii]["qty"]);
				$re['totalQty'] += $tempData[$ii]["qty"];

			}
		}

		$re['shopList'] = $tempData;
		return $re;

	}

	/**
	 * Json to Array
	 * @param $Val
	 * @return array
	 */
	public static function jsonToArray($Val)
    {

		 $rowData = array();
			for($ii=0;$ii<count($Val);$ii++)
			{
				if(!strstr($Val[$ii]['name'],"[]"))
				{
					$rowData[$Val[$ii]['name']] = $Val[$ii]['value'];
				}
				else
				{
					if($Val[$ii]['name'] != 'lang[]')
					{
						$rowData[str_replace('[]','',$Val[$ii]['name'])] .= $Val[$ii]['value'] . ',';
					}

				}
			}


		return $rowData;

	}

	/**
	 * 取得欄位相關資料
	 * @param $table
	 * @return mixed
	 */
	public static function getTableColumns($table , $set = null)
	{

		$re = DB::select("SHOW FULL COLUMNS FROM `".$table."`");

		if($set == "Y")
		{
			$noUseField = array('guid');
			$colData = $re;



			$re = array();//重製
			for($ii=0;$ii<count($colData);$ii++) {

				$data = (array)$colData[$ii];
				if ($data["Field"] != 'id')
				{
					if ($data["Comment"] != "" && !in_array($data["Field"], $noUseField)) {

						$re[$data["Field"]] = $data["Comment"];
					}
			     }
			}

		}



		return $re;
	}

	/**
	 * 取得使用的列表
	 * @param $colData
	 * @return array
	 */
	public static function useColumns($colData){

		$arr = array('guid','pic','admin_id','name','email','title','category','sortIndex','status','date');
		$re = array();
		$chkCol = array();
		$chkComment = array();
		$ss = 0;

		for($ii=0;$ii<count($colData);$ii++) {

			$data = (array)$colData[$ii];
			$chkCol[] = $data["Field"];
			$chkComment[] = $data["Comment"];
		}




		for($ii=0;$ii<count($arr);$ii++) {

			if(in_array($arr[$ii],$chkCol))
			{
				$arrKey = array_search($arr[$ii],$chkCol);

				$re[$ss]["Field"] = $chkCol[$arrKey];

				if($re[$ss]["Field"] == "guid")
				{
					$re[$ss]["Comment"] = '<input type="checkbox" id="checkAll" value="Y">';
				}
				else
				{

					$re[$ss]["Comment"] = $chkComment[$arrKey];
				}
				$ss++;
			}
		}


		return $re;

	}

	/**
	 * 建立資料輸入欄位
	 * @param $colData
	 * @param $valData
	 * @param $tables
	 * @return array
	 */
	public static function setColumns($colData ,$valData , $tables)
	{
		$re = array();


		$fieldData = FieldController::getFieldType($tables,"");//取得欄位屬性

		//取得語系資料
		$langTopData = DB::select('select codes,title from language where status = ? order by sortIndex asc' , array('Y'));
		$langQty = count($langTopData);//語系數量
		//dd(count($langTopData));

		$menuTopData = DB::select('select use_lang from admin_menu where tables = ? order by sortIndex asc' , array($tables));
		$menuTopData = (array)$menuTopData[0];


		$valQty = 0;
		$defLang = 'tw';
		foreach ($fieldData as $key => $value)
		{
			$addText = '';
			$thisVal = array();//預設值
			$thisAltVal = '';//圖片敘述用預設
			$Comment = $colData[$key];//欄位名稱

			if(count($valData) != 0)
			{
				//$thisVal = $valData[$key];
				foreach ($valData as $langKey => $val)
				{
					$thisVal[$langKey] = $val[$key];
					if($valQty == 0)
					{
						$defLang = $langKey;
						$valQty++;
					}
				}

			}

			$viewVal = '';
			if(count($thisVal) > 0)
			{
				$viewVal = $thisVal[$defLang];
			}



			$fieldValArr = explode(',',$value);//inputType , (n : 必填 , f : 非必填 , r : 唯獨 , d : disable) , find prev table , have first category

			$required = '';
			$requiredtext = '';
			if($fieldValArr[1] == 'n')
			{
				$required = 'required';
				$requiredtext = '<span style="color:#FF0000">*</span>';
			}
			if($fieldValArr[1] == 'r')
			{
				$required = 'readonly';
			}
			if($fieldValArr[1] == 'd')
			{
				$required = 'disable';
			}

			//


			switch ($fieldValArr[0])
			{



				//語系
				case "lang":

					if($menuTopData["use_lang"] == 'Y' && $langQty > 1) {
						//超過兩個語系顯示語系選項
						if ($langQty >= 2) {
							$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">' . $Comment . $requiredtext . '</label>';
							$addText .= '<div class="col-sm-10">';
							for ($ss = 0; $ss < count($langTopData); $ss++) {
								$langData = (array)$langTopData[$ss];

								$checked = '';
								if (empty($viewVal) && $ss == 0) {
									$checked = ' checked';

								} else {
									if (!empty($thisVal[$langData["codes"]])) {
										if ($thisVal[$langData["codes"]] == $langData["codes"]) {
											$checked = ' checked';
										}
									}


								}


								$addText .= '<label class="checkbox checkbox-custom-alt" style="display: inline-block;">
															<input type="checkbox" class="languageCkBox"  ' . $checked . '  id="lang' . $ss . '" name="lang' . $ss . '" value="' . $langData["codes"] . '"><i></i> ' . $langData["title"] . '　
														</label>';
							}

							$addText .= '</div></div>';

						}
					}
					break;


				//文字欄位(無語系)
				case "text":

					$formNotes ='';
					if(!empty($fieldValArr[2]))
					{
						$formNotes = $fieldValArr[2];
					}

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">' . $Comment . $requiredtext . '</label>';

					$addText .= '<div class="col-sm-6">
                                                <input type="text" ' . $required . ' class="form-control" id="' . $key . '" name="' . $key . '" value="' . $viewVal . '">'.$formNotes.'
                                            </div></div>';


					break;


				//文字欄位(有語系)
				case "text_lang":

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">' . $Comment . $requiredtext . '</label>';

					$addText .= '<div class="col-sm-6">';
					for($ss=0;$ss<count($langTopData);$ss++) {
						$langData = (array)$langTopData[$ss];
;
						$display = 'display:none;';
						if(empty($thisVal[$langData["codes"]]) && $ss == 0)
						{
							$display = 'display';
						}

						$viewVal = "";

						if(!empty($thisVal[$langData["codes"]]))
						{
							$viewVal = $thisVal[$langData["codes"]];
							$display = 'display';
						}

						//是否顯示語系標題
						$langTitle = '';
						if($langQty > 1)
						{
							$langTitle = '【'.$langData["title"].'】';
						}

						$addText .= '<span id="'.$langData["codes"].'_'.$key.'_lay" style="'.$display.'">'.$langTitle.'<input type="text" ' . $required . ' class="form-control" id="' . $key . '_'.$langData["codes"].'" name="' . $key. '_'.$langData["codes"].'" value="' . $viewVal . '"></span>';
					}

					$addText .= ' </div></div>';
					break;


				//編輯器
				case "ckeditor":
					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-10">
                                              <textarea id="'.$key.'" name="'.$key.'" class="form-control Ckeditor">'.$viewVal.'</textarea>
                                            </div></div>';
					break;

				//編輯器(語系)
				case "ckeditor_lang":
					/*$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-10">
                                              <textarea id="'.$key.'" name="'.$key.'" class="form-control Ckeditor">'.$viewVal.'</textarea>
                                            </div></div>';*/

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">' . $Comment . $requiredtext . '</label>';

					$addText .= '<div class="col-sm-10">';
					for($ss=0;$ss<count($langTopData);$ss++) {
						$langData = (array)$langTopData[$ss];

						$display = 'display:none;';
						if(empty($thisVal[$langData["codes"]]) && $ss == 0)
						{
							$display = 'display';
						}

						$viewVal = "";
						if(!empty($thisVal[$langData["codes"]]))
						{
							$viewVal = $thisVal[$langData["codes"]];
							$display = 'display';
						}


						//是否顯示語系標題
						$langTitle = '';
						if($langQty > 1)
						{
							$langTitle = '【'.$langData["title"].'】';
						}


						$addText .= '<span id="'.$langData["codes"].'_'.$key.'_lay" style="'.$display.'">'.$langTitle.'<textarea id="' . $key . '_'.$langData["codes"].'" name="' . $key. '_'.$langData["codes"].'"  class="form-control Ckeditor">'.$viewVal.'</textarea></span>';
					}

					$addText .= ' </div></div>';

					break;

				//分類
				case "select":


					$select1 = '';

						if($viewVal  == '0')
						{
							$select1 = 'selected';
						}

					//取得分類資料
					if($fieldValArr[3] == 'A')
					{
						$getData = DB::select('select guid,title from '.$fieldValArr[2].' where 1=1  group by guid order by sortIndex asc' , array(0));
					}
					else
					{
						$getData = DB::select('select guid,title from '.$fieldValArr[2].' where category = ?  group by guid order by sortIndex asc' , array(0));
					}


					$addCategorys = '';
					if($fieldValArr[3] == 'Y')
					{


						$addCategorys = '<option value="0" '.$select1.'>最上層</option>';
					}


					for($ss=0;$ss<count($getData);$ss++) {

						$selData = (array)$getData[$ss];
						$selected = '';
						if($viewVal  == $selData['guid'])
						{
							$selected = 'selected';
						}

						$disabled = '';


						$addCategorys2 = '';
						if($fieldValArr[3] == 'N')
						{
							$disabled = ' disabled';

							//取得分類資料
							$getData2 = DB::select('select guid,title from '.$fieldValArr[2].' where category = ? group by guid order by sortIndex asc' , array($selData['guid']));
							for($aa=0;$aa<count($getData2);$aa++) {

								$selData2 = (array)$getData2[$aa];

								$selected2 = '';
								if($viewVal == $selData2['guid'])
								{
									$selected2 = 'selected';
								}

								$addCategorys2 .= '<option value="'.$selData2['guid'].'" '.$selected2.'>　└'.$selData2['title'].'</option>';


							}

						}


						$addCategorys .= '<option value="'.$selData['guid'].'" '.$selected.$disabled.'>'.$selData['title'].'</option>'.$addCategorys2;



					}




					$addText .= '<div class="form-group"><label class="col-sm-2 control-label">'.$Comment.'<span style="color:#FF0000">*</span></label>';
					$addText .= '<div class="col-sm-6">
                                                <select class="form-control mb-10" '.$required.' id="'.$key.'" name="'.$key.'">									
                                                    <option value="">請選擇</option>
                                                   
                                                 	'.$addCategorys.'
                                                </select> 
                                            </div></div>';
					break;

				//備註欄位 (無語系)
				case "textarea":


					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-6">
                                              <textarea id="'.$key.'" name="'.$key.'" '.$required.' class="form-control" style="height:150px;">'.$viewVal.'</textarea>
                                            </div></div>';
				break;



				//備註欄位 (有語系)
				case "textarea_lang":


					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'</label>';



					$addText .= '<div class="col-sm-6">';
					for($ss=0;$ss<count($langTopData);$ss++) {
						$langData = (array)$langTopData[$ss];

						$display = 'display:none;';
						if($thisVal == '' && $ss == 0)
						{
							$display = 'display';

						}
						if(empty($thisVal[$langData["codes"]]) && $ss == 0)
						{
							$display = 'display';
						}
						$viewVal = "";
						if(!empty($thisVal[$langData["codes"]]))
						{
							$viewVal = $thisVal[$langData["codes"]];
							$display = 'display';
						}


						//是否顯示語系標題
						$langTitle = '';
						if($langQty > 1)
						{
							$langTitle = '【'.$langData["title"].'】';
						}




						$addText .= '<span id="'.$langData["codes"].'_'.$key.'_lay" style="'.$display.'">'.$langTitle.'<textarea id="'.$key. '_'.$langData["codes"].'" name="'.$key. '_'.$langData["codes"].'" '.$required.' class="form-control" style="height:150px;">'.$viewVal.'</textarea></span>';
					}

					$addText .= ' </div></div>';


					break;

				//數字欄位(無語系)
				case "int":

					$formNotes = '';

					if(!empty($fieldValArr[2]))
					{
						$formNotes = '<br>'.$fieldValArr[2];
					}

					if(empty($viewVal))
					{
						$viewVal = 0;
					}



					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">' . $Comment . $requiredtext . '</label>';

					$addText .= '<div class="col-sm-6">
                                                <input type="text" ' . $required . ' class="form-control edit_price" id="' . $key . '" name="' . $key . '" value="' . $viewVal . '">'.$formNotes.'
                                            </div></div>';


					break;
				//狀態(自訂模式)
				case "status2":

					$statusText = explode('/',$fieldValArr[3]);//顯示文字
					$statusVal = explode('/',$fieldValArr[4]);//值

					$addText .= '<div class="form-group"><label class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-10">
                                                <div class="radio">';

					for($ss=0;$ss<count($statusVal);$ss++)
					{
						$checked = '';

						if($viewVal  == '' )
						{
							if($fieldValArr[2] == $statusVal[$ss])
							{
								$checked = 'checked';
							}
						}
						else
						{
							if($viewVal == $statusVal[$ss])
							{
								$checked = 'checked';
							}

						}

						$addText .= '<label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="display: inline-block; padding-right: 10px;">
                                                        <input type="radio" name="'.$key.'" id="'.$key.$ss.'" value="'.$statusVal[$ss].'" '.$checked.'>
                                                       <i></i> '.$statusText[$ss].'
                                                    </label>';

					}
					$addText .= ' </div>
                                            </div></div>';



					break;

				//圖片
				case "images":


					$formNotes ='';
					if(!empty($fieldValArr[2]))
					{
						$formNotes = $fieldValArr[2];
					}

					$output = '';
					if(!empty($viewVal))
					{
						$thisAltVal = $valData[$defLang][$key.'_alt'];
						$picArr = explode(",",substr($viewVal,0,-1));
						$picAltArr = explode("§",str_replace("　","",$thisAltVal));

						for($ss=0;$ss<count($picArr);$ss++)
						{
							$hrmlID =  explode(".",$picArr[$ss]);

							$picAltText = '';
							if(isset($picAltArr[$ss]) && !empty($picAltArr[$ss]))
							{
								$picAltText = $picAltArr[$ss];
							}

							$output .= '<li id="'.$hrmlID[0].'" style="border:1px solid #dbe0e2; width:150px;text-align:center;list-style-type:none;float:left; " >
                                          <h5>'.$picArr[$ss].'</h5>
                                          <img src="/timthumb.php?src=/_upload/images/'.$picArr[$ss].'&h=120&w=120"  title="'.$picArr[$ss].'" alt="'.$picArr[$ss].'" id="'.$hrmlID[0].'_img" onclick="openBigPic(\'/_upload/images/'.$picArr[$ss].'\')" />
                                        
                                          <div  style="text-align:center;padding:5px;" >                                          
                                          敘述：<input type="text" id="pic_alt_'. $hrmlID[0] .'" class="pic_alt_list" style="width:80%"  value="'.$picAltText.'" >
                                          </div>
                                          <div  style="text-align:center;padding:5px;" >
                                             <a href="#1" title="移除" class="delPic" data-value="_upload/images/'.$picArr[$ss].'" data-id="'.$valData[$defLang]['guid'].'" style="padding-right:5px;"><i class="fa fa-times" ></i></a>
                                             <a href="#1" title="放大"  onclick="openBigPic(\'/_upload/images/'.$picArr[$ss].'\')" style="padding-right:5px;"><i class="fa fa-search-plus" ></i></a>
                                             
                                          </div>
                                           <div  style="text-align:center;padding:5px;" >                                          
                                          	<a href="#1" class="movePic" data-value="'. $picArr[$ss] .'" data-act="left" title="左移"><em class="fa fa-arrow-left" style="padding-right:30px;"></em></a>
										  	<a href="#1" class="movePic" data-value="'. $picArr[$ss] .'"  data-act="right" title="右移"><em class="fa fa-arrow-right"></em></a>
                                          </div>
                                          
                                          
                                       </li>';
						}
					}

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-6">
                                                <input type="file" multiple data-value="'.$key.'" class="filestyle imagesUpload" data-buttontext="Find file" data-iconname="fa fa-inbox" id="inputfile_'.$key.'" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                                                <div class="bootstrap-filestyle input-group">                                                
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                <label class="btn btn-default " onclick="getElementById(\'inputfile_'.$key.'\').click();"><span class="glyphicon fa fa-inbox" ></span>選擇圖片</label>
                                                </span></div>'.$formNotes.'
                                          	    <input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$viewVal.'" class="picData" >
                                          	    <input type="hidden" name="'.$key.'_alt" id="'.$key.'_alt" value="'.$thisAltVal.'" >
                                          	    <ul class="items sortablelist" id="v_'.$key.'" style="padding-top:10px;">
                                         		'.$output.'
                                         		</ul>
                                            </div></div>';
					break;

				//狀態
				case "status":

					$ck1 = '';
					$ck2 = '';
 
					if($viewVal  == '' )
					{
						if($fieldValArr[2] == "Y")
						{
							$ck1 = 'checked';
						}
						else
						{
							$ck2 = 'checked';
						}

					}
					else
					{
						if($viewVal == 'Y')
						{
							$ck1 = 'checked';
						}
						else
						{
							$ck2 = 'checked';
						}
					}


					$txt1 = '啟用';
					$txt2 = '停用';

					if(!empty($fieldValArr[3]))
					{
						$txtArr = explode("/",$fieldValArr[3]);
						$txt1 = $txtArr[0];
						$txt2 = $txtArr[1];

					}


					$addText .= '<div class="form-group"><label class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="'.$key.'" id="'.$key.'1" value="Y" '.$ck1.'>
                                                        '.$txt1.'
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="'.$key.'" id="'.$key.'2" value="N" '.$ck2.'>
                                                        '.$txt2.'
                                                    </label>
                                                </div>
                                            </div></div>';
					break;

				//密碼
				case "password":


					$formNotes ='';
					if(!empty($fieldValArr[2]) && $viewVal != '')
					{
						$formNotes = $fieldValArr[2];
					}



					$addText .= ' <div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'<span style="color:#FF0000">*</span></label>';
					$addText .= '<div class="col-sm-6">
                                                <input type="password" required class="form-control" id="'.$key.'" name="'.$key.'" value="">
                                            </div> </div>';

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">密碼確認<span style="color:#FF0000">*</span></label>';
					$addText .= '<div class="col-sm-6">
                                                <input type="password" required class="form-control" id="'.$key.'_chk" name="'.$key.'_chk" value="">
                                           <div></div>'.$formNotes.'
                                            </div></div>';


					break;

				//Email
				case "email":

					$formNotes ='';
					if(!empty($fieldValArr[2]))
					{
						$formNotes = $fieldValArr[2];
					}

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'<span style="color:#FF0000">*</span></label>';
					$addText .= '<div class="col-sm-6">
                                                <input type="email" '.$required.' class="form-control" id="'.$key.'" name="'.$key.'" value="'.$viewVal.'">'.$formNotes.'
                                            </div></div>';


					break;

				//後臺帳號
				case "admin_id":

					$formNotes ='';
					if(!empty($fieldValArr[2]))
					{
						$formNotes = $fieldValArr[2];
					}

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'<span style="color:#FF0000">*</span></label>';
					$addText .= '<div class="col-sm-6">
                                                <input type="text" '.$required.' class="form-control" id="'.$key.'" name="'.$key.'" value="'.$viewVal.'"><div></div>'.$formNotes.'
                                            </div></div>';


					break;

				//聯絡表單用
				case "contactStatus":

					$ck1 = '';
					$ck2 = '';

					if($viewVal == '' || $viewVal == 'Y')
					{
						$ck1 = 'checked';
					}
					if($viewVal == 'N')
					{
						$ck2 = 'checked';
					}

					$addText .= '<div class="form-group"><label class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="'.$key.'" id="'.$key.'1" value="Y" '.$ck1.'>
                                                        已處理
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="'.$key.'" id="'.$key.'2" value="N" '.$ck2.'>
                                                        未處理
                                                    </label>
                                                </div>
                                            </div></div>';
					break;


				//日期
				case "date":

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">' . $Comment . $requiredtext . '</label>';

					$addText .= '<div class="col-sm-6">
                                                <input type="text" ' . $required . ' class="form-control datepicker" id="' . $key . '" name="' . $key . '" value="' .mb_substr($viewVal,0,10) . '">
                                            </div></div>';
					break;



				//檔案上傳
				case "file":


					$output = '';
					if(!empty($viewVal))
					{

							$hrmlID =  explode(".",$viewVal);



							$output .= '<li id="'.$hrmlID[0].'" style="border:1px solid #dbe0e2; width:150px;text-align:center;list-style-type:none;float:left; " >
                                          <h5>'.$viewVal.'</h5>
                                          <a href="/_upload/files/'.$viewVal.'" target="_blank"><img src="/timthumb.php?src=/assets/images/file.png&h=120&w=120"  title="'.$viewVal.'" alt="'.$viewVal.'" id="'.$hrmlID[0].'_files"  /></a>
                                        
                                        
                                          <div  style="text-align:center;padding:5px;" >
                                             <a href="#1" title="移除" class="delFiles" data-value="_upload/files/'.$viewVal.'" data-id="'.$valData[$defLang]['guid'].'" style="padding-right:5px;"><i class="fa fa-times" ></i></a>
                                           
                                          </div>                                          
                                          
                                       </li>';

					}

					$addText .= '<div class="form-group"><label for="input01" class="col-sm-2 control-label">'.$Comment.'</label>';
					$addText .= '<div class="col-sm-6">
                                                <input type="file" data-value="'.$key.'" class="filestyle filesUpload" data-buttontext="Find file" data-iconname="fa fa-inbox" id="inputfile_'.$key.'" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                                                <div class="bootstrap-filestyle input-group">                                                
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                <label class="btn btn-default fileBut" onclick="getElementById(\'inputfile_'.$key.'\').click();"><span class="glyphicon fa fa-inbox" ></span>選擇檔案</label>
                                                </span></div>
                                          	    <input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$viewVal.'" class="filesData" >                                          	   
                                          	    <ul class="items" id="v_'.$key.'" style="padding-top:10px;">
                                         		'.$output.'
                                         		</ul>
                                            </div></div>';


					break;

			}
			$re[] = $addText;

		}



		return $re;

	}

	/**
	 * 取得列表資料(顯示)
	 * @param $dataType
	 * @return array
	 */
	public static function setListData($dataType)
	{

		$needCol = '';

		for($ii=0;$ii<count($dataType["dataObject"][0]['COLUMNS']);$ii++)
		{

			$tempCol = $dataType["dataObject"][0]['COLUMNS'][$ii]['data'];

			if($tempCol == 'modify')
			{
				$needCol .= 'guid as '.$dataType["dataObject"][0]['COLUMNS'][$ii]['data'].',';
			}
			else
			{
				$needCol .= $dataType["dataObject"][0]['COLUMNS'][$ii]['data'].',';
			}


		}

		$needCol = substr($needCol,0,-1);


		$sql = 'select '.$needCol.'  from '.$dataType["Tables"].' where 1=1';
		if(strstr($dataType["Tables"],'_categorys') && strstr($needCol,'category'))
		{
			if(!empty($dataType["NextID"])){
				$sql .= ' and category = '.$dataType["NextID"];
			}
			else
			{
				$sql .= ' and category = 0';
			}

		}

		$sql .= ' group by '.$dataType["Tables"].'.guid ';


		if($dataType["Tables"] == 'news_categorys')
		{

			$sql .= ' order by sortIndex asc , date desc';
		}
		else
		{
			if(!strstr($dataType["Tables"],'contact') && !strstr($dataType["Tables"],'news')  && !strstr($dataType["Tables"],'admin_account'))
			{
				$sql .= ' order by sortIndex asc , date desc';
			}
			else
			{
				$sql .= ' order by date desc';
			}

		}




		$getData = DB::select($sql);

		$reData = array();



		for($ii=0;$ii<count($getData);$ii++)
	    {
			
			$data = (array)$getData[$ii];
			
				foreach($data as $key => $value)
				{


					switch($key)
					{
					  case "guid":

						  $reData[$ii][$key] = '<input type="checkbox" id="check'.$value.'" value="'.$value.'" class="_chkAll">';

					  break;

						case "pic":

							$pic = '/assets/images/noimage.gif';

							if($value != "")
							{
								$picArr = explode(",",$value);
								$pic = '/_upload/images/'.$picArr[0];

							}
							$reData[$ii][$key] = '<a  href="/stageAdmin/edit/'.$dataType['Types'].'/'.$data['guid'].'"><img src="/timthumb.php?src='.$pic.'&h=80&w=80"></a>';

							break;

					  case "category":


							if($value == '0')
							{
								$reData[$ii][$key] = '最上層 (<a href="/stageAdmin/list/productCategorys/'.$data["guid"] .'">細項管理</a>)';

							}
							else
							{
								//取得分類資料
								$tempData = DB::select('select title from '.$dataType["Tables"].'_categorys where guid = ?' , array($value));
								if(count($tempData) > 0)
								{
									$selData = (array)$tempData[0];
									$reData[$ii][$key] = $selData["title"];
								}
								else
								{
									$reData[$ii][$key] = '<span style="color:#FF0000">分類遺失</span>';
								}


							}
							

					  break;

					  case "status":

						  if(!strstr($dataType["Tables"],'contact')) {
							  if ($value == "Y") {
								  $reData[$ii][$key] = '<a href="#1" class="changeStatus" data-value="' . $value . '" data-id="' . $data["guid"] . '"><i class="fa fa-check-square"  aria-hidden="true">啟用</i></a>';
							  } else {
								  $reData[$ii][$key] = '<a href="#1" class="changeStatus" style="color:#d9534f" data-value="' . $value . '" data-id="' . $data["guid"] . '"><i class="fa fa-square" aria-hidden="true" >停用</i></a>';
							  }
						  }
						  else
						  {
							  if ($value == "Y") {
								  $reData[$ii][$key] = '<a href="#1" class="changeStatus" data-value="' . $value . '" data-id="' . $data["guid"] . '"><i class="fa fa-check-square"  aria-hidden="true">已處理</i></a>';
							  } else {
								  $reData[$ii][$key] = '<a href="#1" class="changeStatus" style="color:#d9534f" data-value="' . $value . '" data-id="' . $data["guid"] . '"><i class="fa fa-square" aria-hidden="true" >未處理</i></a>';
							  }
						  }
					  break;

						case "sortIndex":


							$reData[$ii][$key] = '<span id="vSortIndex' . $data["guid"] . '">' . $value . '</span>　
											   <a href="#1" class="changeIndex" title="下移" data-value="' . $dataType["Tables"] . ',' . $data["guid"] . ',down"><i class="fa fa-arrow-down"></i></a>
											   <input type="text" class="changeIndexInput" name="sortIndex" id="sortIndex' . $data["guid"] . '" value="' . $value . '" style="width:50px;" data-value="' . $dataType["Tables"] . ',' . $data["guid"] . ',inputs"> 
											   <a href="#1" title="上移" class="changeIndex" data-value="' . $dataType["Tables"] . ',' . $data["guid"] . ',up"><i class="fa fa-arrow-up"></i></a>';


							break;

							
					  case "date":

							if($value != '')
							{
								$reData[$ii][$key] = date('Y-m-d' , strtotime($value));
								
							}
							

					  break;
							
					  case "modify":

						  $reData[$ii][$key] = '<a  href="/stageAdmin/edit/'.$dataType['Types'].'/'.$value.'" tabindex="0" class="fa fa-pencil edit text-primary text-uppercase text-strong text-sm mr-10"></a>
							           <a  href="#1" tabindex="0" data-value="'.$value.'" class="fa fa-times delete text-danger text-uppercase text-strong text-sm mr-10 delBut"></a>';

					  break;

						default:

							if($key == 'title')
							{
								$reData[$ii][$key] = '<a  href="/stageAdmin/edit/'.$dataType['Types'].'/'.$data['guid'].'">'.$value.'</a>';
							}
							else
							{
								$reData[$ii][$key] = $value;
							}


					}


				}
			
	    }


		
		$re = array('data' => $reData);
		
		return $re;
		
	}

	/**
	 * 回傳分類
	 * @param null $category
	 * @return mixed
	 */
	public static  function dataCategorys($table , $prevCategory , $act, $category = null , $lang)
	{
		$checkData = array();
		$reData = array();
		if($prevCategory == 'Y')
		{
			$sql = 'select id,guid,title,category  from '.$table.' where status=? and lang=? and category '.$act.' ? order by category asc ,sortIndex asc';

			$checkData = array('Y',$lang,$category);

			$getData = DB::select($sql,$checkData);

			//取下層
			if($category == "0")
			{
				if(count($getData) > 0)
				{
					for($i=0;$i<count($getData);$i++)
					{
						$tempData = (array)$getData[$i];
						$sql = 'select id,guid,title,category  from '.$table.' where status=? and lang=? and category = ? order by sortIndex asc';

						$getData2 = DB::select($sql,array('Y',$lang,$tempData['guid']));

						$tempData['next'] = (array)$getData2;


						$reData[] = $tempData;
					}
				}
			}



		}
		else
		{
			$sql = 'select guid,title  from '.$table.' where status=? and lang=? order by sortIndex asc';
			$checkData = array('Y',$lang);
			$getData = DB::select($sql,$checkData);
			$reData = (array)$getData;
		}

		return $reData;
	}

	/**
	 * 網站基本資訊
	 * @return array
	 */
	public static  function webData($lang)
	{
		$sql = 'select * from web_data where lang=? ';
		$getData = DB::select($sql,array($lang));

		$reData = (array)$getData[0];

		if($reData["pic"] != '')
		{
			$picArr = explode(',',$reData["pic"]);
			$reData["pic"] = '/_upload/images/'.$picArr[0];


			$picAltArr = explode(',',$reData["pic_alt"]);
			$reData["pic_alt"] = '';
			if(!empty($picAltArr[0]))
			{
				$reData["pic_alt"] = $picAltArr[0];
			}

		}

		return $reData;
	}

	/**
	 * 發信
	 * @param $toMail
	 * @param $toMailName
	 * @param $fromMail
	 * @param $fromName
	 * @param $body
	 * @param $Subject
	 * @return bool
	 * @throws phpmailerException
	 */
	public static function sendEmail($toMail , $toMailName , $fromMail , $fromName , $body , $Subject)
	{
		include_once(app_path() . '/PHPMailer/PHPMailerAutoload.php');

		$webData = httpFunction::webData('tw');

		$sql = 'select * from smtp_data where guid=? ';
		$smtpData = DB::select($sql,array('1'));

			//dd($smtpData);

		$mail = new \PHPMailer(true);
		try {
			$mail->CharSet = "utf-8";
			$mail->Encoding = "base64";
			$mail->IsSMTP(); //使用SMTP寄信
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl"; //一定要用ssl
			$mail->Host = $smtpData[0]->host; // SMTP server
			$mail->Port = $smtpData[0]->port;
			$mail->From = $smtpData[0]->form_email;
			$mail->FromName = $fromName;
			$mail->Subject = $Subject;
			//注意：這裡要用明文設定Gmail的帳號密碼，所以有可能被他人盜用
			//如果你是用虛擬主機的不建議使用(或申請另一個Gmail)
			$mail->Username = $smtpData[0]->username; //gmail帳號
			$mail->Password = $smtpData[0]->password; //gmail密碼
			//IsHTML設為true才能用HTML格式化文件
			$mail->IsHTML(true);
			$mail->Body = $body;

			$toMailArr = explode(",",$toMail);
			for($ii=0;$ii<count($toMailArr);$ii++)
			{
				if(!empty($toMailArr))
				{
					//目的信箱
					$mail->AddAddress($toMailArr[$ii], $toMailName);


				}

			}




			//判斷寄信是否成功
			if (!$mail->Send()) {
				return false;
			} else {
				return true;
			}
		}
		catch (Exception $e) {
			dd($e);
		}
	}


	/**
	 * 取得GUID
	 * @return int
	 */
	public static function getGUID(){

		/*if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"

            $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);

            return $uuid;
        }*/


		return strtotime(date('Y-m-d H:i:s'));

	}
	/**
	 * 回傳頁碼
	 * @param $page
	 * @param $pageNeedQty
	 * @param $totalNum
	 * @param $thisPage
	 * @param $addPath
	 * @return array
	 */
	public static  function pageList($page , $pageNeedQty , $totalNum , $thisPage , $addPath)
	{
		$re = array();

		//$startNum = 1;

		if(empty($page))
		{
			$page = '1';
		}

		$allPage = ceil($totalNum / $pageNeedQty);//所有頁數

		$re['PageList'] = '';
		if($allPage == '1')
		{
			$re['PageList'] = '';
			return $re;
		}

		//迴圈範圍
		//$startNum = $allPage - 5;
		$endNum = $allPage;
		$startNum = $page;

		if(($allPage-5) < $startNum && ($allPage-5) > 0 )
		{
			$startNum = $allPage-4;
		}


		if($allPage <= 5) {
			$startNum = 1;
		}

		if($startNum <= 0 || $startNum >=  $page )
		{
			//
			if($allPage >= 5) {

				$endNum = $startNum + 4;

			}
		}
		if($allPage >= 5) {
			if($allPage > 5) {

				$endNum = $startNum + 4;

			}
			else
			{
				$endNum = 5;
			}


		}



		if($page > 1)
		{


			$re['PageList'] = ' <li><a class="prev" href="'.$thisPage.'/'.($page-1).$addPath.'"><span class="fa fa-angle-left"></span></a></li>';
		}


		if($endNum > 0)
		{

			$pageNo = '';

			//頁碼迴圈
			for($p=(int)$startNum;$p<=(int)$endNum;$p++)
			{

				if($p == $page)
				{

					$pageNo .= ' <li><a href="#1" class="active" title="第'.$p.'頁">'.$p.'</a></li>';

				}
				else
				{


					$pageNo .= '<li><a href="'.$thisPage.'/'.$p.$addPath.'" title="第'.$p.'頁">'.$p.'</a></li>';

				}

			}

			$re['PageList'] .= $pageNo;

		}


		if($page < $allPage)
		{

			$re['PageList'] .= '<li><a class="next" href="'.$thisPage.'/'.($page+1).$addPath.'"><span class="fa fa-angle-right"></span></a></li>';
		}



		return $re;

	}
	/**
	 * 後台選單
	 * @param $pro
	 * @return array
	 */
	public static function adminMenu($pro)
	{

		$reArray = array();
		//取得分類資料
		$getData1 = DB::select('select id,title,icon from admin_menu where category = ? and pro = ? and status=? order by sortIndex asc' , array('0',$pro,'Y'));
		for($aa=0;$aa<count($getData1);$aa++) {

			$listData1 = (array)$getData1[$aa];

			//取下層
			$getData2 = DB::select('select title,types,link_type,default_id from admin_menu where category = ? and pro = ? and status=? order by sortIndex asc' , array($listData1["id"],$pro,'Y'));

			if(count($getData2) > 0)
			{
				$link = '';

				for($bb=0;$bb<count($getData2);$bb++) {

					$listData2 = (array)$getData2[$bb];

					$default_id = '';
					if(!empty($listData2['default_id']))
					{
						$default_id = '/'.$listData2['default_id'];
					}

					$link .= ' <li><a href="/stageAdmin/'.$listData2['link_type'].'/'.$listData2['types'].$default_id.'"><i class="fa fa-caret-right"></i> '.$listData2['title'].'</a></li>';
				}

				$listData1['subList'] = $link;
				$reArray[] = $listData1;
			}




		}

		return $reArray;
	}
	/**
	 * 讀取檔案
	 * @param $file
	 * @return string
	 */
	public static  function readFileData($file)
	{
		$handle = fopen($file, "r");
		$contents = '';
		if ($handle) {
			while (!feof($handle)) {
				$contents .= fgets($handle, 10);

			}
			fclose($handle);
		}

		return $contents;
	}

}