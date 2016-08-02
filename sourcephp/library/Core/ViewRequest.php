<?php

class Core_ViewRequest {

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

    public function getRequestContent($requestId, $account, $productId) {
        $siteID = 2; // theo hệ thống cũ: siteID = 2 là sản phẩm ngoài cty.
        $functionNo = 'RequestListPortalService';
        $aData["serviceName"] = 'NEWBE_VIEWREQUEST_GET_DETAIL';
        if (empty($account))
            $account = 'noaccount';
        $aData["body"] = array($requestId, $account, $productId, $siteID);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;

        $aData['signal'] = md5(md5($signal));
        try {
            $client = new MySoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestListPortalServiceResult->ArrayOfstring;
            // echo '<pre>';
            // //print_r($aData["body"]) ;
			// echo "YÊU CẦU XEM LOG GIAO DỊCH: cstool12<br/>\r\n            Sản phẩm: Gunny<br/>\r\n     Server: Gà Ác<br/>\r\n            Tên nhân vật: fd<br/>\r\n            Loại giao dịch: Mua vật phẩm (xu khóa)<br/>\r\n            Thời gian kiểm tra: 29/02/2016 - 01/03/2016";
			// print_r(preg_replace('/[\;]/', '', $arrResult[1]->string[6])) ;
            // var_dump($arrResult);die;
            if (array_key_exists(0, $arrResult) && $arrResult[0]->string[0] == 1) {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem yêu cầu: getRequestContent (Lay noi dung cua 1 yeu cau)', $e->getMessage()
			.' '.json_encode($aData["body"]));
            return '';
        }
    }

    public function havelinksurvey($requestTypeName, $formName = '') {
        $aData['serviceName'] = "GET_SURVEY_BY_FORMNAME";
        $aData['body'] = array($requestTypeName, $formName);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $arrResult = $client->__soapCall('RequestPortalService', array($aData));
//            echo "<pre>";
//            print_r($arrResult); die;
            if (is_array($arrResult->RequestPortalServiceResult->string) && $arrResult->RequestPortalServiceResult->string[0] == 1 && $arrResult->RequestPortalServiceResult->string[1] != "No_data" && $arrResult->RequestPortalServiceResult->string[1] != "0") {
                return $arrResult->RequestPortalServiceResult->string[1];
//                echo "<pre>";
//		print_r($arrResult);die;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Check HaveLinksurvey: HaveLinksurvey(API lay link Survey bang requestcode)', $e->getMessage());
            return '';
        }
    }

    public function linksurvey($requestCode) {
        $aData['serviceName'] = "GET_LINK_SURVEY_BY_REQUESTCODE";

        $aData['body'] = array($requestCode);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $arrResult = $client->__soapCall('RequestPortalService', array($aData));
            if (is_array($arrResult->RequestPortalServiceResult->string) && $arrResult->RequestPortalServiceResult->string[0] == 1 && $arrResult->RequestPortalServiceResult->string[0] != "No_data") {
                return $arrResult->RequestPortalServiceResult->string[1];
            } else {
                return 'No_data';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi Survey: linksurvey(API lay link Survey bang requestcode)', $e->getMessage());
            return '';
        }
    }

    public function insertrequestcodetosurvey($requestCode) {
        $aData['serviceName'] = "SET_ISURVEY_BY_REQUESTCODE";
        $aData['body'] = array($requestCode);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $arrResult = $client->__soapCall('RequestPortalService', array($aData));
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Click on SurveyLink: insertrequestcodetosurvey', $e->getMessage());
        }
    }

    public function getListRequest($account, $pageIndex, $pageSize, $productId = 0, $requestTypeID = 0, $fromDate = '', $toDate = '', $isfb=0,$platformCode = 'W') {
        //$pageIndex = $pageIndex - 1;
        //$account = 'a0987510';
        $siteID = APP_SITECONFIG;
        $functionNo = 'RequestListPortalService';
        $aData["serviceName"] = 'VIEWREQUEST_GET_LIST_REQUEST_FROM_SOLR';
        // $platformCode = '';
        // $vngsupportprod = Core_Cookies::getCookie('vngsupportprod');
        // if ($vngsupportprod == 'PC')
            // $platformCode = 'W';
        // else if ($vngsupportprod == 'MOBILE')
            // $platformCode = 'M';
        $aData["body"] = array($account, $productId, $requestTypeID, $siteID, $pageSize, $pageIndex, $fromDate, $toDate, $isfb, $platformCode);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;

        $aData['signal'] = md5(md5($signal));
        try {
			$client = new MySoapClient($this->config->support); 
			$oResult = $client->__soapCall($functionNo, array($aData));
			
			$arrResult = $oResult->RequestListPortalServiceResult->ArrayOfstring;            
            if (array_key_exists(0, $arrResult) && $arrResult[0]->string[0] == 1) {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem yêu cầu: getListRequest (Lay danh sach yeu cau da gui)', $e->getMessage()
				.' '.json_encode($aData["body"]));
            return '';
        }
    }

    public function UpdateComunicate($requestId, $communicateContent, $sender, $arrFieldValue) {
        $aData['serviceName'] = "NEWBE_VIEWR_UPDATE_COMMUNICATES";
        $accountConnect = Core_Cookies::getCookie('accounctconnect');
        if ($accountConnect == '')
            $accountConnect = $sender;
        $aData['body'] = array($requestId, htmlspecialchars($communicateContent), $sender, $accountConnect);
        //echo count($arrFieldValue);
        //var_dump($arrFieldValue);die;
        if (count($arrFieldValue) > 0)
            $aData['body'] = array_merge($aData['body'], $arrFieldValue);
        //echo '<pre>';
        //    print_r($aData["body"]) ;die;
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));

//            var_dump($result_list);die;
            if (is_array($result_list->RequestPortalServiceResult->string) && $result_list->RequestPortalServiceResult->string[0] != 0) {
                return $result_list->RequestPortalServiceResult->string;
            } else {
                return 'No_data';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: getInfoAccountByAccount(Lay thong tin tai khoan gui y/c)', $e->getMessage());
            return '';
        }
    }

    public function UpdateComunicateIngame($requestId, $communicateContent, $sender, $arrFieldValue, $accountConnect) {
        $aData['serviceName'] = "NEWBE_VIEWR_UPDATE_COMMUNICATES";
        $aData['body'] = array($requestId, htmlspecialchars($communicateContent), $sender, $accountConnect);
        //echo count($arrFieldValue);
        //var_dump($arrFieldValue);die;
        if (count($arrFieldValue) > 0)
            $aData['body'] = array_merge($aData['body'], $arrFieldValue);
        //echo '<pre>';
        //    print_r($aData["body"]) ;die;
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));
// echo '<pre>';var_dump($aData['body']);
            // var_dump($result_list);die;
            if (is_array($result_list->RequestPortalServiceResult->string) && $result_list->RequestPortalServiceResult->string[0] != 0) {
                return $result_list->RequestPortalServiceResult->string;
            } else {
                return 'No_data';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: getInfoAccountByAccount(Lay thong tin tai khoan gui y/c)', $e->getMessage());
            return '';
        }
    }

    public function getListRequestInGame($account, $pageIndex, $pageSize, $productId = 0, $requestTypeID = 0, $fromDate = '', $toDate = '', $isfb) {
        $siteID = 3;
        $functionNo = 'RequestListPortalService';
        $aData["serviceName"] = 'VIEWREQUEST_GET_LIST_REQUEST_FROM_SOLR';
        $aData["body"] = array($account, $productId, $requestTypeID, $siteID, $pageSize, $pageIndex, $fromDate, $toDate, $isfb);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;

        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestListPortalServiceResult->ArrayOfstring;
            //echo '<pre>';print_r($aData["body"]) ;var_dump($arrResult);die;
            if (array_key_exists(0, $arrResult) && $arrResult[0]->string[0] == 1) {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem yêu cầu: getListRequestInGame (Lay danh sach yeu cau da gui)', $e->getMessage().' '.json_encode($aData["body"]));
            return '';
        }
    }

}
class MySoapClient extends \SoapClient
{
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {      
        $xml = parent::__doRequest($request, $location, $action, $version);
		//$response = preg_replace( '/^(\x00\x00\xFE\xFF|\xFF\xFE\x00\x00|\xFE\xFF|\xFF\xFE|\xEF\xBB\xBF)/', "", $xml );
		$xml = preg_replace('/&#x[0-1]?[0-9A-E]/', ' ', $xml);
		return $xml;
    }
}
?>