<?php

class Core_SendMail {

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

    public function SendMailError($subject, $body) {
        $arrParams = array();
        $arrParams["wsAccount"] = $this->config->wsAccount;
        $arrParams["wsPassword"] = $this->config->wsPassword;
        $arrParams["sFromAddress"] = $this->config->sFromAddress;
        $arrParams["sFromName"] = $this->config->sFromName;
        $arrParams["bIsHTML"] = $this->config->bIsHTML;
        $arrParams["sCharSet"] = $this->config->sCharSet;
        $arrParams["sToAddress"] = $this->config->listemail;
        $arrParams["sSubject"] = $subject;
//        $body = str_replace("@img_url@", Vportal_Config::get('site', 'emailImagePath'), $body);
//        $body = str_replace("@Sender@", Vportal_Config::get('site', 'sSenderName'), $body);
        $arrParams["sBody"] = $body;
        try {
            //$client = new SoapClient($this->config->cs->url);								
            $client = new SoapClient($this->config->mailpassport);
            $oResult = $client->SendEMail($arrParams);
            $iResult = $oResult->SendEMailResult; 
            return $iResult;
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendEmail($to, $subject, $body) {
        $iResult = 0;
        $arrParams = array();
        $arrParams["wsAccount"] = $this->config->wsAccountMain;
        $arrParams["wsPassword"] = $this->config->wsPasswordMain;
        $arrParams["sFromAddress"] = $this->config->sFromAddress;
        $arrParams["sFromName"] = $this->config->sFromName;
        $arrParams["bIsHTML"] = $this->config->bIsHTML;
        $arrParams["sCharSet"] = $this->config->sCharSet;
        $arrParams["sToAddress"] = $to;
        //$arrParams["sToAddress"] = $to;
        $arrParams["sSubject"] = $subject;
        $body = str_replace("@img_url@", $this->config->emailImagePath, $body);
        $body = str_replace("@Sender@", $this->config->sSenderName, $body);
        $arrParams["sBody"] = $body;
        try {
            $oPassportService = new SoapClient($this->config->mailMain);
            $oResult = $oPassportService->SendEMail($arrParams);
            $iResult = $oResult->SendEMailResult;
        } catch (Exception $e) {
            $iResult = 0;
            //Mapper::writeLog('sendEmail', 'Call service send email fail: to: '.$to.'- subject: '.$subject.'-body: '.$body);
        }
        return $iResult;
    }

    public function SendMailPassport($to, $subject, $body) {
        $arrParams = array();
        $arrParams["wsAccount"] = $this->config->wsAccount;
        $arrParams["wsPassword"] = $this->config->wsPassword;
        $arrParams["sFromAddress"] = $this->config->sFromAddress;
        $arrParams["sFromName"] = $this->config->sFromName;
        $arrParams["bIsHTML"] = $this->config->bIsHTML;
        $arrParams["sCharSet"] = $this->config->sCharSet;
        $arrParams["sToAddress"] = $to;
        $arrParams["sSubject"] = $subject;
        $body = str_replace("@img_url@", $this->config->emailImagePath, $body);
        $body = str_replace("@Sender@", $this->config->sSenderName, $body);
        $arrParams["sBody"] = $body;     
        try {
            $client = new SoapClient($this->config->mailpassport);
            $oResult = $client->SendEMail($arrParams);          
            $iResult = $oResult->SendEMailResult;
            return $iResult;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>