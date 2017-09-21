<?php

namespace App\Http\Controllers;

class uploadFunction extends Controller
{
	/**
	 * 上傳圖片
	 * @param $getData
	 * @return string
	 */
	public static function imagesUpload($getData)
	{
		$output = '';
		$getData = (array)$getData;
		$dir_base = "_upload/images/"; 	//檔上傳根目錄

		foreach($getData as $key => $value)
		{

			$picIndex = $getData['picIndex'];

		if(strstr($key,"upload_file"))
			{
				$postFile = $getData[$key];
				if(empty($postFile->getClientOriginalName())) {
					$output .=  "<textarea><img src='/styles/images/error2.jpg'/></textarea>";
				}
				else
				{
					$output .= "<div>";

					$outputImageFile = '';

					$index = 0;		//$_FILES 以檔name為陣列下標，不適用foreach($_FILES as $index=>$file)
					$v_Img = '';
						$upload_file_name = $key;		//對應index.html FomData中的檔命名
						$filename = $postFile->getClientOriginalName();
						$gb_filename = iconv('utf-8','BIG5',$filename);	//名字轉換成BIG5處理

						//判斷檔案格式與是否符合大小

						//文件不存在才上傳
					//	if(!file_exists($dir_base.$gb_filename)) {
							$isMoved = false;  //默認上傳失敗
							$MAXIMUM_FILESIZE =  (5 * 1024 * 1024); 	//檔大小限制	1M = 1 * 1024 * 1024 B;
							$rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
							//不符合大小
							if ($postFile->getSize() > $MAXIMUM_FILESIZE)
							{
								echo "<textarea><img src='styles/images/error1.jpg'/></textarea>";
								exit(0);
							}
							else if(!preg_match($rEFileTypes, strrchr($gb_filename, '.')))
							{
								echo "<textarea><img src='styles/images/error2.jpg'/></textarea>";
								exit(0);
							}


							if ($postFile->getSize() <= $MAXIMUM_FILESIZE && preg_match($rEFileTypes, strrchr($gb_filename, '.'))) {
								$tempName =  explode(".",$gb_filename);
								$newIndex = date('ymdHis').$picIndex;
								$newFileName = $newIndex. '.' . $tempName[count($tempName)-1];
								$v_Img = $newIndex.'.'. $tempName[count($tempName)-1];
								$isMoved = @move_uploaded_file ( $postFile->getPathName(), $dir_base.$newFileName);		//上傳文件
								$isMoved = true;
							}

					/*	}else{
							$isMoved = true;	//已存在檔設置為上傳成功
						}*/
						if($isMoved){

							$hrmlID = explode(".",$newFileName);
							//判斷session

								$output .= ' <li id="'.$hrmlID[0].'" style="border:1px solid #dbe0e2; width:150px;text-align:center;list-style-type:none; float:left; " >
                                          <h5>'.$newFileName.'</h5>
                                          <img src="/timthumb.php?src=/_upload/images/'.$v_Img.'&h=120&w=120"  title="'.$newFileName.'" alt="'.$newFileName.'" id="'.$hrmlID[0].'_img" onclick="openBigPic(\'/'.$dir_base.$newFileName.'\')" />
                                          <div  style="text-align:center;padding:5px;" >                                          
                                          敘述：<input type="text" id="pic_alt_'. $hrmlID[0] .'" class="pic_alt_list" style="width:80%"  value="" >
                                          </div>
                                           <div  style="text-align:center;padding:5px;" >      
                                             <a href="#1" title="移除" class="delPic" data-value="'.$dir_base.$newFileName.'" data-id="" style="padding-right:5px;"><i class="fa fa-times" ></i></a>
                                             <a href="#1" title="放大"  onclick="openBigPic(\''.$dir_base.$newFileName.'\')" style="padding-right:5px;"><i class="fa fa-search-plus" ></i></a>
                                             
                                          </div> 
                                            <div  style="text-align:center;padding:5px;" >                                          
                                          	<a href="#1" class="movePic" data-value="'. $v_Img .'" data-act="left" title="左移"><em class="fa fa-arrow-left" style="padding-right:30px;"></em></a>
										  	<a href="#1" class="movePic" data-value="'. $v_Img .'"  data-act="right" title="右移"><em class="fa fa-arrow-right"></em></a>
                                          </div>
                                       </li>';
								$outputImageFile .= $newFileName.',';
						}else {
							$output .= "<img src='styles/images/error1.jpg' title='{$filename}' alt='{$filename}'/>";
						}
						//$picIndex++;
					}
					$output .= "</div>";

				}


		}


		$output .= '§'.$outputImageFile.'§'.$picIndex;
		return $output;
	}

	/**
	 * 上傳檔案
	 * @param $getData
	 * @return string
	 */
	public static function filesUpload($getData)
	{
		$output = '';
		$getData = (array)$getData;
		$dir_base = "_upload/files/"; 	//檔上傳根目錄

		foreach($getData as $key => $value)
		{

			$picIndex = $getData['picIndex'];

			if(strstr($key,"upload_file"))
			{
				$postFile = $getData[$key];
				if(empty($postFile->getClientOriginalName())) {
					$output .=  "<textarea><img src='/styles/images/error2.jpg'/></textarea>";
				}
				else
				{
					$output .= "<div>";

					$outputImageFile = '';

					$index = 0;		//$_FILES 以檔name為陣列下標，不適用foreach($_FILES as $index=>$file)
					$v_Img = '';
					$upload_file_name = $key;		//對應index.html FomData中的檔命名
					$filename = $postFile->getClientOriginalName();
					$gb_filename = iconv('utf-8','BIG5',$filename);	//名字轉換成BIG5處理

					//判斷檔案格式與是否符合大小

					//文件不存在才上傳
					//	if(!file_exists($dir_base.$gb_filename)) {
					$isMoved = false;  //默認上傳失敗
					$MAXIMUM_FILESIZE =  (5 * 1024 * 1024); 	//檔大小限制	1M = 1 * 1024 * 1024 B;
					$rEFileTypes = "/^\.(jpg|jpeg|gif|png|zip|pdf|rar|doc|docx|xls|xlsx){1}$/i";
					//不符合大小
					if ($postFile->getSize() > $MAXIMUM_FILESIZE)
					{
						echo "<textarea><img src='styles/images/error1.jpg'/></textarea>";
						exit(0);
					}
					else if(!preg_match($rEFileTypes, strrchr($gb_filename, '.')))
					{
						echo "<textarea><img src='styles/images/error2.jpg'/></textarea>";
						exit(0);
					}


					if ($postFile->getSize() <= $MAXIMUM_FILESIZE && preg_match($rEFileTypes, strrchr($gb_filename, '.'))) {
						//$tempName =  explode(".",$gb_filename);
						//$newIndex = date('ymdHis').$picIndex;
						//$newFileName = $newIndex. '.' . $tempName[count($tempName)-1];
						//$v_Img = $newIndex.'.'. $tempName[count($tempName)-1];
						$isMoved = @move_uploaded_file ( $postFile->getPathName(), $dir_base.$gb_filename);		//上傳文件
						$isMoved = true;
					}

					/*	}else{
							$isMoved = true;	//已存在檔設置為上傳成功
						}*/
					if($isMoved){

						$hrmlID = explode(".",iconv('BIG5','utf-8',$gb_filename));
						//判斷session

						$output .= ' <li id="'.$hrmlID[0].'" style="border:1px solid #dbe0e2; width:150px;text-align:center;list-style-type:none; float:left; " >
                                          <h5>'.iconv('BIG5','utf-8',$gb_filename).'</h5>
                                          <a href="/'.$dir_base.iconv('BIG5','utf-8',$gb_filename).'" target="_blank"><img src="/timthumb.php?src=/assets/images/file.png&h=120&w=120"  title="'.iconv('BIG5','utf-8',$gb_filename).'" alt="'.iconv('BIG5','utf-8',$gb_filename).'" id="'.$hrmlID[0].'_files"  /></a>
                                          
                                           <div  style="text-align:center;padding:5px;" >      
                                             <a href="#1" title="移除" class="delFiles" data-value="'.$dir_base.iconv('BIG5','utf-8',$gb_filename).'" data-id="" style="padding-right:5px;"><i class="fa fa-times" ></i></a>
                                            
                                          </div> 
                                           
                                       </li>';
						$outputImageFile = iconv('BIG5','utf-8',$gb_filename);
					}else {
						$output .= "<img src='styles/images/error1.jpg' title='{$filename}' alt='{$filename}'/>";
					}
					//$picIndex++;
				}
				$output .= "</div>";

			}


		}


		$output .= '§'.$outputImageFile.'§'.$picIndex;
		return $output;
	}
}