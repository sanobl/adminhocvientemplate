<?php
class Core_InfoForm {

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

    /*
     * @Description: Lay danh sach form ghi nhan thong tin
     */

    public function getListInfoForm($productId = 0) {  
        $aData['serviceName'] = "GET_INFO_FORM";
        $aData['body'] = array($productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));
            if ($result_list->RequestPortalServiceResult->string[0] == 1) {
                return $result_list->RequestPortalServiceResult->string;
            }
            else{
                return 'No_data';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: getInfoAccountByAccount(Lay thong tin tai khoan gui y/c)', $e->getMessage());
            return '';
        }
    }
    /*
     * get list field of InfoForm 
     */
    public function GetListFieldInfoForm($formId) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTFIELD_INFOFORM_BY_FORMID';
            $aData["body"] = array($formId);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('GetListFieldInfoForm (Lấy danh sách field của infoform đã chọn )', $e->getMessage().'formid: '.$formId);
            return '';
        }
    }
}

?>