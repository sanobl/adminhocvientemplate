<?php

class Core_ChangeCid {

    private $config;
    protected static $_instance = null;

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    public function CheckRegisterChangeCid($account, $typeform = 0) {

//            $data = array();
//            $data[0] = 1;
//            $data[1] = 1;
//            $data[2] = '2012-01-02';
//            return $data;
        //$account = 'thucnv12';
        /*typeform 
         * 0 form cũ
         * 1 nước ngoài
         * 2 còn cmnd
         * 3 chứng minh tài khoản 
         * trả ra như cũ
        */
        $functionNo = 'RequestPortalService';
        //$aData["serviceName"] = 'CID_CHECK_REGISTER_VALID_ACCOUNT';
        $aData["serviceName"] = 'NEWBE_CID_CHECK_REGISTER_VALID_ACCOUNT';
        $aData["body"] = array($account, $typeform);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->api->sig;
        if (!is_array($aData["body"])) {
            $signal.= $aData['serviceName'];
        } else {
            $temp = "";
            for ($i = 0; $i < count($aData["body"]); $i++) {
                $temp .= $aData["body"][$i];
            }
            $signal .= $aData["serviceName"] . $temp;
        }
        $aData['signal'] = md5(md5($signal));
        try {
            $aData["signal"] = trim(md5($aData["serviceName"] . $account));
            
            $client = new SoapClient($this->config->api->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //echo '<pre>';
            //print_r($arrResult);die;
            if ($arrResult[0] == "1") {
                $data = $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('CheckRegisterChangeCid (Chức năng dieu kien su dung dv changecidonline)', $e->getMessage());
            return '';
        }
        return $data;
        
    }
    public function checkHaveCase($account){
        try {
            $functionNo = 'RequestPortalService';
            //$account = 'copdichoithuyen';
            $aData["serviceName"] = 'CID_CHECK_WAIT_CONFIRM';
            $aData["body"] = array($account);
            $aData['userIP'] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->api->sig;
            if (!is_array($aData["body"])) {
                $signal.= $aData['serviceName'];
            } else {
                $temp = "";
                for ($i = 0; $i < count($aData["body"]); $i++) {
                    $temp .= $aData["body"][$i];
                }
                $signal .= $aData["serviceName"] . $temp;
            }
            $aData['signal'] = md5(md5($signal));                
            $client = new SoapClient($this->config->api->support);
            $oResult = $client->__soapCall($functionNo, array($aData));				
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($arrResult);die;
            if($arrResult[0] == "1")
            {
                    return $arrResult;
                    //print_r($data);die;
            }
            else 
            {
                    return '';
            }
            
        } catch (Exception $e) {
            {
            Core_SendMail::getInstance()->SendMailError('CheckHaveCase (Chức nang kiem tra case cho xac nhan tin nhan)', $e->getMessage());
            return '';
            }		
        //return $data;
        //print_r($data);die;
           
        }

        
    }

    public function checkisVailSMSCode($account, $smscode)
    {
        try
        {
//            $data = array();
//            $data[0]=1;
//           $data[1]=1;
//           $data[2]=0;
//            $data[3]='2012-11-26';
//            $data[4]='3';
//            return $data;
//$account ='thucnv14';
                $functionNo 			= 'RequestPortalService';
                $aData["serviceName"] 	= 'CID_CHECK_ISVALID_SMSCODE';
                $aData["body"]			= array($account,$smscode);
                $aData['userIP'] = Core_Map::getIp();
                $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
                $signal = $this->config->api->sig;
                if (!is_array($aData["body"])) {
                    $signal.= $aData['serviceName'];
                } else {
                    $temp = "";
                    for ($i = 0; $i < count($aData["body"]); $i++) {
                        $temp .= $aData["body"][$i];
                    }
                    $signal .= $aData["serviceName"] . $temp;
                }
                $aData['signal'] = md5(md5($signal));
                
                $client = new SoapClient($this->config->api->support);
                $oResult = $client->__soapCall($functionNo, array($aData));				
                $arrResult = $oResult->RequestPortalServiceResult->string;
                //print_r($arrResult);die;
                if($arrResult[0] == "1")
                {
                        return $arrResult;
                }
                else 
                {
                        return '';
                }
                
                //return
                
        } catch (Exception $e)
        {
            Core_SendMail::getInstance()->SendMailError('checkisVailSMSCode (Chức năng kiem tra ma code)', $e->getMessage());
            return '';
        }		
        //return $data;
    }
    public function deleteSMSCode($account)
    {
        try
        {
                $functionNo 			= 'RequestPortalService';
                $aData["serviceName"] 	= 'CID_DELETE_SMSCODE';
                $aData["body"]			= array($account);
                $aData['userIP'] = Core_Map::getIp();
                $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
                $signal = $this->config->api->sig;
                if (!is_array($aData["body"])) {
                    $signal.= $aData['serviceName'];
                } else {
                    $temp = "";
                    for ($i = 0; $i < count($aData["body"]); $i++) {
                        $temp .= $aData["body"][$i];
                    }
                    $signal .= $aData["serviceName"] . $temp;
                }
                $aData['signal'] = md5(md5($signal));
                
                $client = new SoapClient($this->config->api->support);
                $oResult = $client->__soapCall($functionNo, array($aData));				
                $arrResult = $oResult->RequestPortalServiceResult->string;	

                if($arrResult[0] == "1")
                {
                        return $arrResult;
                }
                else 
                {
                        return '';
                }	
                //return
                
        } catch (Exception $e)
        {
            Core_SendMail::getInstance()->SendMailError('deleteSMSCode (Chức năng reset ma code)', $e->getMessage());
            return '';
        }
    }
    public function checkSpamSMSCode($account='')
    {
        try
        {
//            $data = array();
//            $data[0] = 1;
//            $data[1] = 1;
//            $data[2] = 0;
//            $data[3] = '12/09/2012';
//            return $data;
            //$account ='cst0003';
                $functionNo 		= 'RequestPortalService';
                //$aData["serviceName"] 	= 'CID_CHECK_ISSPAM_SMSCODE';
                $aData["serviceName"] 	= 'NEWBE_CID_CHECK_ISSPAM_SMSCODE';
                $aData["body"]			= array($account);
                $aData['userIP'] = Core_Map::getIp();
                $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
                $signal = $this->config->api->sig;
                if (!is_array($aData["body"])) {
                    $signal.= $aData['serviceName'];
                } else {
                    $temp = "";
                    for ($i = 0; $i < count($aData["body"]); $i++) {
                        $temp .= $aData["body"][$i];
                    }
                    $signal .= $aData["serviceName"] . $temp;
                }
                $aData['signal'] = md5(md5($signal));
                
                $client = new SoapClient($this->config->api->support);
                $oResult = $client->__soapCall($functionNo, array($aData));				
                $arrResult = $oResult->RequestPortalServiceResult->string;	

                if($arrResult[0] == "1")
                {
                        return $arrResult;
                }
                else 
                {
                        return '';
                }	
                //return
                
        } catch (Exception $e)
        {
            Core_SendMail::getInstance()->SendMailError('checkSpamSMSCode (Chức năng kiem tra spam ma code)', $e->getMessage());
            return '';
        }	
        
    }
    public function GeneratorCode_SendsmsChangeCid($account, $phone)
    {
        try
        {
            $isLink = false;
                $functionNo 			= 'RequestPortalService';
                $aData["serviceName"] 	= 'CID_GENERATORCODE_SENDSMS';
                $aData["body"]			= array($account,$phone,$isLink);
                $aData['userIP'] = Core_Map::getIp();
                $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
                $signal = $this->config->api->sig;
                if (!is_array($aData["body"])) {
                    $signal.= $aData['serviceName'];
                } else {
                    $temp = "";
                    for ($i = 0; $i < count($aData["body"]); $i++) {
                        $temp .= $aData["body"][$i];
                    }
                    $signal .= $aData["serviceName"] . $temp;
                }
                $aData['signal'] = md5(md5($signal));
                
                $client = new SoapClient($this->config->api->support);	
                $oResult = $client->__soapCall($functionNo, array($aData));				
                $arrResult = $oResult->RequestPortalServiceResult->string;	

                $data = $arrResult;
                
        } catch (Exception $e)
        {
            Core_SendMail::getInstance()->SendMailError('checkSpamSMSCode (Chức năng kiem tra spam ma code)', $e->getMessage());
            return '';
        }		
        return $data;
    }
    public function saveDataRequest($productId,$requestContentList,$requestContent,$requestContentFieldValue,$requestContentFile)
    {
            try
            {
                    $functionNo 	= 'PostRequestPortalService';
                    $aData["serviceName"] 	= 'CID_SAVE_REQUESTDATA';
                    $arrBoby = array(array($productId),$requestContentList,array($requestContent),$requestContentFieldValue,$requestContentFile);
                    $aData["body"]			= $arrBoby;
                    $aData['userIP'] = Core_Map::getIp();
                    $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
                    $signal = $this->config->api->sig;
//                    if (!is_array($aData["body"])) {
//                        $signal.= $aData['serviceName'];
//                    } else {
//                        $temp = "";
//                        for ($i = 0; $i < count($aData["body"]); $i++) {
//                            $temp .= $aData["body"][$i];
//                        }
//                        $signal .= $aData["serviceName"] . $temp;
//                    }
                    $aData['signal'] = md5(md5($signal));

                    $client = new SoapClient($this->config->api->support);					
                    $oResult = $client->__soapCall($functionNo, array($aData));			
                    $arrResult = $oResult->PostRequestPortalServiceResult->string;				 		
                    //$arrResult = $arrResult->ArrayOfString;
                    if($arrResult[0] == "1")
                    {
                            return $arrResult;

                    }
                    else 
                    {
                        Core_SendMail::getInstance()->SendMailError('Chức năng load save y/c bị lỗi ', '(productId - requestContentList - requestContent - requestContentFieldValue - requestContentFile)'.$productId.','.print_r($requestContentList, 1).','.$requestContent.','.print_r($requestContentFieldValue, 1).','.print_r($requestContentFile, 1));
                        return '';
                    }						
            } catch (Exception $e)
            {
                Core_SendMail::getInstance()->SendMailError('Chức năng load save y/c bị lỗi ', $e->getMessage().'(productId - requestContentList - requestContent - requestContentFieldValue - requestContentFile)'.$productId.','.print_r($requestContentList, 1).','.$requestContent.','.print_r($requestContentFieldValue, 1).','.print_r($requestContentFile, 1));
                return '';
            }			
    }
}

?>
