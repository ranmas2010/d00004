<?php

namespace App\Http\Controllers;


class FieldController extends Controller
{
	/**
	 * 資料表欄位設定
	 * @param $table
	 * @param $field
	 * @return mixed
	 */
	public static function getFieldType($table , $field)
	{

			/*
			 * Table =>
			 * Field =>
			 * inputType , (n : 必填 , f : 非必填 , r : 唯獨 , d : disable) , find prev table , have first category
			 */

		$arr = array(
			'index_banner' =>
			 array(
				 'lang'  => 'lang,n',
				 'title'  => 'text_lang,n',
				 'pic'  => 'images,n',
				 'status'  => 'status,n,Y',
				 'link'  => 'text,f',
			 ),
			'order_data' =>
				array(
					'lang'  => 'lang,n',
					'or_no'  => 'text,r',
					'company'  => 'text,r',
					'name'  => 'text,r',
					'zip'  => 'text,r',
					'city'  => 'text,r',
					'district'  => 'text,r',
					'address'  => 'text,r',
					'email'  => 'text,r',
					'phone'  => 'text,r',
					'notes'  => 'textarea,r',
					'date'  => 'text,r',
					'product_price'  => 'price,r',
					'fare_price'  => 'price,r',
					'total_price'  => 'price,r',
					'total_qty'  => 'text,r',
					'pay_no'  => 'text,r',
					'payType'  => 'payType,r',
					'shopList'  => 'shopList,r',
					'status'  => 'status2,n,N,已結案/尚未付款/已處理/已付款/已取消/退貨中/已退貨,Y/N/A/B/C/D/E',
				),
			'fare' =>
				array(
					'lang'  => 'lang,n',
					'price'  => 'int,n',
					'free'  => 'int,n,<div style="color:#FF0000">※無滿額優惠運費，請勾選 [ 需運費(無滿額優惠) ] </div>',
					'status'  => 'status2,n,Y,需運費(有滿額優惠)/需運費(無滿額優惠)/免運費,Y/X/N',
				),
			'product' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'category'  => 'select,n,product_categorys,N',
					'notes' => 'ckeditor_lang,f',
					'description'  => 'ckeditor_lang,f',
					'price'  => 'text_lang,n',
					'inventory'  => 'int,n',
					'safe_inventory'  => 'int,n,<div style="color:#FF0000">※設定當庫存量小於或等於此數量時，即顯示下架</div>',
					'pic'  => 'images,n',
					'status'  => 'status,n,Y',
					'seo_title'  => 'text_lang,n',
					'seo_keywords'  => 'textarea_lang,f',
					'seo_description'  => 'textarea_lang,f',
				),
			 'product_categorys' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'category'  => 'select,n,product_categorys,Y',
					'status'  => 'status,n,Y',
					'seo_title'  => 'text_lang,n',
					'seo_keywords'  => 'textarea_lang,f',
					'seo_description'  => 'textarea_lang,f',
					'pic'  => 'images,n,<div style="color:#FF0000">※圖片大小為 1920 x 687</div>',
				),
			'about' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'subject'  => 'text_lang,n',
					'notes'  => 'text_lang,n',
					'description'  => 'ckeditor_lang,f',
					'seo_title'  => 'text_lang,n',
					'seo_keywords'  => 'textarea_lang,f',
					'seo_description'  => 'textarea_lang,f',
					'banner_title'  => 'text_lang,n',
					'pic'  => 'images,n,<div style="color:#FF0000">※圖片大小為 1920 x 687</div>',
				),
			'gallery' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'pic'  => 'images,n',
					'index_view'  => 'status,n,Y',
					'status'  => 'status,n,Y',
				),
			'admin_account' =>
				array(
					'passwd'  => 'password,n',
				),
			'web_data' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'phone'  => 'text_lang,n',
					'fax'  => 'text_lang,f',
					'address'  => 'text_lang,n',
					'email'  => 'text,n',
					'get_email'  => 'text,n,<div style="color:#FF0000">※多mail請使用(&#44;)逗號隔開</div>',
					'facebook'  => 'text,f',
					'twitter'  => 'text,f',
					'google_plus'  => 'text,f',
					'instagram'  => 'text,f',
					'seo_title'  => 'text_lang,n',
					'seo_keywords'  => 'textarea_lang,f',
					'seo_description'  => 'textarea_lang,f',
					'ga_code'  => 'text,f',
				),

			'contact' =>
				array(
					'name'  => 'text,r',
					'phone'  => 'text,r',
					'company'  => 'text,r',
					'email'  => 'text,r',
					'notes'  => 'textarea,r',
					'status'  => 'contactStatus,n,N',
				),
			'news_categorys' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'status'  => 'status,n,Y',
					'seo_title'  => 'text_lang,n',
					'seo_keywords'  => 'textarea_lang,f',
					'seo_description'  => 'textarea_lang,f',
					'pic'  => 'images,n,<div style="color:#FF0000">※圖片大小為 1920 x 687</div>',
				),
			'news' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'category'  => 'select,n,news_categorys,A',
					'notes' => 'textarea_lang,f',
					'description'  => 'ckeditor_lang,f',
					'pic'  => 'images,n',
					'index_view'  => 'status,n,Y',
					'date' => 'date,f',
					'status'  => 'status,n,Y',
					'seo_title'  => 'text_lang,n',
					'seo_keywords'  => 'textarea_lang,f',
					'seo_description'  => 'textarea_lang,f',
				),
			'designer' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'subject'  => 'text_lang,n',
					'notes' => 'textarea_lang,f',
					'pic'  => 'images,n',
					'facebook'  => 'text,f',
					'twitter'  => 'text,f',
					'instagram'  => 'text,f',
					'status'  => 'status,n,Y',
				),
			'catalog' =>
				array(
					'lang'  => 'lang,n',
					'title'  => 'text_lang,n',
					'files'  => 'file,n',
					'pic'  => 'images,n',
					'status'  => 'status,n,Y',
				),

			'smtp_data' =>
				array(
					'email'  => 'email,n',
					'host'  => 'text,n',
					'port'  => 'text,n',
					'smtp_auth'  => 'status,n,Y',
					'username'  => 'text,n',
					'password'  => 'text,n',
					'form_email' => 'email,n'
				),
			'admin_account' =>
				array(
					'admin_id'  => 'admin_id,n',
					'passwd'  => 'password,n,<div style="color:#FF0000">※不修改密碼請勿輸入!</div>',
					'name'  => 'text,n,Y',
					'status'  => 'status,n,Y',
				),
		);


		$reArray = $arr[$table];


		return $reArray;
	}



}