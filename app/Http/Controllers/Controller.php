<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use App;
use Illuminate\Support\Facades\Lang;
use Session;

class Controller extends BaseController
{
    /**
     * 預設
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->Lang = 'tw';

        if(isset($request->lang) && !empty($request->lang))
        {
            $this->Lang = $request->lang;
        }
        $this->product_categorys = httpFunction::dataCategorys('product_categorys' , 'Y' , '=' , 0 , $this->Lang);//第一層分類
        $this->news_categorys = httpFunction::dataCategorys('news_categorys' , 'N' , '=' , 0 , $this->Lang);//第一層分類

        $pachTitle = 'http://';
        if($request->server('SERVER_PORT') != '80')
        {
            $pachTitle = 'https://';
        }

        $this->server_name = $pachTitle.$request->server('SERVER_NAME');//取的網址

    }

    /**
     * 首頁
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $data = array();
        $data['lang'] = $this->Lang;

        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;

        $sql = 'select * from index_banner where status=? and lang = ? order by sortIndex asc';
        $getData = DB::select($sql,array('Y',$data['lang']));
        $data['indexBanner'] = array();
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                $tempData["pic"] = '/_upload/images/'.$picArr[0];

                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }


                //$tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=600&w=902';
            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }
            $tempData["no"] = $ii;
            $data["indexBanner"][] = $tempData;
        }


        $sql = 'select guid,title,notes,pic,pic_alt,date from news where status=? and index_view = ? and lang = ? order by  date desc  Limit 0 , 3';
        $getData = DB::select($sql,array('Y','Y',$data['lang']));
        $data['indexNews'] = array();
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                //$tempData["pic"] = '/_upload/images/'.$picArr[0];
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=190&w=236';

                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }

            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }


            $tempData['day'] = date('d' , strtotime($tempData['date']));
            $tempData['month'] = date('M' , strtotime($tempData['date']));


            $data["indexNews"][] = $tempData;
        }

        $data['webData'] = httpFunction::webData($data['lang']);




        //作品
        $sql = 'select guid,title,notes,category,pic,pic_alt,price,(select title from product_categorys where guid = product.category ) as categoryTitle from product where status=? and lang = ? order by sortIndex asc Limit 0 , 3 ';
        $data['indexPro'] = array();
        $getData = DB::select($sql,array('Y',$data['lang']));
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                //$tempData["pic"] = '/_upload/images/'.$picArr[0];
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=250&w=347';

                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }

            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }

            $data["indexPro"][] = $tempData;
        }


        //取購物車資訊---------------------------------------------
        $shopData =  httpFunction::getShopList();

        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        //SEO資訊------------------------------------------
        //$tempWebData = httpFunction::webData("en");
        $data['webTitle'] = $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------

        //設計團隊------------------------------------------------
        $sql = 'select * from designer where status=? and lang = ? order by sortIndex asc';
        $data['designer'] = array();
        $getData = DB::select($sql,array('Y',$data['lang']));
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=154&w=154';

                $picAltArr = explode(',',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }

            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }

            $data["designer"][] = $tempData;
        }
        //------------------------------------------------


        //相簿------------------------------------------------
        $sql = 'select * from gallery where status=? and lang = ? and index_view=? order by sortIndex asc Limit 0 , 6';
        $data['gallery'] = array();
        $getData = DB::select($sql,array('Y',$data['lang'],'Y'));
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',substr($tempData["pic"],0,-1));
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=265&w=372';

                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }
                $tempData["picArr"] = $picArr;
                $tempData["picAltArr"] = $picAltArr;
            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }

            $data["gallery"][] = $tempData;
        }
        //------------------------------------------------

        $data['uri'] = 'index';
        return view('home.index' , $data);
    }

    /**
     * 最新消息
     * @param Request $request
     * @return mixed
     */
    public function news(Request $request){

        $data = array();
        $data['lang'] = $this->Lang;
        $data['addCss'] = 'about';
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        $data['topCategory'] = array();
        //取得分類資訊
        if(!empty($request->category) && $request->category != null) {
            $sql = 'select * from news_categorys where guid=? and lang=?';
            $getData = DB::select($sql, array($request->category,$data['lang']));
            $data['topCategory'] = (array)$getData[0];
            if ($data['topCategory']["pic"] != '') {
                $picArr = explode(',', $data['topCategory']["pic"]);
                $data['topCategory']["pic"] = '/_upload/images/' . $picArr[0];

            } else {
                $data['topCategory']["pic"] = '/images/background/5.jpg';
            }
        }


        $addPath = '';//頁碼用增加多項判斷

        $page = 1;
        //分頁開始與結束
        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;
        }
        $needNum = 5;
        $startNum = ($page - 1) * $needNum;


        $searchVal = array('Y',$data['lang']);

        $sql = 'select guid,title,notes,pic,pic_alt,date,views from news where status=? and lang = ?  ';

        if(!empty($request->category) && $request->category != null)
        {
            $sql .= ' and category=\''.$request->category.'\'';

            $addPath .= "/".$request->category;
        }



        $getDataTemp = DB::select($sql,$searchVal);//取得總數

        $sql .= ' order by date desc  Limit '.$startNum.','.$needNum;




        $getData = DB::select($sql,array('Y',$data['lang']));

        $data['totalNum'] = count($getDataTemp);

        $pageList = httpFunction::pageList($page , $needNum , count($getDataTemp) , '/news' , $addPath);//取得頁碼顯示
        $data['pageList'] = $pageList['PageList'];

        $data['news'] = array();
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                //$tempData["pic"] = '/_upload/images/'.$picArr[0];
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=560&w=770';
                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }
            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }

            $tempTime = strtotime($tempData["date"]);
            $tempData["date"] = date('Y-m-d',$tempTime);

            $data["news"][] = $tempData;
        }


        //取得分類資訊
        $sql = 'select guid,title,(select count(guid) from news where category = news_categorys.guid ) as countNum from news_categorys where lang=? and status=? order by sortIndex asc';
        $getData = DB::select($sql,array($data['lang'],'Y' ));
        $data['subCategory'] = $getData;


        //SEO資訊------------------------------------------
        $data['webTitle'] = $data['topCategory']['seo_title'].' - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];

        //------------------------------------------------
//取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        $data['uri'] = 'news';

        return view('home.news' , $data);
    }

    /**
     * 最新消息內頁
     * @param Request $request
     * @return mixed
     */
    public function newsDetail(Request $request){

        $data = array();
        $data['lang'] = $this->Lang;
        $data['addCss'] = 'about';
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);
        $data['serverName'] = $_SERVER["SERVER_NAME"];
        $data['news'] = array();

        //取得最新消息
        $sql = 'select * from news where guid=? and lang=?';
        $getData = DB::select($sql,array($request->guid , $data['lang'] ));

        $data['news'] = (array)$getData[0];


        if($data['news']["pic"] != '')
        {
            $picArr = explode(',',$data['news']["pic"]);
            $data['news']["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=560&w=770';
            $picAltArr = explode('§',$data['news']["pic_alt"]);
            $data['news']["pic_alt"] = '';
            if(!empty($picAltArr[0]))
            {
                $data['news']["pic_alt"] = $picAltArr[0];
            }
        }
        else
        {
            $data['news']["pic"] = '/images/resource/news-11.jpg';
        }

        $tempTime = strtotime($data['news']["date"]);
        $data['news']["date"] = date('Y/m/d',$tempTime);

        //分類資訊
        if(!empty($data['news']['category']) && $data['news']['category'] != null) {
            $sql = 'select * from news_categorys where guid=? and lang=?';
            $getData = DB::select($sql, array($data['news']['category'],$data['lang']));
            $data['topCategory'] = (array)$getData[0];
            if ($data['topCategory']["pic"] != '') {
                $picArr = explode(',', $data['topCategory']["pic"]);
                $data['topCategory']["pic"] = '/_upload/images/' . $picArr[0];

            } else {
                $data['topCategory']["pic"] = '/images/background/5.jpg';
            }
        }



        //取得分類資訊
        $sql = 'select guid,title,(select count(guid) from news where category = news_categorys.guid ) as countNum from news_categorys where lang=? and status=? order by sortIndex asc';
        $getData = DB::select($sql,array($data['lang'],'Y' ));
        $data['subCategory'] = $getData;




        //SEO資訊-----------------------------------------
        $data['webTitle'] = $data['news']["seo_title"] . ' - ' . $data['webData']["seo_title"];

        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];


        if(!empty($data['news']['seo_description']))
        {
            $data['seoDescription'] = $data['news']["seo_description"];
        }
        if(!empty($data['news']['seo_keywords']))
        {
            $data['seoKeywords'] = $data['news']["seo_keywords"];
        }
        //------------------------------------------------
//取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        $data['uri'] = 'new';
        return view('home.new' , $data);
    }

    /**
     * 關於我們
     * @param Request $request
     * @return mixed
     */
    public function about(Request $request){

        $data = array();
        $data['lang'] = $this->Lang;

        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);


        $sql = 'select * from about where  lang = ?';
        $getData = DB::select($sql,array($data['lang']));
        $data['about'] = array('title' => '','description' => '');
        $data['aboutPic']  = array();
        if(count($getData) > 0)
        {
            $data['about'] = (array)$getData[0];

            if($data['about']["pic"] != '')
            {
                $picArr = explode(',',$data['about']["pic"]);
                //$tempData["pic"] = '/_upload/images/'.$picArr[0];
                $data['about']["pic"] = '/_upload/images/'.$picArr[0];
                $picAltArr = explode('§',$data['about']["pic_alt"]);
                $data['about']["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $data['about']["pic_alt"] = $picAltArr[0];
                }
            }
            else
            {
                $data['about']["pic"] = '/images/background/5.jpg';
            }
        }



        //SEO資訊-----------------------------------------
        $data['webTitle'] = $data['about']["seo_title"] . ' - ' . $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];


        if(!empty($data['about']['seo_description']))
        {
            $data['seoDescription'] = $data['about']["seo_description"];
        }
        if(!empty($data['about']['seo_keywords']))
        {
            $data['seoKeywords'] = $data['about']["seo_keywords"];
        }
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        //設計團隊------------------------------------------------
        $sql = 'select * from designer where status=? and lang = ? order by sortIndex asc';
        $data['designer'] = array();
        $getData = DB::select($sql,array('Y',$data['lang']));
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=154&w=154';

                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }

            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }

            $data["designer"][] = $tempData;
        }
        //------------------------------------------------

        $data['uri'] = 'about';
        return view('home.about' , $data);
    }


    /**
     * 作品
     * @param Request $request
     * @return mixed
     */
    public function works(Request $request){


        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        $data['category'] = $request->category;
        $data['subCategory'] = '';
        if(!empty($request->subCategory) && $request->subCategory != null)
        {
            $data['subCategory'] = $request->subCategory;
        }


        $sql = 'select * from product_categorys where  lang = ? and guid=?';
        $getData = DB::select($sql,array($data['lang'], $request->category) );

        $data['product_categorys'] = array();
        if(count($getData) > 0)
        {
            $data['product_categorys'] = (array)$getData[0];
            if($data['product_categorys']["pic"] != '')
            {
                $picArr = explode(',',$data['product_categorys']["pic"]);
                //$tempData["pic"] = '/_upload/images/'.$picArr[0];
                $data['product_categorys']["pic"] = '/_upload/images/'.$picArr[0];
                $picAltArr = explode('§',$data['product_categorys']["pic_alt"]);
                $data['product_categorys']["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $data['product_categorys']["pic_alt"] = $picAltArr[0];
                }
            }
            else
            {
                $data['product_categorys']["pic"] = '/images/background/5.jpg';
            }
        }


        $addPath = '';//頁碼用增加多項判斷

        //分頁開始與結束
        $page = 1;
        //分頁開始與結束
        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;
        }
        $needNum = 9;
        $startNum = ($page - 1) * $needNum;

        $searchVal = array('Y',$data['lang']);



        $sql = 'select guid,title,notes,category,pic,pic_alt,price,(select title from product_categorys where guid = product.category ) as categoryTitle from product where status=? and lang = ?  ';

        //第一層
        if(!empty($data['category']) && $data['category'] != null )
        {


            //取得分類名稱
            $sql2 = 'select title,seo_title,seo_keywords,seo_description from product_categorys where guid=? and lang = ? ';
            $getData2 = DB::select($sql2,array($data['category'],$data['lang']));

            $categoryTitle = $getData2[0]->title;
            $data['categoryTitle'] = $categoryTitle;
            $seo_title = $getData2[0]->seo_title;
            $seo_keywords = $getData2[0]->seo_keywords;
            $seo_description = $getData2[0]->seo_description;


            if(empty($data['subCategory']))
            {
                //取得所有下層
                $sql2 = 'select guid from product_categorys where category=? and lang = ? ';
                $getData2 = DB::select($sql2,array($data['category'],$data['lang']));

                $incategorys = '';
                if(count($getData2) > 0)
                {
                    $incategorys .= '';
                    for($ii=0;$ii<count($getData2);$ii++) {

                        $incategorys .= "'".$getData2[$ii]->guid."',";

                    }

                    $incategorys = substr($incategorys,0,-1);

                    $sql .= " and category in (".$incategorys.")";
                }
                else
                {

                    $sql .= " and category = '" .$data['category']."'";
                }

            }


            $addPath = '/'.$data['category'];

        }
        //第二層
        if(!empty($data['subCategory']) && $data['subCategory'] != null)
        {
            $data['subCategory'] = $data['subCategory'];

            $sql .= ' and category = ?';
            $searchVal[] = $data['subCategory'];

            //取得分類名稱
            $sql2 = 'select title,seo_title,seo_keywords,seo_description from product_categorys where guid=? and lang = ? ';
            $getData2 = DB::select($sql2,array($data['subCategory'],$data['lang']));

            $categoryTitle2 = $getData2[0]->title;

            $data['categoryTitle2'] =$categoryTitle2;
            $seo_title2 = $getData2[0]->seo_title;
            $seo_keywords = $getData2[0]->seo_keywords;
            $seo_description = $getData2[0]->seo_description;


            $addPath .= '/'.$data['subCategory'];

        }


        $getDataTemp = DB::select($sql,$searchVal);//取得總數
        $sql .= ' order by sortIndex asc , date desc Limit '.$startNum.','.$needNum;


        $getData = DB::select($sql,$searchVal);

        $data['totalNum'] = count($getDataTemp);//總數量



        $data['sNum'] = ($page - 1) * $needNum  +  1;


        $data['eNum'] = $page * $needNum;
        if($data['eNum'] > $data['totalNum'])
        {
            $data['eNum'] = $data['totalNum'];
        }


        $pageList = httpFunction::pageList($page , $needNum , count($getDataTemp) , '/product' , $addPath);//取得頁碼顯示
        $data['pageList'] = $pageList['PageList'];



        $data['product'] = array();
        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',$tempData["pic"]);
                //$tempData["pic"] = '/_upload/images/'.$picArr[0];
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=270&w=370';
                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }
            }
            else
            {
                $tempData["pic"] = '/images/resource/news-4.jpg';
            }

            $data["product"][] = $tempData;
        }




//SEO資訊-----------------------------------------

        if(!empty($data['product_categorys']["seo_title"]))
        {
            $data['webTitle'] =  $data['product_categorys']["seo_title"] .' - ' . $data['webData']["seo_title"];
            if(!empty($seo_title2))
            {
                $data['webTitle'] =  $seo_title2 .'-'.$data['product_categorys']["seo_title"] .' - ' . $data['webData']["seo_title"];
            }
        }
        else
        {
            $data['webTitle'] =  '作品專區 - ' . $data['webData']["seo_title"];
        }



        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];


        if(!empty($data['product_categorys']['seo_description']))
        {
            $data['seoDescription'] = $data['product_categorys']["seo_description"];
        }
        if(!empty($data['product_categorys']['seo_keywords']))
        {
            $data['seoKeywords'] = $data['product_categorys']["seo_keywords"];
        }
        //------------------------------------------------



        //取購物車資訊---------------------------------------------
        $shopData =  httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
//取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        $data['uri'] = 'works';
        return view('home.works' , $data);

    }

    /**
     * 作品內頁
     * @param Request $request
     * @return mixed
     */
    public function worksDetail(Request $request){

        $data = array();
        $data['lang'] = $this->Lang;
        $data['serverName'] = $_SERVER["SERVER_NAME"];

        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        $sql = 'select *,(select title from product_categorys where guid = product.category ) as categoryTitle from product where guid=? and lang=?';
        $getData = DB::select($sql,array($request->guid , $data['lang'] ));

        $data['product'] = (array)$getData[0];

        $data['productPic'] = array();
        if($data['product']["pic"] != '')
        {
            $data['product']["pic"] = substr($data['product']["pic"],0,-1);

            $picArr = explode(',',$data['product']["pic"]);
            $data['productPic'] = $picArr;

            $data['product']["pic_alt"] = substr($data['product']["pic_alt"],0,-1);
            $picAltArr = explode('§',$data['product']["pic_alt"]);
            $data['productPicAlt'] = $picAltArr;


        }
        //取得分類資訊
        $sql = 'select guid,title,pic from product_categorys where guid=(select category from product_categorys where guid = \''.$data['product']["category"].'\') and lang=?';
        $getData = DB::select($sql,array($data['lang'] ));
        $data['topCategory'] = (array)$getData[0];


        if($data['topCategory']["pic"] != '')
        {
            $picArr = explode(',',$data['topCategory']["pic"]);
            //$tempData["pic"] = '/_upload/images/'.$picArr[0];
            $data['topCategory']["pic"] = '/_upload/images/'.$picArr[0];

        }
        else
        {
            $data['topCategory']["pic"] = '/images/background/5.jpg';
        }


        //首曾分類下的第二層
        $sql = 'select guid,title,category,(select count(guid) from product where category = product_categorys.guid ) as countNum from product_categorys where category=? and lang=? order by sortIndex asc';
        $getData = DB::select($sql,array($data['topCategory']['guid'] , $data['lang'] ));
        $data['subCategory'] = $getData;

        //取相關作品
        $sql = 'select guid,title from product where category=? and lang=? and guid != '.$data['product']['guid'];
        $getData = DB::select($sql,array( $data['product']['category'],$data['lang'] ));
        $data['subProduct'] = $getData;


        //SEO資訊------------------------------------------
        $data['webTitle'] = $data['product']['seo_title'].' - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        if(!empty($data['product']['seo_description']))
        {
            $data['seoDescription'] = $data['product']["seo_description"];
        }
        if(!empty($data['product']['seo_keywords']))
        {
            $data['seoKeywords'] = $data['product']["seo_keywords"];
        }
        //------------------------------------------------


        //取購物車資訊---------------------------------------------
        $shopData =  httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        $data['uri'] = 'work';
        return view('home.work' , $data);
    }

    /**
     * 活動相簿
     * @param Request $request
     * @return mixed
     */
    public function gallery(Request $request){

        $data = array();

        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        $addPath = '';
        $page = 1;
        //分頁開始與結束
        if(isset($request->page) && !empty($request->page))
        {
            $page = $request->page;
        }
        $needNum = 6;
        $startNum = ($page - 1) * $needNum;


        $searchVal = array('Y',$data['lang']);


        //相簿------------------------------------------------
        $sql = 'select * from gallery where status=? and lang = ?   ';

        $getDataTemp = DB::select($sql,$searchVal);//取得總數

        $sql .= ' order by sortIndex asc  Limit '.$startNum.','.$needNum;

        $getData = DB::select($sql,array('Y',$data['lang']));


        $data['totalNum'] = count($getDataTemp);
        $pageList = httpFunction::pageList($page , $needNum , count($getDataTemp) , '/gallery' , $addPath);//取得頁碼顯示

        $data['pageList'] = $pageList['PageList'];
        $data['gallery'] = array();

        for($ii=0;$ii<count($getData);$ii++)
        {
            $tempData = (array)$getData[$ii];
            if($tempData["pic"] != '')
            {
                $picArr = explode(',',substr($tempData["pic"],0,-1));
                $tempData["pic"] = '/timthumb.php?src=/_upload/images/'.$picArr[0].'&h=265&w=372';

                $picAltArr = explode('§',$tempData["pic_alt"]);
                $tempData["pic_alt"] = '';
                if(!empty($picAltArr[0]))
                {
                    $tempData["pic_alt"] = $picAltArr[0];
                }
                $tempData["picArr"] = $picArr;
                $tempData["picAltArr"] = $picAltArr;
            }
            else
            {
                $tempData["pic"] = '/images/Home-Slider/slide.jpg';
            }

            $data["gallery"][] = $tempData;
        }
        //------------------------------------------------



        //SEO資訊-----------------------------------------
        $data['webTitle'] =  '活動寫真 - ' . $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];


        if(!empty($data['about']['seo_description']))
        {
            $data['seoDescription'] = $data['about']["seo_description"];
        }
        if(!empty($data['about']['seo_keywords']))
        {
            $data['seoKeywords'] = $data['about']["seo_keywords"];
        }
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        $data['uri'] = 'gallery';
        return view('home.gallery' , $data);
    }

    /**
     * 註冊
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request){

        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        //取得縣市
        $sql = 'select city from taiwan_city group by city order by zip asc';
        $getData = DB::select($sql,array() );
        $data['city'] = array();
        if(count($getData) > 0)
        {
            $data['city'] = $getData;
        }
        //SEO資訊-----------------------------------------
        $data['webTitle'] =  '加入會員 - ' . $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];


        if(!empty($data['about']['seo_description']))
        {
            $data['seoDescription'] = $data['about']["seo_description"];
        }
        if(!empty($data['about']['seo_keywords']))
        {
            $data['seoKeywords'] = $data['about']["seo_keywords"];
        }
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        $data['uri'] = 'register';
        return view('home.register' , $data);
    }

    /**
     * 發送訊息
     * @param Request $request
     * @return mixed
     */
    public function sendMsg(Request $request){


        $data = array();

        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        //$data["store_id"] = $store_id;
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        switch($request->type)
        {
            //會員註冊結束
            case "register":

                $data['menuTitle'] = '加入會員';
                $data['title'] = '您以成功加入我們的會員';
                $data['subTitle'] = '請至您註冊的信箱點選啟用連結來啟用您的會員，啟用後，即可登入我們的網站，謝謝';
                $data['notes'] = '<h4 class="text-light-black">並請注意該信件是否在垃圾信件中</h4>';
                break;

        }

        $data['webTitle'] =  $data['menuTitle'] .' - ' . $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        $data['uri'] = 'send';
        return view('home.send' , $data);
    }

    /**
     * 啟用會員
     * @param Request $request
     * @return mixed
     */
    public function checkMember(Request $request){
        $data = array();
        $data['lang'] = 'tw';
        $data['webData'] = httpFunction::webData($data['lang']);

        $data = memberFunction::checkMember($request->codes);

        return view('home.alert' , $data);
    }

    /**
     * 購物列表
     * @param Request $request
     * @return mixed
     */
    public function car(Request $request)
    {

        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

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
            /*
                $disCountData =  httpFunction::disCountCalculation($shopData["totalPrice"]);//優惠計算

                $data['shopTotalPriceAndFare'] = $disCountData['rePrice'];
                $data['discountTitle'] = $disCountData['discountTitle'];//活動名稱
                $data['discountPrice'] = $disCountData['discountPrice'];//折扣金額
            */
            $fareData  = httpFunction::fareCalculation($data['shopTotalPriceAndFare']);//運費計算

            $data['shopTotalPriceAndFare'] = $fareData["shopTotalPriceAndFare"];//含運費總金額
            $data['fare'] = $fareData["fare"];//運費
            $data['fareText'] = $fareData["fareText"];//運費敘述

        }
        else
        {
            $data['altTitle'] = '系統訊息';
            $data['type'] = 'error';
            $data['confirmButtonText'] = '確定';
            $data['altSubTitle'] = '您尚未購買讓何商品喔!';
            $data['url'] = '';
            return view('home.alert' , $data);

        }

//SEO資訊-----------------------------------------
        $data['webTitle'] =  '購物車 - ' . $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];



        $data['uri'] = 'car';
        return view('home.car' , $data);


    }

    /**
     * 結帳畫面
     * @param Request $request
     * @return mixed
     */
    public function checkout(Request $request)
    {
        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

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

        //有登入---------------------------
        $data['memberData'] = array();
        if(Session::has('memberData')) {

            $data['memberData'] = session('memberData');
        }

        //取得縣市
        $sql = 'select city from taiwan_city group by city order by zip asc';
        $getData = DB::select($sql,array() );
        $data['city'] = array();
        if(count($getData) > 0)
        {
            $data['city'] = $getData;
        }

        //取得區域
        $data['district'] = array();
        if(count($data['memberData']) > 0)
        {
            $sql = 'select district from taiwan_city where city=? order by zip asc';
            $getData = DB::select($sql,array($data['memberData']->city) );

            if(count($getData) > 0)
            {
                $data['district'] = $getData;
            }
        }



        if(Session::has('shopCar')) {


            $data['shopTotalPriceAndFare'] = $shopData["totalPrice"];//含運費總金額
            /*
                $disCountData =  httpFunction::disCountCalculation($shopData["totalPrice"]);//優惠計算

                $data['shopTotalPriceAndFare'] = $disCountData['rePrice'];
                $data['discountTitle'] = $disCountData['discountTitle'];//活動名稱
                $data['discountPrice'] = $disCountData['discountPrice'];//折扣金額
            */
            $fareData  = httpFunction::fareCalculation($data['shopTotalPriceAndFare']);//運費計算

            $data['shopTotalPriceAndFare'] = $fareData["shopTotalPriceAndFare"];//含運費總金額
            $data['fare'] = $fareData["fare"];//運費
            $data['fareText'] = $fareData["fareText"];//運費敘述

        }
        else
        {
            $data['altTitle'] = '系統訊息';
            $data['type'] = 'error';
            $data['confirmButtonText'] = '確定';
            $data['altSubTitle'] = '您尚未購買讓何商品喔!';
            $data['url'] = '';
            return view('home.alert' , $data);

        }

//SEO資訊-----------------------------------------
        $data['webTitle'] =  '購物車 - ' . $data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];



        $data['uri'] = 'checkout';
        return view('home.checkout' , $data);


    }

    /**
     * 使佣金流
     * @param Request $request
     * @throws Exception
     */
    public function pay(Request $request)
    {
        $data = array();

        //取得總金額
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



       // $disCountData =  httpFunction::disCountCalculation( $shopData["totalPrice"]);//優惠計算
        /*
        $data['shopTotalPriceAndFare'] = $disCountData['rePrice'];
        $data['discountTitle'] = $disCountData['discountTitle'];//活動名稱
        $data['discountPrice'] = $disCountData['discountPrice'];//折扣金額
        */
        $data['shopTotalPriceAndFare'] = $shopData["totalPrice"];//含運費總金額

        $fareData  = httpFunction::fareCalculation($data['shopTotalPriceAndFare']);//運費計算

        $data['shopTotalPriceAndFare'] = $fareData["shopTotalPriceAndFare"];//含運費總金額
        $data['fare'] = $fareData["fare"];//運費
        $data['fareText'] = $fareData["fareText"];//運費敘述

        $data['shopCarMember'] = session('shopCarMember');//購物者資訊



        $payData = array();
        $payData['or_no'] = 'A'.date('ymdHis').httpFunction::randCode();

                $payData['bank'] = 'ecpay';//綠界
                $payData['MerchantID'] = '2000132';
                //$payData['MerchantTradeNo'] = '2000132';
                $payData['HashKey'] = '5294y06JbISpM5x9';
                $payData['HashIV'] = 'v77hoKGq4kWxNNIS';
                $payData['ServiceURL'] ='https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5';
                $payData['ReturnURL'] = $this->server_name.'/payRe';
                $payData['OrderResultURL'] = $this->server_name.'/payEnd';
                $payData['ClientRedirectURL'] = $this->server_name.'/payEnd';
                //$payData['PeriodReturnURL'] = $this->server_name.'/re.php';


        \App\Http\Controllers\PaySDK::runPaySDK($payData['bank']  , $payData, $data);


        	//PaySDK::runPaySDK("ecpay"  , $payData, $data);
        return;
    }

    /**
     * 信用卡以外接收付款通知通道
     * @param Request $request
     */
    public function payRe(Request $request){

        $rePayData = $request->all();//取得購物回傳資訊
        $rePayData['editID'] = $rePayData['MerchantTradeNo'];
        unset($rePayData['MerchantTradeNo']);
        DbFunction::UpdateDB('order_pay_data' , $rePayData);
        echo "1|OK";
    }


    /**
     * 結帳處理
     * @param Request $request
     * @return string
     */
    public function payEnd(Request $request){

        $rePayData = $request->all();//取得購物回傳資訊
        $data = array();
                $shopData = httpFunction::getShopList();
                $data['shopList'] = $shopData["shopList"];
                $data['shopTotalPrice'] = $shopData["totalPrice"];
                $data['shopTotalQty'] = $shopData["totalQty"];
                $data['shopTotalPriceAndFare'] = $shopData["totalPrice"];//含運費總金額
                $fareData  = httpFunction::fareCalculation($data['shopTotalPriceAndFare']);//運費計算



                $shopCarMember['status'] = 'N';

                $canAddOrder = 'N';
                //交易成功
                //信用卡
                if($rePayData['RtnCode'] == '1' && $rePayData['PaymentType'] == 'Credit_CreditCard')
                {
                    $canAddOrder = 'Y';
                    $shopCarMember['status'] = 'B';
                }
                //信用卡
                if($rePayData['RtnCode'] == '2' && (strstr($rePayData['PaymentType'],'ATM') || strstr($rePayData['PaymentType'],'CVS')  || strstr($rePayData['PaymentType'],'BARCODE')))
                {
                    $canAddOrder = 'Y';
                }

                //金流成功
                if($canAddOrder == 'Y')
                {


                    //寫入購物資訊
                    DbFunction::InsertDB('order_pay_data', $rePayData);

                    //寫入購物車
                    $shopCarMember = session('shopCarMember');
                    $shopCarMember['or_no'] = $rePayData['MerchantTradeNo'];
                    $shopCarMember['guid'] = httpFunction::getGUID();
                    $shopCarMember['member_id'] ='0';


                    if(Session::has('memberData'))
                    {
                        $shopCarMember['member_id'] = session('memberData')->id;
                    }
                    $shopCarMember['date'] = date('Y-m-d H:i:s');


                    $shopCarMember['total_price'] = $fareData["shopTotalPriceAndFare"];//含運費總金額
                    $shopCarMember['fare_price'] =  $fareData["fare"];//運費
                    $shopCarMember['product_price'] = $data['shopTotalPrice'];//商品金額
                    $shopCarMember['total_qty'] = $data['shopTotalQty'];//商品金額

                    //寫入購買細項
                    $payList = '';
                    for($ii=0;$ii<count($data['shopList']);$ii++)
                    {
                        $specData = array();
                        $specData['guid'] = httpFunction::getGUID().$ii;
                        $specData['ouid'] = $shopCarMember['guid'];
                        $specData['puid'] = $data['shopList'][$ii]['puid'];
                        $specData['suid'] = '';
                        $specData['qty'] = $data['shopList'][$ii]['qty'];
                        $specData['title'] = $data['shopList'][$ii]['productTitle'];
                        $specData['spec_title'] = '';
                        $specData['price'] = $data['shopList'][$ii]['price'];
                        DbFunction::InsertDB('order_spec', $specData);

                        //扣庫存
                        $updateSQL = "update `product` set `inventory` = `inventory` - ".$specData['qty']." where guid = ? ";
                        DB::update($updateSQL, array($specData['puid']));


                        $payList .= ' <tr style="background-color:#FFFFFF;">
                                  <td align="left" style=" font-family:Microsoft JhengHei;Verdana, Geneva, sans-serif; font-size:15px; width: 80px; border:1px #cccccc solid;">&nbsp;&nbsp;'.$specData['title'].' </td>
                                  <td align="left" style=" font-family:Microsoft JhengHei;Verdana, Geneva, sans-serif; font-size:15px; border:1px #cccccc solid;">&nbsp;&nbsp; '.$specData['qty'].'</td>
                                  <td align="left" style=" font-family:Microsoft JhengHei;Verdana, Geneva, sans-serif; font-size:15px;  border:1px #cccccc solid;">&nbsp;&nbsp; '.($specData['qty'] * $specData['price']).'</td>
                                </tr>';

                    }

                    DbFunction::InsertDB('order_data', $shopCarMember);//寫入訂單主檔

                    Session::forget('shopCar');
                    Session::forget('shopCarMember');
                    return redirect('/complete');//轉跳頁面
                    exit;

                }
                else{


                    //交易失敗
                    $data['altTitle'] = '交易失敗';
                    $data['type'] = 'error';
                    $data['confirmButtonText'] = '確定';
                    $data['url'] = 'checkout';
                    if($rePayData['PaymentType'] == 'Credit_CreditCard')
                    {
                        $data['altSubTitle'] = '請檢查您的卡號或其他資訊是否輸入正確!';
                    }
                    else
                    {
                        $data['altSubTitle'] = '取號失敗，請重新選擇!';
                    }

                    return view('home.alert' , $data);
                }


    }

    /**
     * 結帳完畢
     * @param Request $request
     * @return mixed
     */
    public function complete(Request $request)
    {
        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        //SEO資訊------------------------------------------
        $data['webTitle'] = '購物完成 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------


        $data['uri'] ='complete';

        return view('home.complete' , $data);
    }


    /**
     * 會員登入
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);

        //SEO資訊------------------------------------------
        $data['webTitle'] = '登入會員 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        $data['uri'] ='login';

        return view('home.login' , $data);
    }

    /**
     * 聯絡我們
     * @param Request $request
     * @return mixed
     */
    public function contact(Request $request)
    {

        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);



        //SEO資訊------------------------------------------
        $data['webTitle'] = '聯絡我們 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------
//取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------
        $data['uri'] = 'contact';

        return view('home.contact' , $data);

    }

    /**
     * 會員專區
     * @param Request $request
     * @return mixed
     */
    public function myAccount(Request $request)
    {

        //判斷登入
        if(!Session::has('memberData'))
        {

            return redirect('/login');//轉跳頁面
            exit;
        }


        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);



        //SEO資訊------------------------------------------
        $data['webTitle'] = '會員專區 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        $data['uri'] = 'my-account';

        return view('home.my-account' , $data);

    }


    /**
     * 修改基本資料
     * @param Request $request
     * @return mixed
     */
    public function myProfile(Request $request)
    {

        //判斷登入
        if(!Session::has('memberData'))
        {

            return redirect('/login');//轉跳頁面
            exit;
        }


        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);


        $data['memberData'] = session('memberData');

        //SEO資訊------------------------------------------
        $data['webTitle'] = '修改基本資料 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        //取得縣市
        $sql = 'select city from taiwan_city group by city order by zip asc';
        $getData = DB::select($sql,array() );
        $data['city'] = array();
        if(count($getData) > 0)
        {
            $data['city'] = $getData;
        }



            //取得區域
            $sql = 'select district from taiwan_city where city=? order by zip asc';
            $getData = DB::select($sql,array( $data['memberData']->city) );
            $data['district'] = array();
            if(count($getData) > 0)
            {
                $data['district'] = $getData;
            }

        $data['uri'] = 'my-profile';

        return view('home.my-profile' , $data);

    }



    /**
     * 修改密碼
     * @param Request $request
     * @return mixed
     */
    public function myPassword(Request $request)
    {

        //判斷登入
        if(!Session::has('memberData'))
        {

            return redirect('/login');//轉跳頁面
            exit;
        }


        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);


        $data['memberData'] = session('memberData');

        //SEO資訊------------------------------------------
        $data['webTitle'] = '修改密碼 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        $data['uri'] = 'my-password';
        return view('home.my-password' , $data);

    }



    /**
     * 我的訂單
     * @param Request $request
     * @return mixed
     */
    public function myOrder(Request $request)
    {

        //判斷登入
        if(!Session::has('memberData'))
        {

            return redirect('/login');//轉跳頁面
            exit;
        }


        $data = array();
        $data['lang'] = $this->Lang;
        $data['productCategorys'] = $this->product_categorys;
        $data['newsCategorys'] = $this->news_categorys;
        $data['webData'] = httpFunction::webData($data['lang']);


        $data['memberData'] = session('memberData');

        //SEO資訊------------------------------------------
        $data['webTitle'] = '我的訂單 - '.$data['webData']["seo_title"];
        $data['seoDescription'] = $data['webData']["seo_description"];
        $data['seoKeywords'] = $data['webData']["seo_keywords"];
        //------------------------------------------------
        //取購物車資訊---------------------------------------------
        $shopData = httpFunction::getShopList();
        $data['shopList'] = $shopData["shopList"];
        $data['shopTotalPrice'] = $shopData["totalPrice"];
        $data['shopTotalQty'] = $shopData["totalQty"];
        //取購物車資訊 END-----------------------------------------

        $data['uri'] = 'my-order';
        return view('home.my-order' , $data);

    }


    /**
     * 登出
     * @param Request $request
     * @return mixed
     */
    public static function logout(Request $request)
    {
        Session::forget('memberData');
        return redirect('/login');//轉跳頁面
        exit;
    }

}
