<?php
class Core_ViewNews {

    var $config;
    protected static $_instance = null;

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->api;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }
    public function ReplaceSpecialCharacter($string) {
        //$string = '`~!@#$%^&^&*()_+{}[]|\/;:"< >,.?-.<h1>You .</h1><p> text</p>' . "'";
        $string = strip_tags($string, "");
        $string = preg_replace('/[\/\&%#\$\?\:\;\"\'\-\.]/', '', $string);
        if($string=='') $string='a';
        return $string;
    }
    public function getListNews($FEGuideId, $pageIndex, $pageSize, $productId) {
//$pageIndex = $pageIndex - 1;
//$account = 'canary0502';
        $siteID = APP_SITECONFIG;
        $functionNo = 'GetListNewsPortal';
        $aData["serviceName"] = 'GET_LIST_NEWS';
        $aData["body"] = array($FEGuideId, $pageSize, $pageIndex, $productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;

        $aData['signal'] = md5(md5($signal));

        try {
            $client = new SoapClient($this->config->FESupport);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->GetListNewsPortalResult->ArrayOfstring;
//            echo '<pre>';print_r($aData["body"]) ;var_dump($arrResult);die;
            if (array_key_exists(0, $arrResult) && $arrResult[0]->string[0] == 1) {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem danh sach tin tuc: getListNews (Lay danh sach tin tuc)', $e->getMessage());
            return '';
        }
    }

    public function getListNewsRestAPI($FEGuideId, $pageIndex, $pageSize, $productId,$PlatformCode) {
        try { 
           //echo $productId;die;
//next example will recieve all messages for specific conversation
            $service_url = $this->config->FESupport . '/JsonGetListNews/' . $FEGuideId . '/' . $pageSize . '/' . $pageIndex . '/' . $productId.'/'.$PlatformCode;                     
            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            curl_close($curl);
            $decoded =json_decode($curl_response);
            //echo $decoded->NewsContract[0]->CreatedDate;die;
                //echo '<pre>';
                //var_dump($decoded);
                //die;
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                die('error occured: ' . $decoded->response->errormessage);
            }
            return $decoded;
            //echo 'response ok!';
            //var_export($decoded->response);
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem danh sach tin tuc: getListNewsRestAPI (Lay danh sach tin tuc)', $e->getMessage());
            return '';
        }
    }
//public function getSearchListNewsRestAPI($pageIndex, $pageSize,$SearchVal) {
//        try {
//             $SearchValTemp=str_replace(' ', '+', $SearchVal);
//            $service_url = $this->config->FESupport . '/JsonGetSearchListNews/' . $pageSize . '/' . $pageIndex . '/'.$SearchValTemp;            
//            $curl = curl_init($service_url);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8'));
//            $curl_response = curl_exec($curl);
//            curl_close($curl);
//            $decoded = json_decode($curl_response);
//            
//            //echo $decoded->NewsContract[0]->CreatedDate;die;
//                echo '<pre>';
//                var_dump($decoded);
//                die;
//            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
//                die('error occured: ' . $decoded->response->errormessage);
//            }
//            return $decoded;
//            //echo 'response ok!';
//            //var_export($decoded->response);
//        } catch (Exception $e) {
//            var_dump($e->getMessage());die;
//            Core_SendMail::getInstance()->SendMailError('Xem danh sach tin tuc: getListNews (Lay danh sach tin tuc)', $e->getMessage());
//            return '';
//        }
//    }
    public function getSearchListNewsRestAPI($pageIndex, $pageSize,$SearchVal,$PlatformCode) {
        try {           
             //$SearchValTemp=str_replace(' ', '+', $SearchVal);
            $service_url = $this->config->FESupport . '/JsonGetSearchListNews';
            $curl = curl_init($service_url);
            $curl_post_data = array(
               'SearchVal' => $SearchVal,
               'Page' => $pageSize,
               'PageIndex' => $pageIndex,
               'PlatformCode' => $PlatformCode
            );
            $json = json_encode($curl_post_data);
//            $json = '[{"SearchVal":"Gunny","Page":"5","PageIndex":1}]';
//            echo '<pre>';
//                var_dump(json_decode($json));
//             die;
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8'));
            $curl_response = curl_exec($curl);            
            curl_close($curl);
            $decoded = json_decode($curl_response);
                        
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                die('error occured: ' . $decoded->response->errormessage);
            }
            return $decoded;
            //echo 'response ok!';
            //var_export($decoded->response);
        } catch (Exception $e) {            
            Core_SendMail::getInstance()->SendMailError('Xem danh sach tin tuc(Search): getSearchListNewsRestAPI (Lay danh sach tin tuc)', $e->getMessage());
            return '';
        }
    }
}
?>


