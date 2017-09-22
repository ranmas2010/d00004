<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DbFunction extends Controller
{

	/**
	 * 寫入資料
	 * @param $tables
	 * @param $data
	 * @return array
	 */
	public static function InsertDB($tables,$data)
	{
		/*
		 * $tables = 資料表
		 * $data = 寫入的資料
		 *
		 */	
		//$httpFunction = new \App\Http\Controllers\httpFunction();

		$FormData = httpFunction::getTableColumns($tables);

		$reData = array('instSQL' => '' , 'insert_id' => '' , 'error' => '' , 're' => '' );

		$row = '';
		$val = '';
		$valData = array();
		for($ii=0;$ii<count($FormData);$ii++)
		{
			
			$colData = (array)$FormData[$ii];
			
			if($colData["Field"] != "id")
			{		
					$row .= $colData['Field'];

					if(empty($data[$colData['Field']]))
					{
						if($colData['Default'] == null)
						{
							if($colData['Field'] == "date")
							{
								$val .= "?";
								$valData[] = date('Y-m-d H:i:s');
							}
							else
							{
								if(strstr($colData['Type'],'int')) {
									$val .= "?";
									$valData[] = null;
								}
								else
								{
									$val .= "?";
									$valData[] = "";
								}
							}
						}
						else
						{
							$val .= "?";
							$valData[] = $colData['Default'];
						}

					}
					else
					{
							$val .= "?";					
							$valData[] = $data[$colData['Field']];
						
					}


					if($ii < (count($FormData) - 1))
					{
						$row .= ' , ';
						$val .= ' , ';
					}
			}
		}



		$instSQL = "INSERT INTO `".$tables."` (" . $row. " ) VALUES ( ".$val." ) ";

		$reData['instSQL'] = $instSQL;
		
		$rs = DB::insert('insert into `'.$tables.'` ('.$row.') values ('.$val.')', $valData);

		

		if($rs)
		{

			//$reData['insert_id'] = $mysqli->insert_id;
			$reData['re'] = 'Y';
		}
		else
		{
			$reData['error'] = DB::getQueryLog();
			$reData['re'] = 'N';
		}

		return $reData;

	}

	/**
	 * 更新資料
	 * @param $tables
	 * @param $data
	 * @return array
	 */
	public static function UpdateDB($tables,$data)
	{
		/*
		 * $tables = 資料表
		 * $data = 寫入的資料
		 *
		 */
		
	
        //$httpFunction = new \App\Http\Controllers\httpFunction();
		$FormData = httpFunction::getTableColumns($tables);

		$FormDataField = array();
		for($ii=0;$ii<count($FormData);$ii++)
		{
			$colData = (array)$FormData[$ii];
			
			$FormDataField[] = $colData['Field'];
		}

		$reData = array('updateSQL' => '' , 'error' => '' , 're' => '' );

		$id = $data['editID'];
		unset($data['editID']);
		$val = '';
		$valData = array();
		foreach($data as $key => $value)
		{
			if(in_array($key,$FormDataField))
			{
				if($key != 'id')
				{
					$val .= $key ." = ?,";
					$valData[] = $value;
				}

				
			}
		}

		$val = substr($val,0,-1);



		$PK = 'guid';

		if(is_int($id))
		{
			$PK = 'id';
		}
		if($tables == 'order_pay_data')
		{
			$PK = 'MerchantTradeNo';
		}


		$valData[] = $id;

		$updateSQL = "update ".$tables." set " . $val. " where ".$PK." = ? ";
		
		
		$reData['updateSQL'] = $updateSQL;
		
	    $rs = DB::update($updateSQL, $valData);


		
		if($rs)
		{
			$reData['re'] = 'Y';
		}
		else
		{
			$reData['error'] = DB::getQueryLog();
			$reData['re'] = 'N';
		}

	

		return $reData;

	}

	/**
	 * 刪除資料
	 * @param $tables
	 * @param $data
	 * @return mixed
	 */
	public  static function DeleteDB($tables,$data)
	{

		$rs = DB::delete('delete from '.$tables.' where '.$data['PK'].'=?',array($data['id']));
		if($rs)
		{
			$reData['re'] = 'Y';
		}
		else
		{
			$reData['error'] = DB::getQueryLog();
			$reData['re'] = 'N';
		}

		return $reData;
	}

}