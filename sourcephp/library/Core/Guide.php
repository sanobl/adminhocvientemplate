<?php

class Core_Guide {

    private $config;
    //private $productIdSelect = 0;
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

    public function getGuideDetail($guideId, $productId = 0) {
        //result[0] = 0; khong co hinh dai dien
        //          = 1; video dai dien
        //          = 2; hinh anh
        //return array(1, '//www.youtube.com/embed/tTWh0CGU4oQ');
        return array(0, '');
//        $functionNo = 'RequestListPortalService';
//        $aData["serviceName"] = 'GENRAL_GETSUBMENU_LEFTMENU';
//        $aData["body"] = array(intval($siteConfigId), intval($typeFolder), intval($productId));
//        $aData['userIP'] = Core_Map::getIp();
//        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
//        $signal = $this->config->sig;
//        if (!is_array($aData["body"])) {
//            $signal.= $aData['serviceName'];
//        } else {
//            $temp = "";
//            for ($i = 0; $i < count($aData["body"]); $i++) {
//                $temp .= $aData["body"][$i];
//            }
//            $signal .= $aData["serviceName"] . $temp;
//        }
//        $aData['signal'] = md5(md5($signal));
//        try {
//            $client = new SoapClient($this->config->api->support);
//            $oResult = $client->__soapCall($functionNo, array($aData));
//            $arrResult = $oResult->RequestListPortalServiceResult->ArrayOfstring;
//            //var_dump($arrResult);die;
//            if ($arrResult[0]->string[0] == 1)
//                return $arrResult;
//            else {
//                return '';
//            }
//        } catch (Exception $e) {
//            Core_SendMail::getInstance()->SendMailError('getleftmenu_nomarlpage (danh sách cac thu muc con cua tai khoan)', $e->getMessage());
//            return '';
//        }
    }
}

?>
