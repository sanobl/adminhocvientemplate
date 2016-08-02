<?php
class Core_ViewBannerAds {
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
    public function getListBanner() {
        //$pageIndex = $pageIndex - 1;
        //$account = 'canary0502';
        $siteID = APP_SITECONFIG;
        $functionNo = 'GetListNewsPortal';
        $aData["serviceName"] = 'GET_LIST_BANNER_ADS';
        $aData["body"] = array();
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
    public function getListBannerRestAPI($platformCode,$GuideType) {
        try {
//next example will recieve all messages for specific conversation
            $service_url = $this->config->FESupport . '/JsonGetListBannerAds/'.$platformCode.'/'.$GuideType;                
            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);            
            curl_close($curl);
            $decoded = json_decode($curl_response);
            
            //echo $decoded->NewsContract[0]->CreatedDate;die;
            //echo '<pre>'.$totalRequest;var_dump($decoded);die;
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                die('error occured: ' . $decoded->response->errormessage);
            }
            return $decoded;
            //echo 'response ok!';
            //var_export($decoded->response);
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem danh sach banner: getListBannerRestAPI (Lay danh sach tin tuc)', $e->getMessage());
            return '';
        }
    }
}
?>




