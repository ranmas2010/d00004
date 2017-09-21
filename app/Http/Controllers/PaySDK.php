<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Session;


class PaySDK extends Controller
{
    /**
     * 後台使用輸入相關金流變數
     * @param $bank
     * @return array
     */
     public static function getInputArea($bank)
    {
        $re = array();

        switch($bank)
        {
            //綠界
            case "ecpay":

                $re['field'] = array('MerchantID', 'HashKey' ,'HashIV','ServiceURL','ReturnURL','OrderResultURL','ClientRedirectURL');
                $re['fieldTitle'] = array('MerchantID*', 'HashKey*' ,'HashIV*','介接路徑*','回傳位址*','付款結果網址','ClientRedirectURL');
                $re['fieldNotes'] = array('', '' ,'','送出金流畫面(正是或測試網址)','當消費者付款完成後，綠界科技會將付款結果參數以幕後(Server POST)回傳到該網址。請勿設定與 Client 端接收付款結果
網址 OrderResultURL 相同位置，請在收到 Server 端付款結果通知後，請正確回應 1|OK 給綠界科技','付款結果網址','若無設定此網址，金流介面會直接顯示結果，不回傳至網頁');

                break;
        }


        return $re;
    }


    /**
     * 執行金流
     * @param $bank = 所屬銀行
     * @param $payData = 金流相關資料
     * @param $data = 購物資訊
     * @throws Exception
     */
    public static function runPaySDK($bank , $payData , $data)
    {
        $reCode = '';


        switch($bank)
        {
            //綠界
            case "ecpay":


                include_once(app_path() . '/Http/Controllers/PaySDK/ECPay.Payment.Integration.php');


                $shopMember = $data['shopCarMember'];//購物者資訊

                try
                {
                    $oPayment = new \ECPay_AllInOne();
                    /* 服務參數 */
                    $oPayment->ServiceURL = $payData['ServiceURL'];
                    $oPayment->HashKey = $payData['HashKey'];
                    $oPayment->HashIV = $payData['HashIV'];
                    $oPayment->MerchantID = $payData['MerchantID'];
                    /* 基本參數 */
                    $oPayment->Send['ReturnURL'] = $payData['ReturnURL'];
                    //$oPayment->Send['ClientBackURL'] = "";


                    $oPayment->Send['MerchantTradeNo'] = $payData['or_no'];
                    $oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
                    $oPayment->Send['TotalAmount'] = (int) $data['shopTotalPriceAndFare'];
                    $oPayment->Send['TradeDesc'] = "莫仔桌遊-購物";
                    $oPayment->Send['ChooseSubPayment'] = \ECPay_PaymentMethodItem::None;

                    //$oPayment->Send['PaymentInfoURL'] = "";
                    //$oPayment->Send['OrderResultURL'] = "";



                    switch($shopMember['payType'])
                    {
                        //線上刷卡
                        case "Credit":
                            $oPayment->Send['ChoosePayment'] =   \ECPay_PaymentMethod::Credit;
                            $oPayment->Send['OrderResultURL'] = $payData['OrderResultURL'];
                            break;
                        //ATM
                        case "ATM":
                            $oPayment->Send['ChoosePayment'] =   \ECPay_PaymentMethod::ATM;
                            $oPayment->Send['OrderResultURL'] = $payData['OrderResultURL'];


                            break;

                        //超商代碼
                        case "CVS":
                            $oPayment->Send['ChoosePayment'] =   \ECPay_PaymentMethod::CVS;
                            $oPayment->Send['OrderResultURL'] = $payData['OrderResultURL'];
                            break;
                        //超商代碼
                        case "BARCODE":
                            $oPayment->Send['ChoosePayment'] =   \ECPay_PaymentMethod::BARCODE;
                            $oPayment->Send['OrderResultURL'] = $payData['OrderResultURL'];
                            break;
                    }

                    $oPayment->Send['Remark'] = "";

                    $oPayment->Send['NeedExtraPaidInfo'] = \ECPay_ExtraPaymentInfo::No;
                    $oPayment->Send['DeviceSource'] =  \ECPay_DeviceType::PC;



                    for($ii=0;$ii<count($data["shopList"]);$ii++)
                    {
                        // 加入選購商品資料。
                        array_push($oPayment->Send['Items'], array('Name' => $data["shopList"][$ii]['productTitle'], 'Price' => (int)($data["shopList"][$ii]['price'] * $data["shopList"][$ii]['qty']),
                            'Currency' => "", 'Quantity' => (int) $data["shopList"][$ii]['qty'], 'URL' => "" ));
                    }




                    /* Alipay 延伸參數 */
                    $oPayment->SendExtend["Email"] = $shopMember['email'];
                    $oPayment->SendExtend["PhoneNo"] = $shopMember['mobile'];
                    $oPayment->SendExtend["UserName"] = $shopMember['name'];

                    if($shopMember['payType'] != 'Credit')
                    {
                        $oPayment->SendExtend["ClientRedirectURL"] = $payData['ClientRedirectURL'];
                    }


                    /* 產生訂單 */
                    $oPayment->CheckOut();
                    /* 產生產生訂單 Html Code 的方法 */
                    $szHtml = $oPayment->CheckOutString();


                    //unset($_SESSION['payMember']);

                }
                catch (Exception $e)
                {
                    // 例外錯誤處理。
                    throw $e;
                }


                break;

            //聯合信用卡中心
            case "nccc":


                $sendData = array(
                    "MerchantID" => $payData['MerchantID'],
                    "TerminalID" => $payData['TerminalID'],
                    "Install" => $payData['Install'],
                    "OrderID" => $payData['or_no'],
                    "TransMode" => $payData['TransMode'],
                    "TransAmt" => $data['shopTotalPriceAndFare'],
                    "NotifyURL" => $payData['NotifyURL'],
                );


            /*
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $payData['ServiceURL']);
                curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
                curl_setopt($ch, CURLOPT_POSTFIELDS,  $sendData );

                //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT,	1200);
                curl_setopt($ch, CURLOPT_FORBID_REUSE,	false);
                curl_setopt($ch, CURLOPT_USERAGENT, "Google Bot");//偽裝成google bot

                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自動跳轉

                curl_exec($ch);
                curl_close($ch);
*/
/*
                $url =   $payData['ServiceURL'].
                        "?MerchantID=".$payData['MerchantID'].
                        "&TerminalID=".$payData['TerminalID'].
                        "&Install=".$payData['Install'].
                        "&OrderID=".'A'.date('ymdHis').
                        "&TransMode=".$payData['TransMode'].
                        "&TransAmt=".(int) $data['shopTotalPriceAndFare'].
                        "&NotifyURL=".$payData['NotifyURL'];
dd($url);
                 header("Location:".urlencode($url));*/

                $sendPath = '<body onload="document.HPP.submit();">
                         <form name="HPP" target="HPPFrame"  method="post" ACTION="'.$payData['ServiceURL'].'">    
                          <iframe name="HPPFrame" id="mainFrame" height="600" width="800"
Frameborder="0"></iframe> 
                         <INPUT type="hidden" name="MerchantID" value="'.$payData['MerchantID'].'">
                         <INPUT type="hidden" name="TerminalID" value="'.$payData['TerminalID'].'">
                         <INPUT type="hidden" name="Install" value="'.$payData['Install'].'">
                         <INPUT type="hidden" name="OrderID" value="'.$payData['or_no'].'">
                         <INPUT type="hidden" name="TransMode" value="'.$payData['TransMode'].'">
                         <INPUT type="hidden" name="TransAmt" value="'.$data['shopTotalPriceAndFare'].'">
                         <INPUT type="hidden" name="NotifyURL" value="'.$payData['NotifyURL'].'" >
                         </form>
                        </body> ';

                echo $sendPath;

                break;


            //中國信託
            case "ctbcbank":




                include(app_path() . '/Http/Controllers/PaySDK/CtbcBank/auth_mpi_mac.php');

                $MACString=\auth_in_mac($payData['MerchantID'],$payData['TerminalID'],$payData['or_no'],$data['shopTotalPriceAndFare'],$payData['txType'],$payData['Option'],$payData['Key'] ,$payData['MerchantName'] ,$payData['AuthResURL'],$payData['OrderDetail'],$payData['AutoCap'],$payData['Customize'],$payData['debug']);
               // $InMac = $MACString;

                $URLEnc=\get_auth_urlenc($payData['MerchantID'],$payData['TerminalID'],$payData['or_no'],$data['shopTotalPriceAndFare'],$payData['txType'],$payData['Option'],$payData['Key'] ,$payData['MerchantName'] ,$payData['AuthResURL'],$payData['OrderDetail'],$payData['AutoCap'],$payData['Customize'],$MACString,$payData['debug']);



                $sendPath = '<body onload="document.HPP.submit();">
                         <form name="HPP" method="post" ACTION="'.$payData['ServiceURL'].'">    
                       	<input type="hidden" name="URLEnc" value="'.$URLEnc.'">
						<input type="hidden" name="merID" value="'.$payData['merID'].'">
                         </form>
                        </body> ';

                echo $sendPath;

                break;
        }
    }



    /**
     * 回傳演算法
     * @param $bank
     * @param $data
     */
    function reAlgorithm($bank , $data)
    {
        $reCode = '';

        switch($bank)
        {
            //綠界
            case "ecpay":


                break;
        }
    }

}


?>