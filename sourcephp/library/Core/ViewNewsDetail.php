<?php
class Core_ViewNewsDetail {
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
    public function getGuideDetail($FEGuideId) {
        //$pageIndex = $pageIndex - 1;
        //$account = 'canary0502';
        $siteID = APP_SITECONFIG;
        $functionNo = 'GetDetailNewsPortal';
        $aData["serviceName"] = 'GET_DETAIL_NEWS';
        $aData["body"] = array($FEGuideId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;
        
        $aData['signal'] = md5(md5($signal));
       
        try {
            $client = new SoapClient($this->config->FESupport);
            $oResult = $client->__soapCall($functionNo, array($aData));            
            $arrResult = $oResult->GetDetailNewsPortalResult;                       
           //echo '<pre>';print_r($arrResult[0]) ;
           //var_dump($arrResult);die;
            if ($arrResult->string[0] == 1) {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem chi tiet tin tuc: getGuideDetail (Chi tiet tin tuc)', $e->getMessage());
            return '';
        }
    }
    public function getGuideDetailRestAPI($FEGuideId,$PlatformCode,$IsReview) {
        try {
            //echo $PlatformCode;die;
			$PlatformCode = "'A','M','W'";
//next example will recieve all messages for specific conversation
            $service_url = $this->config->FESupport . '/JsonGetDetailNews/' . $FEGuideId.'/'.$PlatformCode.'/'.$IsReview;  

            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);            
            curl_close($curl);
            $decoded = json_decode($curl_response);
            //echo $decoded->CreatedDate;die;
            //echo '<pre>'.$totalRequest;var_dump($curl_response);die;
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                die('error occured: ' . $decoded->response->errormessage);
            }
            return $decoded;
            //echo 'response ok!';
            //var_export($decoded->response);
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem chi tiet tin tuc: getGuideDetailRestAPI (Chi tiet tin tuc)', $e->getMessage());
            return '';
        }
    }
}
?>


