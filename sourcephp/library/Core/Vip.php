<?php

class Core_Vip {

    private $config;
    protected static $_instance = null;

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function CheckVip($account) {
        try {
            $functionNo = 'RequestService';
            $aData["serviceName"] = 'VIP_GETDETAIL_VIPINFOR_BYACC';
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
            $client = new SoapClient($this->config->api->VIPService);
            $oResult = $client->__soapCall($functionNo, array($aData));            
            $arrResult = $oResult->RequestServiceResult->ArrayOfstring;
           
            if (is_array($arrResult) && $arrResult[0]->string[0] >= 1) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('CheckVIP (Chức năng kiểm tra account có phải VIP hay không)', $e->getMessage());
            return '';
        }
    }

}
