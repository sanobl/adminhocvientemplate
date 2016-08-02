<?php
if (!isset($GLOBALS['THRIFT_ROOT'])){
  $GLOBALS['THRIFT_ROOT'] = dirname(__FILE__).'/thriftlib';
}
if (!isset($GLOBALS['SCRIBE_ROOT'])){
  $GLOBALS['SCRIBE_ROOT'] = dirname(__FILE__).'/Log';
}
require $GLOBALS['SCRIBE_ROOT']. '/scriber.php';
//Date      Time      IP            AccountLogin     Controller/Module          Function/API-Name       ReturnCode       ErrorCode                ParamInput        ExceptionString
class Core_Log{
	public static function log($account = NULL, $controller=NULL, $function=NULL, $retunCode=NULL, $errCode=NULL, $paramInput=array(), $except=NULL){		
		Core_Log::sendLog("{$account}\t{$controller}\t{$function}\t{$retunCode}\t{$errCode}\t{$paramInput}\t{$except}");
	}
        	
        public static function logTracking($dateTime = NULL,$sIp = NULL,$sSessionId = NULL,$sSessionStartTime = NULL,$sSessionEndTime = NULL,$sLogintDate = NULL,$sLogoutDate = NULL,$iActionId = NULL,$sAccount = NULL,$iProductId = NULL,$iRequestTypeId = NULL,$iGuideId = NULL,$sRequestCode = NULL,$sAccessURL = NULL) {
            Core_Log::sendLog("{$dateTime}\t{$sIp}\t{$sSessionId}\t{$sSessionStartTime}\t{$sSessionEndTime}\t{$sLogintDate}\t{$sLogoutDate}\t{$iActionId}\t{$sAccount}\t{$iProductId}\t{$iRequestTypeId}\t{$iGuideId}\t{$sRequestCode}\t{$sAccessURL}");
        }

        public static function sendLog($message=""){
            	$ip = Core_Map::getIp();
		$date = date("Y-m-d	H:i:s");
		$mess = "{$date}\t{$ip}\t{$message}";
		$config = array();
		$config['scribe_servers'] = array(Core_Global::getApplicationIni()->logsystem->scribe_servers);
		$config['scribe_ports'] 	 = array(Core_Global::getApplicationIni()->logsystem->scribe_ports);
		$category = Core_Global::getApplicationIni()->logsystem->category;
                try{
			$scriber = new scriber($config);
                        //print_r($scriber);
                        $scriber->writeLog($category,$mess);                        
		}
		catch(Exception $e){
                   // echo '<pre>';
                    //var_dump($e->getMessage());die;
                    //echo 'testthucnv'; 
			//$mData = array('type'=>'fe_log_exception','code'=>-1,'info'=>array('store'=>'Core_Log_sendLog','err'=>$e->getMessage(),'date'=>date("Y-m-d H:i:s")));
			//Model_Redis::getInstance()->monitorDaily($mData);		
			//return false;
		}
	}	
        public static function writeScribe($iProductId, $iRequestTypeId, $iGuideId, $iActionId, $sRequestCode = '')
	{ 
		try
		{
                    $configTracking = unserialize(CONFIG_TRACKING);
                    $enableTracking = $configTracking['trackingConfig'];
                    if(isset($enableTracking[''.$iActionId.''])){
                        //$sess = new Zend_Session_Namespace('sess');
			$sAccount = Core_Cookies::getCookie('acn');
			if(!isset($sAccount)) $sAccount = '';
			//$sSessionStartTime = $session->getValue['start_time'];
			//if(!isset($sSessionStartTime)) 
                            $sSessionStartTime = '';
			//$sSessionEndTime = $session->getValue['start_time'];
			//if(!isset($sSessionEndTime)) 
                        $sSessionEndTime = '';
			$sIP = Core_Map::getIp();
			$sSessionId = session_id();
			$sLogintDate = date("Y-m-d H:i:s",time());
			$sLogoutDate = date("Y-m-d H:i:s",time());
			$sAccessURL = $_SERVER["REQUEST_URI"];
			if(empty($sRequestCode))$sRequestCode = $sAccount;			
			
			$datetime = date ("Y-m-d H:i:s",time());
			Core_Log::logTracking($datetime, $sIP, $sSessionId, $sSessionStartTime,$sSessionEndTime,$sLogintDate,$sLogoutDate,$iActionId,$sAccount,$iProductId,$iRequestTypeId,$iGuideId,$sRequestCode,$sAccessURL);
                    }
		}catch(Exception $e)
		{
                    //echo 'sfd';
			//var_dump($e);die;
			//Mapper::writeLog('saveTracking', 'Save tracking fail');
		}
		
	}
	
}
?>