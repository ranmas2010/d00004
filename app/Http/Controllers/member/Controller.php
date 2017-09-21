<?php

namespace App\Http\Controllers\member;

use \App\Http\Controllers\httpFunction as httpFunction;
use \App\Http\Controllers\DbFunction;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * 會員啟用
     * @param $codes
     * @return mixed
     */
    public static  function checkMember($codes)
    {

        $data['type'] = 'error';
        $data['confirmButtonText'] = '返回首頁';
        $data['url'] = 'login';

        if($codes != null && !empty($codes))
        {
            $codeArr = explode('_',base64_decode($codes));
            if(count($codeArr) >= 2) {
                $getData = DB::select("select id,status from member where  username=? and date=? ", array($codeArr[0], $codeArr[1]));


                //驗證成功
                if (count($getData) > 0) {

                    if ($getData[0]->status == "N") {
                        $saveArr = array('status' => 'Y', 'editID' => $getData[0]->id);
                        $re = DbFunction::UpdateDB('member', $saveArr);
                        $data['altTitle'] = '啟用成功!';
                        $data['altSubTitle'] = '您已可以登入使用網站功能了!';
                        $data['type'] = 'success';
                        $data['confirmButtonText'] = '登入會員';
                        $data['url'] = 'login';
                    } else {

                        $data['altTitle'] = '該帳號已啟用!';
                        $data['altSubTitle'] = '該帳號已啟用過了，不須再次使用啟用功能!';

                    }

                } else {
                    $data['altTitle'] = '啟用失敗!';
                    $data['altSubTitle'] = '請檢察是否連結錯誤，或使用聯絡我們通知管理員!';

                }
            }
            else
            {
                $data['altTitle'] = '未知錯誤!';
                $data['altSubTitle'] = '此為無效連結!';

            }
        }
        else
        {
            $data['altTitle'] = '未知錯誤!';
            $data['altSubTitle'] = '此為無效連結!';

        }
        return $data;
    }



}