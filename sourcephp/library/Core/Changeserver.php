<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Core_Changeserver {
    private $config;
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
	//NEWBE_REQS_SAVE_REQUESTDATA
    public function SaveDataRequest_NewBE_CHANGESERVER($productId, $requestContentList, $requestContent, $requestContentFieldValue) {
        $aData['serviceName'] = 'NEWBE_REQS_SAVE_REQUESTDATA';
        $accountConnect = Core_Cookies::getCookie('accounctconnect');
        if($accountConnect == '')
            $accountConnect = Core_Cookies::getCookie('acn');
        array_push($requestContentList, $accountConnect);
        $aData['body'] = array(array($productId), $requestContentList, array($requestContent), $requestContentFieldValue);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->newcorechangeserver);
            $result_list = $client->__soapCall('PostRequestPortalService', array($aData));
            //echo '<pre>';
            //print_r($aData['body']);
            //print_r($result_list);die;
            if ($result_list->PostRequestPortalServiceResult->string[0] == 1) {
                return $result_list->PostRequestPortalServiceResult->string;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            //print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: SaveDataRequest_NewBE', $e->getMessage());
            return 0;
        }
    }
    /*------------- Lay danh sach Move server config --------------------*/
    public function GetMoveServerConfig(){
        $aData['serviceName'] = "SRV_GET_CHANGE_SERVER_CONFIGS";
        $aData['body'] = array('');
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
        $client = new SoapClient($this->config->newcorechangeserver);
        $oResult = $client->__soapCall('RequestPortalService', array($aData));
        $arrResult = $oResult->RequestPortalServiceResult->string;
        //echo '<pre>';
        //var_dump($arrResult);die;
            if ($arrResult[0] == "1" && $arrResult[1] != "") {
                return json_decode($arrResult[1]);
                
            } else {
                    return 'No_data';
             }
        }
        catch (Exception $e){
            Core_SendMail::getInstance()->SendMailError('Check Product Move server: Lay danh sach chuyen server bao gom thoi gian cua dot chuyen', $e->getMessage());
        return '';            
    }
            
}
    public function GetProductMoveServer(){
        $aData['serviceName'] = "SRV_GET_PRODUCTS";
        $aData['body'] = array('');
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
        $client = new SoapClient($this->config->newcorechangeserver);
        $oResult = $client->__soapCall('RequestPortalService', array($aData));
        $arrResult = $oResult->RequestPortalServiceResult->string;
        //echo '<pre>';
        //var_dump($arrResult);die;
            if ($arrResult[0] == "1" && $arrResult[1] != "") {
                return json_decode($arrResult[1]);
                
            } else {
                    return 'No_data';
             }
        }
        catch (Exception $e){
            Core_SendMail::getInstance()->SendMailError('Check Product Move server: Lay danh sach chuyen server bao gom thoi gian cua dot chuyen', $e->getMessage());
        return '';            
    }
            
}
    
    /* Get List Product Accpet chuyen Server */
    
    public function GetProduct(){
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = 101;
//        $arrResult[2] = "Võ Lâm Truyền Kỳ 2";
//        $arrResult[3] = 102;
//        $arrResult[4] = "Kiếm Thế";
//        return $arrResult;
        
        try{
            
        }catch (Exception $e){
        Core_SendMail::getInstance()->SendMailError('GetProduct Lay danh sach San Pham duoc phep chuyen server',$e->getMessage().'formid: '.$formid);
        
        }       
    }
    
    /* Get List Server Source (Máy chủ nguồn) */
    
    public function GetServerSource($moveseverconfigid, $account){
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = 101;
//        $arrResult[2] = "Server 1";
//        $arrResult[3] = 102;
//        $arrResult[4] = "server 2";
//        return $arrResult;
        $aData['serviceName'] = "SRV_GET_SOURCE_SERVERS";
        $aData['body'] = array($moveseverconfigid, $account);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));     
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
        //echo '<pre>';
        //var_dump($aData);
        //var_dump($arrResult);die;
            if ($arrResult[0] == "1" && $arrResult[1] != "") {
                return json_decode($arrResult[1]);
                
            } else {
                    return 'No_data';
             }
        }catch (Exception $e){
        Core_SendMail::getInstance()->SendMailError('GetServerSource Lay danh sach Server Nguon',$e->getMessage().'requestId: '.$requestId);
        
        }        
    }
    
    /* Get List Server Dest (Máy chủ Đích và số Xu của máy server đó) */
    public function GetServerDest($moveseverconfigid, $serversourceid){
        $aData['serviceName'] = "SRV_GET_DEST_SERVERS";
        $aData['body'] = array($moveseverconfigid, $serversourceid);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //echo '<pre>';
            //print_r($aData);
            //print_r($arrResult);die;
             if ($arrResult[0] == "1" && $arrResult[1] != "") {
                return json_decode($arrResult[1]);
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
            //print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('GetServerDest Lay danh sach Server Dich va Gia tien',$e->getMessage());        
        }       
    }
    public function Getcharacters($moveseverconfigid, $serversourceid, $account){
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = "Role 1";
//        $arrResult[2] = "Role 2";
//        $arrResult[3] = "Role 3";
//        
//        return $arrResult;
        //$account = 'jx2acc001';
        $isfe = 'FE';
        $aData['serviceName'] = "SRV_GET_CHARACTERS";
        $aData['body'] = array($moveseverconfigid, $serversourceid, $account, $isfe);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //echo'<pre>';
            //var_dump($aData);
            //var_dump($arrResult);die;
             if ($arrResult[0] == "1" && $arrResult[1] != "" && $arrResult[1] !='"Empty result"') {
                return json_decode($arrResult[1]);
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
        Core_SendMail::getInstance()->SendMailError('GetServerDest Lay danh sach Server Dich va Gia tien',$e->getMessage());
        
        }       
    }
public function Checkcasemoveserver($moveseverconfigid, $account){
        $aData['serviceName'] = "SRV_CHECK_CASE_EXISTS";
        $aData['body'] = array($moveseverconfigid, $account);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($aData);
            //print_r($arrResult);die;
             if ($arrResult[0] == "1" && $arrResult[1] != "") {
                return $arrResult;
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
            //print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('GetServerDest Lay danh sach Server Dich va Gia tien',$e->getMessage());        
        }       
    }
    public function Checkpayofaccount($moveseverconfigid, $account){
        //return 100;
        $aData['serviceName'] = "SRV_GET_ZXU_OF_ACCOUNT";
        $aData['body'] = array($moveseverconfigid, $account);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($aData);
            //print_r($arrResult);die;
             if (is_array($arrResult)/*[0] == "1" && $arrResult[1] != ""*/) {
                return $arrResult;
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
            // print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('Check so tien KH dang co',$e->getMessage());        
        }       
    }
public function Checkpayserver($moveseverconfigid, $serversourceid, $serverdestid,$account,$level){
        //return 50;
        $aData['serviceName'] = "SRV_GET_ZXU_FOR_CHANGE_SERVER";
        $aData['body'] = array($moveseverconfigid, $serversourceid, $serverdestid, $account, $level);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($aData);
            //print_r($arrResult);die;
             if ($arrResult[0] == "1" && $arrResult[1] != "") {
                return $arrResult;
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
            //print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('So tien KH phai tra ',$e->getMessage().'serverdestID: '. $serverdestid);        
        }       
    }    
    public function CancelMoveServer($requestId, $account, $productId){
        $aData['serviceName'] = "SRV_CANCEL_CHANGE_SERVER";
        $aData['body'] = array($requestId, $account, $productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //echo '<pre>';
			//print_r($aData);
            //print_r($arrResult);die;
             if (is_array($arrResult) ) {
                return $arrResult;
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
            //print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('GetServerDest Lay danh sach Server Dich va Gia tien',$e->getMessage());        
        }       
    }
    public function converttext($rolenametext) {
        
        $arrVNTime   = array('A','a','¸','¸','µ','µ','¶','¶','·','·','•','¹','¹','¡','¨','¾','¾','»','»','¼','¼','½','½','Æ','Æ','¢','©','Ê','Ê','Ç','Ç','È','È','É','É','Ë','Ë','B','b','C','c','D','d','§','®','E','e','Ð','Ð','Ì','Ì','Î','Î','Ï','Ï','Ñ','Ñ','£','ª','Õ','Õ','Ò','Ò','Ó','Ó','Ô','Ô','Ö','Ö','F','f','G','g','H','h','I','i','Ý','Ý','×','×','Ø','Ø','Ü','Ü','Þ','Þ','J','j','K','k','L','l','M','m','N','n','O','o','ã','ã','ß','ß','á','á','â','â','ä','ä','¤','«','è','è','å','å','æ','æ','ç','ç','é','é','¥','¬','í','í','ê','ê','ë','ë','ì','ì','î','î','P','p','Q','q','R','r','S','s','T','t','U','u','ó','ó','ï','ï','ñ','ñ','ò','ò','ô','ô','¦','­','ø','ø','õ','õ','ö','ö','÷','÷','ù','ù','V','v','W','w','X','x','Y','y','ý','ý','ú','ú','û','û','ü','ü','þ','þ','Z','z','Å','ð','Ã','0','1','2','3','4','5','6','7','8','9','_','*',']','@','}','-',';','-','~','[','$',' ','>','<','?','!','#','%','^','(',')','.','\'','"','=','+',':','`');	
        //$arrUNICODE_UCS2W = array('A','a','&#225;','&#225;','&#224;','&#224;','&#7843;','&#7843;','&#227;;','&#227;','.','&#7841;','&#7841;','&#258;','&#259;','&#7854;','&#7855;','&#7856;','&#7857;','&#7858;','&#7859;','&#7860;','&#7861;','&#7862;','&#7863;','&#194;','&#226;','&#7845;','&#7845;','&#7847;','&#7847;','&#7848;','&#7849;','&#7850;','&#7851;','&#7852;','&#7853;','B','b','C','c','D','d','&#272;','&#273;','E','e','&#233;','&#233;','&#200;','&#232;','&#7866;','&#7867;','&#7868;','&#7869;','&#7864;','&#7865;','&#202;','&#234;','&#7871;','&#7871;','&#7872;','&#7873;','&#7875;','&#7875;','&#7876;','&#7877;','&#7879;','&#7879;','F','f','G','g','H','h','I','i','&#237;','&#237;','&#236;','&#236;','&#7880;','&#7881;','&#297;','&#297;','&#7883;','&#7883;','J','j','K','k','L','l','M','m','N','n','O','o','&#211;','&#243;','&#210;','&#242;','&#7887;','&#7887;','&#245;','&#245;','&#7885;','&#7885;','&#212;','&#244;','&#7889;','&#7889;','&#7891;','&#7891;','&#7892;','&#7893;','&#7894;','&#7895;','&#7897;','&#7897;','&#416;','&#417;','&#7899;','&#7899;','&#7900;','&#7901;','&#7905;','&#7903;','&#7905;','&#7905;','&#7906;','&#7907;','P','p','Q','q','R','r','S','s','T','t','U','u','&#250;','&#250;','&#217;','&#249;','&#7910;','&#7911;','&#361;','&#361;','&#7909;','&#7909;','&#431;','&#432;','&#7912;','&#7913;','&#7914;','&#7915;','&#7917;','&#7917;','&#7918;','&#7919;','&#7920;','&#7921;','V','v','W','w','X','x','Y','y','&#253;','&#253;','&#7923;','&#7923;','&#7927;','&#7927;','&#7928;','&#7929;','&#7924;','&#7925;','Z','z','&#195;','&#272;','&#195;','0','1','2','3','4','5','6','7','8','9','_','*',']','@','}','-',';','-','~','[','$',' ','&gt;','&lt;','?','!','#','%','^','(',')','.','\'','"','=','+',':','`');
        $arrUNICODE_UCS2W = array('A','a','á','á','à','à','ả','ả','ã;','ã','.','ạ','ạ','Ă','ă','Ắ','ắ','Ằ','ằ','Ẳ','ẳ','Ẵ','ẵ','Ặ','ặ','Â','â','ấ','ấ','ầ','ầ','Ẩ','ẩ','Ẫ','ẫ','Ậ','ậ','B','b','C','c','D','d','Đ','đ','E','e','é','é','È','è','Ẻ','ẻ','Ẽ','ẽ','Ẹ','ẹ','Ê','ê','ế','ế','Ề','ề','ể','ể','Ễ','ễ','ệ','ệ','F','f','G','g','H','h','I','i','í','í','ì','ì','Ỉ','ỉ','ĩ','ĩ','ị','ị','J','j','K','k','L','l','M','m','N','n','O','o','Ó','ó','Ò','ò','ỏ','ỏ','õ','õ','ọ','ọ','Ô','ô','ố','ố','ồ','ồ','Ổ','ổ','Ỗ','ỗ','ộ','ộ','Ơ','ơ','ớ','ớ','Ờ','ờ','ỡ','ở','ỡ','ỡ','Ợ','ợ','P','p','Q','q','R','r','S','s','T','t','U','u','ú','ú','Ù','ù','Ủ','ủ','ũ','ũ','ụ','ụ','Ư','ư','Ứ','ứ','Ừ','ừ','ử','ử','Ữ','ữ','Ự','ự','V','v','W','w','X','x','Y','y','ý','ý','ỳ','ỳ','ỷ','ỷ','Ỹ','ỹ','Ỵ','ỵ','Z','z','Ã','Đ','Ã','0','1','2','3','4','5','6','7','8','9','_','*',']','@','}','-',';','-','~','[','$',' ','>','<','?','!','#','%','^','(',')','.','\'','"','=','+',':','`');		
		
        $i=0;
        $tmpStr = $rolenametext;
        foreach ($arrVNTime as $cChar){
                $nPos = strpos($tmpStr,$cChar);
                if($nPos !== false){	
                    $rolenametext = str_replace($cChar,$arrUNICODE_UCS2W[$i],$rolenametext);
                }
                $i++;			
        }
        return $rolenametext;
        
        
    }
    
    public function ConvertTextJX1($sString){		
        $sStringTemp = $sString;
        //==> C1: return mb_convert_encoding($sString,"utf-8","iso-8859-1");

        $arrVNTime   = array('A','a','¸','¸','µ','µ','¶','¶','·','·','•','¹','¹','¡','¨','¾','¾','»','»','¼','¼','½','½','Æ','Æ','¢','©','Ê','Ê','Ç','Ç','È','È','É','É','Ë','Ë','B','b','C','c','D','d','§','®','E','e','Ð','Ð','Ì','Ì','Î','Î','Ï','Ï','Ñ','Ñ','£','ª','Õ','Õ','Ò','Ò','Ó','Ó','Ô','Ô','Ö','Ö','F','f','G','g','H','h','I','i','Ý','Ý','×','×','Ø','Ø','Ü','Ü','Þ','Þ','J','j','K','k','L','l','M','m','N','n','O','o','ã','ã','ß','ß','á','á','â','â','ä','ä','¤','«','è','è','å','å','æ','æ','ç','ç','é','é','¥','¬','í','í','ê','ê','ë','ë','ì','ì','î','î','P','p','Q','q','R','r','S','s','T','t','U','u','ó','ó','ï','ï','ñ','ñ','ò','ò','ô','ô','¦','­','ø','ø','õ','õ','ö','ö','÷','÷','ù','ù','V','v','W','w','X','x','Y','y','ý','ý','ú','ú','û','û','ü','ü','þ','þ','Z','z','Å','ð','Ã','0','1','2','3','4','5','6','7','8','9','_','*',']','@','}','-',';','-','~','[','$',' ','>','<','?','!','#','%','^','(',')','.','\'','"','=','+',':','`');
        //$arrUNICODE_UCS2W = array('A','a','&#193;','&#225;','&#192;','&#224;','&#7842;','&#7843;','&#195;','&#227;','.','&#7840;','&#7841;','&#258;','&#259;','&#7854;','&#7855;','&#7856;','&#7857;','&#7858;','&#7859;','&#7860;','&#7861;','&#7862;','&#7863;','&#194;','&#226;','&#7844;','&#7845;','&#7846;','&#7847;','&#7848;','&#7849;','&#7850;','&#7851;','&#7852;','&#7853;','B','b','C','c','D','d','&#272;','&#273;','E','e','&#201;','&#233;','&#200;','&#232;','&#7866;','&#7867;','&#7868;','&#7869;','&#7864;','&#7865;','&#202;','&#234;','&#7870;','&#7871;','&#7872;','&#7873;','&#7874;','&#7875;','&#7876;','&#7877;','&#7878;','&#7879;','F','f','G','g','H','h','I','i','&#205;','&#237;','&#204;','&#236;','&#7880;','&#7881;','&#296;','&#297;','&#7882;','&#7883;','J','j','K','k','L','l','M','m','N','n','O','o','&#211;','&#243;','&#210;','&#242;','&#7886;','&#7887;','&#213;','&#245;','&#7884;','&#7885;','&#212;','&#244;','&#7888;','&#7889;','&#7890;','&#7891;','&#7892;','&#7893;','&#7894;','&#7895;','&#7896;','&#7897;','&#416;','&#417;','&#7898;','&#7899;','&#7900;','&#7901;','&#7902;','&#7903;','&#7904;','&#7905;','&#7906;','&#7907;','P','p','Q','q','R','r','S','s','T','t','U','u','&#218;','&#250;','&#217;','&#249;','&#7910;','&#7911;','&#360;','&#361;','&#7908;','&#7909;','&#431;','&#432;','&#7912;','&#7913;','&#7914;','&#7915;','&#7916;','&#7917;','&#7918;','&#7919;','&#7920;','&#7921;','V','v','W','w','X','x','Y','y','&#221;','&#253;','&#7922;','&#7923;','&#7926;','&#7927;','&#7928;','&#7929;','&#7924;','&#7925;','Z','z','&#195;','&#272;','&#195;');		
        //$arrUNICODE_UCS2W = array('A','a','&#225;','&#225;','&#224;','&#224;','&#7843;','&#7843;','&#227;;','&#227;','.','&#7841;','&#7841;','&#258;','&#259;','&#7854;','&#7855;','&#7856;','&#7857;','&#7858;','&#7859;','&#7860;','&#7861;','&#7862;','&#7863;','&#194;','&#226;','&#7845;','&#7845;','&#7847;','&#7847;','&#7848;','&#7849;','&#7850;','&#7851;','&#7852;','&#7853;','B','b','C','c','D','d','&#272;','&#273;','E','e','&#233;','&#233;','&#200;','&#232;','&#7866;','&#7867;','&#7868;','&#7869;','&#7864;','&#7865;','&#202;','&#234;','&#7871;','&#7871;','&#7872;','&#7873;','&#7875;','&#7875;','&#7876;','&#7877;','&#7879;','&#7879;','F','f','G','g','H','h','I','i','&#237;','&#237;','&#236;','&#236;','&#7880;','&#7881;','&#297;','&#297;','&#7883;','&#7883;','J','j','K','k','L','l','M','m','N','n','O','o','&#211;','&#243;','&#210;','&#242;','&#7887;','&#7887;','&#245;','&#245;','&#7885;','&#7885;','&#212;','&#244;','&#7889;','&#7889;','&#7891;','&#7891;','&#7892;','&#7893;','&#7894;','&#7895;','&#7897;','&#7897;','&#416;','&#417;','&#7899;','&#7899;','&#7900;','&#7901;','&#7905;','&#7903;','&#7905;','&#7905;','&#7906;','&#7907;','P','p','Q','q','R','r','S','s','T','t','U','u','&#250;','&#250;','&#217;','&#249;','&#7910;','&#7911;','&#361;','&#361;','&#7909;','&#7909;','&#431;','&#432;','&#7912;','&#7913;','&#7914;','&#7915;','&#7917;','&#7917;','&#7918;','&#7919;','&#7920;','&#7921;','V','v','W','w','X','x','Y','y','&#253;','&#253;','&#7923;','&#7923;','&#7927;','&#7927;','&#7928;','&#7929;','&#7924;','&#7925;','Z','z','&#195;','&#272;','&#195;','0','1','2','3','4','5','6','7','8','9','_','*',']','@','}','-',';','-','~','[','$',' ','&gt;','&lt;','?','!','#','%','^','(',')','.','\'','"','=','+',':','`');
        $arrUNICODE_UCS2W = array('A','a','á','á','à','à','ả','ả','ã;','ã','.','ạ','ạ','Ă','ă','Ắ','ắ','Ằ','ằ','Ẳ','ẳ','Ẵ','ẵ','Ặ','ặ','Â','â','ấ','ấ','ầ','ầ','Ẩ','ẩ','Ẫ','ẫ','Ậ','ậ','B','b','C','c','D','d','Đ','đ','E','e','é','é','È','è','Ẻ','ẻ','Ẽ','ẽ','Ẹ','ẹ','Ê','ê','ế','ế','Ề','ề','ể','ể','Ễ','ễ','ệ','ệ','F','f','G','g','H','h','I','i','í','í','ì','ì','Ỉ','ỉ','ĩ','ĩ','ị','ị','J','j','K','k','L','l','M','m','N','n','O','o','Ó','ó','Ò','ò','ỏ','ỏ','õ','õ','ọ','ọ','Ô','ô','ố','ố','ồ','ồ','Ổ','ổ','Ỗ','ỗ','ộ','ộ','Ơ','ơ','ớ','ớ','Ờ','ờ','ỡ','ở','ỡ','ỡ','Ợ','ợ','P','p','Q','q','R','r','S','s','T','t','U','u','ú','ú','Ù','ù','Ủ','ủ','ũ','ũ','ụ','ụ','Ư','ư','Ứ','ứ','Ừ','ừ','ử','ử','Ữ','ữ','Ự','ự','V','v','W','w','X','x','Y','y','ý','ý','ỳ','ỳ','ỷ','ỷ','Ỹ','ỹ','Ỵ','ỵ','Z','z','Ã','Đ','Ã','0','1','2','3','4','5','6','7','8','9','_','*',']','@','}','-',';','-','~','[','$',' ','>','<','?','!','#','%','^','(',')','.','\'','"','=','+',':','`');

        for($i=0; $i<strlen($sString); $i++){			
            $cChar = substr($sString,$i,1);
            if(array_search($cChar, $arrVNTime) === false) {
                $sString = str_replace($cChar,' ',$sString);					
            }									
        }	

        $arrPosReplaced = array();
        $i=0;
        foreach ($arrVNTime as $cChar){
            $nPos = strpos($sString,$cChar);
            if($nPos>=0){	
                $sString = str_replace($cChar,$arrUNICODE_UCS2W[$i],$sString);
                $arrPosReplaced[] = $nPos;
            }
            $i++;			
        }
        return $sString;				
    }
    
    public function GetCacheCreateCase($account, $productId){
        $aData['serviceName'] = "SRV_GET_CACHE_RESULT_CREATECASE";
        $aData['body'] = array($account, $productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
    try{
        $client = new SoapClient($this->config->newcorechangeserver);
        $oResult = $client->__soapCall('RequestPortalService', array($aData));
        $arrResult = $oResult->RequestPortalServiceResult->string;
        //echo '<pre>';
                    //print_r($aData);
        //print_r($arrResult);die;
         if (is_array($arrResult) ) {
            return $arrResult;

        } else {
                return 'No_data';
         }

    }catch (Exception $e){
        //print_r($e);die;
        Core_SendMail::getInstance()->SendMailError('GetCache tao case',$e->getMessage());        
    }       
    }
    public function SetCache($key, $dateExpired) {
        try {
            //$account = 'copdichoithuyen';

            $functionNo = 'RequestFEService';
            $aData["serviceName"] = 'VIP_SET_CACHE';
            $aData["body"] = array($key, $dateExpired);
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

            $client = new SoapClient($this->config->api->FEService);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestFEServiceResult->string;
            if ($arrResult[0] == "1") {
                return $arrResult;
            } else if ($arrResult[0] == "0") {
                return 'No_Data';
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('GetPromotionDetail (chi tiet 1 uu dai)', $e->getMessage());
            return '';
        }
    }
    public function GetCache($key) {
        try {
            //$account = 'copdichoithuyen';

            $functionNo = 'RequestFEService';
            $aData["serviceName"] = 'VIP_GET_CACHE';
            $aData["body"] = array($key);
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

            $client = new SoapClient($this->config->api->FEService);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestFEServiceResult->string;
            if ($arrResult[0] == "1") {
                return $arrResult;
            } else if ($arrResult[0] == "0") {
                return 'No_Data';
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('GetPromotionDetail (chi tiet 1 uu dai)', $e->getMessage());
            return '';
        }
    }
    public function GetCacheCancelMoveServer($account, $productId){
        $aData['serviceName'] = "SRV_GET_CACHE_RESULT_DESTROYCASE";
        $aData['body'] = array($account, $productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try{
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            // echo '<pre>';
			// print_r($aData);
            // print_r($oResult);die;
             if (is_array($arrResult) ) {
                return $arrResult;
                
            } else {
                    return 'No_data';
             }
            
        }catch (Exception $e){
            //print_r($e);die;
            Core_SendMail::getInstance()->SendMailError('GetServerDest Lay danh sach Server Dich va Gia tien',$e->getMessage());        
        }       
    }
    public function checkaccountimport ($account, $productId){
        $aData['serviceName'] = "SRV_CHECK_ACCOUNT_IMPORT";
        $aData['body'] = array($account, $productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //echo '<pre>';
            //var_dump($arrResult);die;
            if (is_array($arrResult) && $arrResult[0] == 1) {
                return $arrResult;
                
                
            } else {
                    return 'No_data';
             }
            
        }  catch (Exception $e){
            Core_SendMail::getInstance()->SendMailError('Check tài khoản được Import',$e->getMessage());  
        }
    }
    public function listcurrentTaiPhu ($moveseverconfigid){
        $aData['serviceName'] = "SRV_GET_LIST_CURRENT_TAIPHU";
        $aData['body'] = array($moveseverconfigid);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == 1) {
               return json_decode($arrResult[1]);
                
            } else {
                    return 'No_data';
             }
            
        } catch (Exception $e){
            Core_SendMail::getInstance()->SendMailError('lấy danh sách server có thể chuyển tới',$e->getMessage());  
        }
    }
    
     public function checkaccountstatus ($account, $productcode){
        $aData['serviceName'] = "CHECK_STATUS_ACCOUNT";
        $aData['body'] = array($account, $productcode);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == 1) {
               return $arrResult[1];
                
            } else {
                    return 'No_data';
             }
            
        } catch (Exception $e){
            Core_SendMail::getInstance()->SendMailError('Kiem tra trang thai tai khoan',$e->getMessage());  
        }
        //[0]:            1: gọi API thành công, ngoài ra là exception 
        //[1]:            1: đang có trạng thái Khóa, 0: không khóa

     }
     public function checkcharacterJX2($account, $serverdestid, $rolenew, $productId){
        //$productcode = 150; //ProductID Vo Lam truyen Ky 2
        $aData['serviceName'] = "SRV_CHECK_CHARACTER";
        $aData['body'] = array($account, $serverdestid, $rolenew, $productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->newcorechangeserver);
            $oResult = $client->__soapCall('RequestPortalService', array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == 1 && $arrResult[1]!= '') {
               return $arrResult[1];
                
            } else {
                    return 'No_data';
             }
            
        } catch (Exception $e){
            Core_SendMail::getInstance()->SendMailError('Kiem tra tên nhân vật có tồn tại hay chưa.',$e->getMessage());  
        }
     }
     
     
    
    
}
?>
