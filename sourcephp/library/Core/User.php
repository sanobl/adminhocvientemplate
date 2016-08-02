<?php

define('VND_SESSION_HOST', Core_Global::getApplicationIni()->app->static->session->host);
define('VNG_SESSION_PORT', Core_Global::getApplicationIni()->app->static->session->port);

class Core_User {

    var $config;
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

    public function checkAccountFromPassport($account) {
        $result_list = '';
        try {
            //$sFunctionName = 'RequestService';
            $body = array(
                array('ACC', trim($account))
            );
            //$aData["serviceName"] = "GET_ACCOUNT_INFO";
            //$aData["serviceName"] = "IDZING_GET_ACCOUNT_INFO";
            $aData["function"] = "GET_ACCOUNT_INFO_BASIC_WITH_FULLNAME";
            $aData["body"] = $body;
            $aData["requestId"] = rand();
            $aData["userIP"] = Core_Map::getIp();
            $aData["clientType"] = $this->config->passport->data->wsClientType;
            $aData["wsAccount"] = $this->config->passport->data->wsAccount;
            $aData["wsPassword"] = $this->config->passport->data->wsPassword;
            $aData["productId"] = $this->config->passport->data->productId;
            //echo $this->config->passport;die;
            $client = new SoapClient($this->config->passport->url);
            $result_list = $client->__soapCall('RequestService', array($aData));
            //var_dump($result_list->RequestServiceResult);die;
            return $result_list->RequestServiceResult;
        } catch (Exception $e) {
            $result_list = '';
            ////Mapper::writeLog('checkAccountFromPassport', 'Call service fail');
        }
        return $result_list;
    }
	public function checkAccountFromPassportNew($account) {
        $arrParams = array(
            'accountName'    => $account,
            'auth'          => $this->config->api->passportWrapperauth,
            'ip'            => Core_Map::getIp(),
            'sourceCall'    => 'FE'
        );
        //var_dump($arrParams);
        try {
            $client = new SoapClient($this->config->passport->url);
            $result_list = $client->getAccountInfoByAcn($arrParams);
            //var_dump($this->config->passport->url); 
            // var_dump($result_list);die;
            $result_list = json_decode($result_list->getAccountInfoByAcnResult);
            
            if ($result_list->code == 3) {
                return $result_list->data;
            }
            else{
                return '';
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());die;
            Core_SendMail::getInstance()->SendMailError('lay tai khoan: getAccountInfoByAcn', $e->getMessage());
            return '';
        }
    }
    public function checkLoginStatus() {
        $cookies = Core_Cookies::getCookie('vngauth');
        $vngSession = $this->getVNGSession($cookies);        
        return $vngSession;
    }

    public function getCookies() {
         /*return array('vngauth' => 'gAHef3LF21E9miYDv0cjABhaxWw=',
              'uin' => 'o0052861501',
              'skey' => '',
              'acn' => 'vlkh046502');*/
        return array(
            'vngauth' => Core_Cookies::getCookie('vngauth'),
            'uin' => Core_Cookies::getCookie('uin'),
            'skey' => Core_Cookies::getCookie('skey'),
            'acn' => Core_Cookies::getCookie('acn')
        );
    }

    public function getVNGSession($vngauth = '', $host = VND_SESSION_HOST, $port = VNG_SESSION_PORT) {
//        if(Core_Cookies::getCookie('gialogin') != '')
//		  return array('uin' => 'o0052861501', 'acn' => 'toilaaibmt');
//	  else
//		 return false;
        try {
            // $obj = new Core_Session(array('host' => $host, "port" => $port));
			// echo $_SERVER['HTTP_USER_AGENT']. '<br/>';
            // $useragent = strtoupper(md5($_SERVER['HTTP_USER_AGENT']));
			// echo $useragent.'<br>';
            // $result = $obj->read($vngauth);
            // $ip = $_SERVER['REMOTE_ADDR'];
			// var_dump($result);die;
            // if ($result->resultCode == 0) {
                // if ($result->session->useragent != $useragent)
                    // return false;
                // var_dump($result->session);die;
                // return array('uin' => $result->session->uin, 'acn' => strtolower($result->session->accountName));
            // }
            // return false;
			
			$cookies =  $this->getCookies();
			if($cookies['vngauth'] && $cookies['uin']){
				$obj = new Core_Session(array('host' => $host, "port" => $port));
				$result = $obj->read($vngauth);		
				if($result->resultCode == 0){
					if($cookies['uin'] != 'o'.$this->converAccountCode($result->session->uin))
					{
						$this->clearCookies();
						return false;
					}
					return array('uin' => $result->session->uin, 'acn' => strtolower($result->session->accountName));
				}	
			}
			$this->clearCookies();
			return false;
        } catch (Exception $e) {
            //Model_Redis::getInstance()->monitorDaily(array('type'=>'fe_vng_session_exception','code'=>-1,'info'=>array('store'=>'Core_Session_getVNGSession','err'=>$e->getMessage(),'date'=>date("Y-m-d H:i:s"))));																

            return array('uin' => '', 'acn' => '');
        }
    }
	private static function converAccountCode($passportID=''){
		$passportID = trim($passportID);
		if(strlen($passportID) == 10)
			return $passportID;
		$numZero = 9-strlen($passportID);
		$tmp = '0';
		for($i=0;$i<$numZero;$i++){
			$tmp.='0';
		}				
		$passportID = $tmp.$passportID;
		if(strlen($passportID) == 10)
			return $passportID;
		return 0;
	}
	private static function clearCookies()
	{
		try{
			header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');
			setcookie('vngauth', 'deleted', time()-365*24*3600, '/', 'zing.vn');
			setcookie('uin', 'deleted', time()-365*24*3600, '/', 'zing.vn');
			setcookie('skey', 'deleted', time()-365*24*3600, '/', 'zing.vn');
			setcookie('acn', 'deleted', time()-365*24*3600, '/', 'zing.vn');
			setcookie('acs', 'deleted', time()-365*24*3600, '/', 'zing.vn');
			setcookie('ZAUTH', 'deleted', time()-365*24*3600, '/', 'zing.vn');
			setcookie('ZMES', 'deleted', time()-365*24*3600, '/', 'zing.vn');
		}catch(Exception $e)
		{
		}
	}
    public function getlist_productId_BySiteId() {
        $siteID = $this->config->site->siteconfig;
        $functionNo = 'RequestPortalService';
        $aData["serviceName"] = 'VIEWR_GETLIST_PRODUCTID_BYSITEID';
        $aData["body"] = array($siteID);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;
        if (!is_array($aData["body"])) {
            $signal .= $this->config->sig . $aData['serviceName'];
        } else {
            $temp = "";
            for ($i = 0; $i < count($aData["body"]); $i++) {
                $temp .= $aData["body"][$i];
            }
            $signal .= $aData["serviceName"] . $temp;
        }
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->api->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //var_dump($arrResult); die;
            if ($arrResult[0] == 1 && strtolower(trim($arrResult[0])) != 'no_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            return '';
        }
    }

    /*     * *Get User Login* */

    public function getUserLogin($vngauth = '') {
        $userinfo = array();
        try {
            $options = array(
                'host' => $this->config->sso->server,
                'port' => $this->config->sso->port
            );
            $session = new Core_Session($options);
            $useragent = strtoupper(md5($_SERVER['HTTP_USER_AGENT']));
            $result = $session->read($vngauth);
            if ($result->resultCode == 0) {
                if ($result->session->useragent != $useragent) {
                    
                }
                $userinfo = array('passportid' => $result->session->uin, 'zingid' => strtolower($result->session->accountName));
            } else {
                setcookie("uin", NULL, 0, "/", Core_Global::getApplicationIni()->frontend->cookieDomain);
                setcookie("acn", NULL, 0, "/", Core_Global::getApplicationIni()->frontend->cookieDomain);
                setcookie("vngauth", NULL, 0, "/", Core_Global::getApplicationIni()->frontend->cookieDomain);
            }
        } catch (Exception $e) {
            
        }
        return $userinfo;
    }
    
    /*  tin hot */
    public function getlistannouncements($productID, $siteID) {
        try {
            $functionNo = 'RequestListPortalService';
            $aData["serviceName"] = 'ANN_GET_LIST_ANNOUNCEMENTS';
            $aData["body"] = array($productID, $siteID);
            $aData['userIP'] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
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
            $arrResult = $oResult->RequestListPortalServiceResult->ArrayOfstring;
            //print_r($arrResult);die;
            if($arrResult[0]->string[0] == 1)
                return $arrResult;
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getlistannouncements ( tin hot)', $e->getMessage());
            return '';
        }
    }
    /*  tin hot */
    public function getlistkeywordbyprod($productID, $siteID) {
        try {
            $functionNo = 'RequestListPortalService';
            $aData["serviceName"] = 'KEYWORD_GET_LIST_BY_PRODUCT';
            $aData["body"] = array($productID, $siteID);
            $aData['userIP'] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
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
            $arrResult = $oResult->RequestListPortalServiceResult->ArrayOfstring;
            //print_r($arrResult);die;
            if($arrResult[0]->string[0] == 1)
                return $arrResult;
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getlistannouncements ( tin hot)', $e->getMessage());
            return '';
        }
    }
	public function getProfileByAccount($account) {  
        try { 	
            $service_url = $this->config->api->openAPI;
            $service_url .= 'internalGetProfileByAccount/'. $account;
            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
			if ($curl_response === false) {
                $info = curl_getinfo($curl);
                Core_SendMail::getInstance()->SendMailError('lay profile: getProfileByAccount', json_encode($info). ' '. $service_url );
                return '';
            }
            
            curl_close($curl);  			
            $decoded = json_decode($curl_response);
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                Core_SendMail::getInstance()->SendMailError('lay profile: getProfileByAccount', $decoded->response->errormessage);
                return '';
            }
			
            return $decoded;
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('lay profile: getProfileByAccount', $e->getMessage());
            return '';
        }
    }
    public function getTop5ProfileByAccount($account, $typeProfile) {
        //$typeProfile 0: email
        //$typeProfile 1: phone
        try {            
            $service_url = $this->config->api->openAPI;
            $service_url .= 'internalGetListProfileByAccount/'. $account.'/'.$typeProfile;
            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            if ($curl_response === false) {
                $info = curl_getinfo($curl);
                Core_SendMail::getInstance()->SendMailError('lay profile: getTop5ProfileByAccount', json_encode($info). ' '. $service_url );
                return '';
            }
            curl_close($curl);  
            $decoded = json_decode($curl_response);
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                Core_SendMail::getInstance()->SendMailError('lay profile: getProfileByAccount', $decoded->response->errormessage);
                return '';
            }
            return $decoded;
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('lay profile: getProfileByAccount', $e->getMessage());
            
            return '';
        }
    }
    public function UpdateProfileByAccount($curl_post_data) {  
        try {            
            $service_url = $this->config->api->openAPI;
            $service_url .= 'internalSetProfileByAccount';
            $curl = curl_init($service_url);
            
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data));                                                                  
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen(json_encode($curl_post_data)))                                                                       
            );            
            $curl_response = curl_exec($curl);         
            if ($curl_response === false) {
                $info = curl_getinfo($curl);
                Core_SendMail::getInstance()->SendMailError('set profile: UpdateProfileByAccount', json_encode($info). ' '. json_encode($curl_post_data) );
                return '';
            }
            curl_close($curl);            
            $decoded = json_decode($curl_response);
            //var_dump($curl_post_data);
//            var_dump($decoded);
            if (isset($decoded->ErrorCode) && $decoded->ErrorCode == '0') {
//                Core_SendMail::getInstance()->SendMailError('set profile: UpdateProfileByAccount', $decoded->response->errormessage);
                return '1';
            }
            else {
                Core_SendMail::getInstance()->SendMailError('set profile: UpdateProfileByAccount', $decoded->response->errormessage);
                return $decoded->ErrorCode;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('set profile: UpdateProfileByAccount', $e->getMessage());
             //var_dump($e);die;
            return '';
        }
    }
    
}

?>