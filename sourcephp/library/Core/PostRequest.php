<?php

class Core_PostRequest {

    private $config;
    protected static $_instance = null;
    public $requestContent = '';

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->api;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    public function getInfoAccountByAccount($Account) {
        $aData['serviceName'] = "REQS_GETINFOR_ACCOUNT";
        $aData['body'] = array($Account, 1);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));
            if ($result_list->RequestPortalServiceResult->string[0] == 1) {
                return $result_list->RequestPortalServiceResult->string[1];
            } else {
                return 'No_data';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: getInfoAccountByAccount(Lay thong tin tai khoan gui y/c)', $e->getMessage());
            return '';
        }
    }

    public function GetListFieldIdByFormId($formId) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTFIELDID_BY_FORMID';
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
            Core_SendMail::getInstance()->SendMailError('GetListFieldIdByFormId (Lấy danh sách field thuoc for, )', $e->getMessage() . 'san pham: ' . $formId);
            return '';
        }
    }

    public function SaveDataRequest_NewBE($productId, $requestContentList, $requestContent, $requestContentFieldValue) {
        Core_Log::writeScribe($productId, 0, 0, 14, json_encode($requestContentList));
        $aData['serviceName'] = 'NEWBE_REQS_SAVE_REQUESTDATA';
        array_push($requestContentList, $requestContentList[1]);
        $aData['body'] = array(array($productId), $requestContentList, array($requestContent), $requestContentFieldValue);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('PostRequestPortalService', array($aData));
            //echo '<pre>';print_r($aData['body']);print_r($result_list->PostRequestPortalServiceResult);die;
            if ($result_list->PostRequestPortalServiceResult->string[0] == 1) {
                return $result_list->PostRequestPortalServiceResult->string;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: SaveDataRequest_NewBE', $e->getMessage());
            return 0;
        }
    }

    public function SaveDataRequestInGame_NewBE($productId, $requestContentList, $requestContent, $requestContentFieldValue, $accountconnect) {
        Core_Log::writeScribe($productId, 0, 0, 15, json_encode($requestContentList));
        $aData['serviceName'] = 'NEWBE_REQS_SAVE_REQUESTDATA';
        array_push($requestContentList, $accountconnect);
        $aData['body'] = array(array($productId), $requestContentList, array($requestContent), $requestContentFieldValue);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('PostRequestPortalService', array($aData));
            //echo '<pre>';print_r($aData['body']);die;
            if ($result_list->PostRequestPortalServiceResult->string[0] == 1) {
                return $result_list->PostRequestPortalServiceResult->string;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: SaveDataRequest_NewBE', json_encode($aData['body']).' '. $e->getMessage());
            return 0;
        }
    }

    public function updateAccountInfo($account, $name, $phone, $email, $timecontact, $acceptsms) {
        $aData['serviceName'] = 'REQS_UPDATEINFOR_ACCOUNT';
        $aData['body'] = array($account, $name, $email, $phone, $timecontact, $acceptsms);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));
            if ($result_list->RequestPortalServiceResult->string == 1) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: updateAccountInfo (Cap nhat thong tin tai khoan gui y/c)', $e->getMessage());
            return 0;
        }
    }

    public function GetListProductByRTypeIdAndFormId($requestTypeId, $formId, $platformCode = 'W') {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTPRODUCT_BY_RQTYPEID_FORMID';
            // $vngsupportprod = Core_Cookies::getCookie('vngsupportprod');
            // $platformCode = '';
            // if ($vngsupportprod == 'PC')
                // $platformCode = 'W';
            // else if ($vngsupportprod == 'MOBILE')
                // $platformCode = 'M';

            $aData["body"] = array($requestTypeId, $formId, APP_SITECONFIG, $platformCode);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;

            $aData['signal'] = md5(md5($signal));
            //var_dump($aData);die;
            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($arrResult);die;
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getListProduct(Lấy danh sách san phẩm)', $e->getMessage());
            return '';
        }
    }

    public function getEmailTemplate($emailTemplateFullPath) {
        $fh = fopen($emailTemplateFullPath, 'r');
        $sResult = fread($fh, filesize($emailTemplateFullPath));
        fclose($fh);
        return $sResult;
    }

    public function NewBE_REQS_Active_Request($requestId, $account, $requestTypeID = 0, $productId, $formId) {
        $functionNo = 'RequestPortalService';
        $aData["serviceName"] = 'NEWBE_REQS_ACTIVE_REQUEST';
        $aData["body"] = array($requestId, $account, $requestTypeID, $productId, $formId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
        $signal = $this->config->sig;

        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult;
            //echo '<pre>';print_r($aData["body"]) ;var_dump($arrResult);die;
            if (is_array($arrResult->string) && $arrResult->string[0] == 1) {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('active yêu cầu : NewBE_REQS_Active_Request ()', $e->getMessage());
            return '';
        }
    }

    public function GetServerByProductId($productId, $formId = 0) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTSERVER_BYPRODUCTID';
            $aData["body"] = array($productId, $formId);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //var_dump($arrResult);die;
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getServerByProductId (Lấy danh sách server )', $e->getMessage() . 'san pham: ' . $productId);
            return '';
        }
    }

    public function GetServer($productCode) {
        try {
            $functionNo = 'RequestFEService';
            //$aData["serviceName"] = 'VIP_LIST_SERVER_AMN';
            $aData["serviceName"] = 'VIP_LIST_SERVER';
            $aData["body"] = array($productCode);
            $aData['userIP'] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;

            $aData['signal'] = md5(md5($signal));
            $client = new SoapClient($this->config->VIPService);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestFEServiceResult->string;
            //echo '<pre>';
            //var_dump($arrResult);die;
            if ($arrResult[0] == "1") {
                return json_decode($arrResult[1]);
            } else if ($arrResult[0] == "0") {
                return 'No_Data';
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('GetServer (lay server real để khoa game ngoa long/ ai my nhan)', $e->getMessage());
            return '';
        }
    }

    public function CheckUnBanCodeStatus($account, $unBanCode) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'CHECK_UNBANCODE_STATUS';
            $aData["body"] = array($account, $unBanCode);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == "1") {
                return $arrResult[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('CheckUnBanCodeStatus (Kiem tra ma code )', $e->getMessage() . 'tai khoan: ' . $account . 'ma xac nhan: ' . $unBanCode);
            return '';
        }
    }

    public function SaveDataRequestMKH_NewBE($productId, $requestContentList, $requestContent, $requestContentFieldValue) {
        $aData['serviceName'] = 'NEWBE_REQS_SAVE_REQUESTDATA_MKH';
        array_push($requestContentList, $requestContentList[1]);
        $aData['body'] = array(array($productId), $requestContentList, array($requestContent), $requestContentFieldValue);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('PostRequestPortalService', array($aData));
//            echo '<pre>';
//            print_r($result_list);die;
            if ($result_list->PostRequestPortalServiceResult->string[0] == 1) {
                return $result_list->PostRequestPortalServiceResult->string;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: SaveDataRequestMKH_NewBE', $e->getMessage());
            return 0;
        }
    }

    public function SaveDataRequestKH_NewBE($productId, $requestContentList, $requestContent, $requestContentFieldValue) {
        $aData['serviceName'] = 'NEWBE_REQS_SAVE_REQUESTDATA_KH';
        //$accountConnect = Core_Cookies::getCookie('accounctconnect');
        // if($accountConnect == '')
        //    $accountConnect = Core_Cookies::getCookie('acn');
        array_push($requestContentList, $requestContentList[1]);
        $aData['body'] = array(array($productId), $requestContentList, array($requestContent), $requestContentFieldValue);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            //echo '<pre>';
            //print_r($requestContentFieldValue);
            $client = new SoapClient($this->config->support);
            $result_list = $client->__soapCall('PostRequestPortalService', array($aData));
            //print_r($result_list);die;
            if ($result_list->PostRequestPortalServiceResult->string[0] == 1) {
                return $result_list->PostRequestPortalServiceResult->string;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: SaveDataRequestKH_NewBE', $e->getMessage());
            return 0;
        }
    }

    public function CheckAccountStatus($account) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'CHECK_ACCOUNT_STATUS';
            $aData["body"] = array($account);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == "1") {
                return $arrResult[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('CheckAccountStatus (kiem tra trang thai tai khoan )', $e->getMessage() . 'tai khoan: ' . $account);
            return '';
        }
    }

    public function getServerJX($productId) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = '';
            if ($productId == Core_Global::getApplicationIni()->app->static->ProductIdJXF)
                $aData["serviceName"] = 'GET_LISTSERVERJXF';
            else if ($productId == Core_Global::getApplicationIni()->app->static->ProductIdJX1)
                $aData["serviceName"] = 'GET_LISTSERVERJX1';
            else if ($productId == Core_Global::getApplicationIni()->app->static->ProductIdJX2)
                $aData["serviceName"] = 'GET_LISTSERVERJX2';
            else if ($productId == Core_Global::getApplicationIni()->app->static->ProductIdWJX)
                $aData["serviceName"] = "GET_LISTSERVERWJX";
            $aData["body"] = array();
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
//            var_dump($arrResult);die;
            if ($arrResult[0] == "1") {
                $data = $arrResult[1];
                $data = json_decode($data);
                return $data;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getServerJX (Lấy danh sách server JX)', $e->getMessage() . 'san pham: ' . $productId);
            return '';
        }
    }

    public function getLogDetail($account, $requestCode, $productID, $typeTransaction, $serverGunny = '') {
        $functionNo = 'RequestPortalService';
        $aData["serviceName"] = 'TRANS_GETLOGDETAIL';
        $aData["body"] = array($account, $requestCode, $productID, $typeTransaction, $serverGunny);
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
        try {
            //$client = new SoapClient($this->config->api->support);
            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult;
            $arrResult = $arrResult->string;

            if ($arrResult[0] == "1") {
                $data = $arrResult;
                return $data;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xem chi tiết Log giao dich: getLogDetail (chi tiết Log giao dich)', $e->getMessage());
            return '';
        }
    }

    public function HiddenAccountInfo($requestContent) {
        $this->requestContent = '';
        $tmprq = $requestContent;
        $pos = $this->Hidden($requestContent, "Tên Email ", 1);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Tên Email ", 1);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Email đăng ký tài khoản: ", 1);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Email đăng ký tài khoản: ", 1);
        }

        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Số điện thoại bảo vệ tài khoản: ", 2);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Số điện thoại bảo vệ tài khoản: ", 2);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Số giấy tờ đăng ký: ", 3);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Số giấy tờ đăng ký: ", 3);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Số giấy tờ đăng ký trong tài khoản ", 3);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Số giấy tờ đăng ký trong tài khoản ", 3);
        }
        //Đổi
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi ngày sinh: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi ngày sinh: ", 4);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi số điện thoại bảo vệ: ", 6);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi số điện thoại bảo vệ: ", 6);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi địa chỉ: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi địa chỉ: ", 4);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi tỉnh/ thành phố: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi tỉnh/ thành phố: ", 4);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi email đăng ký: ", 5);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi email đăng ký: ", 5);
        }
        //Đổi Email đăng ký
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi Email đăng ký: ", 5);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi Email đăng ký: ", 5);
        }

        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi CMND: ", 7);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi CMND: ", 7);
        }
        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi ngày cấp CMND: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi ngày cấp CMND: ", 4);
        }

        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi ngày cấp: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi ngày cấp: ", 4);
        }

        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi nơi cấp CMND: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi nơi cấp CMND: ", 4);
        }

        $tmprq = $this->requestContent;
        $this->requestContent = '';
        $pos = $this->Hidden($tmprq, "Đổi nơi cấp: ", 4);
        while ($pos != -1) {
            $tmprq = substr($tmprq, $pos, strlen($tmprq));
            $pos = $this->Hidden($tmprq, "Đổi nơi cấp: ", 4);
        }
    }

    private function Hidden($requestContent, $find, $mode) {
        if ($mode == 1) { //email
            //Email đăng ký tài khoản:
            //Tên Email
            //Đổi email đăng ký: " + model.Email + " -> " + info.Email;
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $email = $this->HiddenEmail(substr($bottom, 0, $posEmail));
                    $this->requestContent .= $email;
                    return $pos + $posEmail;
                } else {
                    $email = $this->HiddenEmail($bottom);
                    $this->requestContent .= $email;
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else if ($mode == 2) {//phone
            //Số điện thoại bảo vệ tài khoản: 
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $phone = substr(substr($bottom, 0, $posEmail), 0, 3) . '*******';
                    $this->requestContent .= $phone;
                    return $pos + $posEmail;
                } else {
                    $phone = substr(substr($bottom, 0, $posEmail), 0, 3) . '*******';
                    $this->requestContent .= $phone;
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else if ($mode == 3) {//cid
            //Số giấy tờ đăng ký: 
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $cid = substr($bottom, 0, $posEmail);
                    $this->requestContent .= substr($cid, 0, 1);
                    for ($l = 0; $l < strlen($cid) - 3; $l++)
                        $this->requestContent .= '*';
                    $this->requestContent .= substr($cid, strlen($cid) - 2, 1);
                    return $pos + $posEmail;
                } else {
                    $this->requestContent .= substr($bottom, 0, 1);
                    for ($l = 0; $l < strlen($bottom) - 3; $l++)
                        $this->requestContent .= '*';
                    $this->requestContent .= substr($bottom, strlen($bottom) - 2, 1);
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else if ($mode == 4) {
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $cid = '********** -> **********';
                    $this->requestContent .= $cid;
                    return $pos + $posEmail;
                } else {
                    $cid = '********** -> **********';
                    ;
                    $this->requestContent .= $cid;
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else if ($mode == 5) { //doi email dang ky
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $tmpemail = substr($bottom, 0, $posEmail);
                    $email1 = $this->HiddenEmail(trim(substr($tmpemail, 0, strpos($tmpemail, "->"))));
                    $email2 = $this->HiddenEmail(trim(substr($tmpemail, strpos($tmpemail, "->") + 2)));

                    $this->requestContent .= $email1 . ' -> ' . $email2;
                    return $pos + $posEmail;
                } else {
                    $email1 = $this->HiddenEmail(trim(substr($bottom, 0, strpos($bottom, "->"))));
                    $email2 = $this->HiddenEmail(trim(substr($bottom, strpos($bottom, "->") + 2)));
                    $this->requestContent .= $email1 . ' -> ' . $email2;
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else if ($mode == 6) { //doi phone bao ve
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $tmpphone = substr($bottom, 0, $posEmail);
                    $phone1 = substr(trim(substr($tmpphone, 0, strpos($tmpphone, "->"))), 0, 3) . '*******';
                    $phone2 = substr(trim(substr($tmpphone, strpos($tmpphone, "->") + 2)), 0, 3) . '*******';
                    $this->requestContent .= $phone1 . ' -> ' . $phone2;
                    return $pos + $posEmail;
                } else {
                    $phone1 = substr(trim(substr($bottom, 0, strpos($bottom, "->"))), 0, 3) . '*******';
                    $phone2 = substr(trim(substr($bottom, strpos($bottom, "->") + 2)), 0, 3) . '*******';

                    $this->requestContent .= $phone1 . ' -> ' . $phone2;
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else if ($mode == 7) { //doi cid bao ve
            $pos = strpos($requestContent, $find);
            if ($pos !== false) {
                $pos += strlen($find);
                $top = substr($requestContent, 0, $pos);
                $this->requestContent .= $top;
                $bottom = substr($requestContent, $pos);
                $posEmail = strpos($bottom, "<br");
                if ($posEmail !== false) {
                    $tmpcid = substr($bottom, 0, $posEmail);
                    $tmpcid1 = trim(substr($tmpcid, 0, strpos($tmpcid, "->")));
                    $cid1 = substr($tmpcid1, 0, 1);
                    for ($i = 0; $i < strlen($tmpcid1) - 2; $i++)
                        $cid1 .= '*';
                    $cid1 .= substr($tmpcid1, strlen($tmpcid1) - 1, 1);

                    $tmpcid2 = trim(substr($tmpcid, strpos($tmpcid, "->") + 2));
                    $cid2 = substr($tmpcid2, 0, 1);
                    for ($i = 0; $i < strlen($tmpcid2) - 2; $i++)
                        $cid2 .= '*';
                    $cid2 .= substr($tmpcid2, strlen($tmpcid2) - 1, 1);
                    $this->requestContent .= $cid1 . ' -> ' . $cid2;
                    return $pos + $posEmail;
                } else {
                    $tmpcid1 = trim(substr($bottom, 0, strpos($bottom, "->")));
                    $cid1 = substr($tmpcid1, 0, 1);
                    for ($i = 0; $i < strlen($tmpcid1) - 2; $i++)
                        $cid1 .= '*';
                    $cid1 .= substr($tmpcid1, strlen($tmpcid1) - 1, 1);

                    $tmpcid2 = trim(substr($bottom, strpos($bottom, "->") + 2));
                    $cid2 = substr($tmpcid2, 0, 1);
                    for ($i = 0; $i < strlen($tmpcid2) - 2; $i++)
                        $cid2 .= '*';
                    $cid2 .= substr($tmpcid2, strlen($tmpcid2) - 1, 1);
                    $this->requestContent .= $cid1 . ' -> ' . $cid2;
                    return $pos + strlen($bottom);
                }
            } else {
                //The string was not found in the string 
                $this->requestContent .= $requestContent;
                return -1;
            }
        } else {
            return -1;
        }
    }

    public function HiddenEmail($email) {
        $email = trim($email);
        $topemail = substr($email, 0, 1);
        $newEmail = $topemail;
        $find = '@';
        $pos = strpos($email, $find);
        $oldpos = 1;
        while ($pos !== false) {
            $top = substr($email, $pos + 1, 1);
            for ($i = 0; $i < $pos - $oldpos; $i++)
                $newEmail .= '*';
            $oldpos = $pos + 2;
            $newEmail .= $find . $top;
            $find = '.';
            $pos = strpos($email, $find, $pos + 1);
        }
        for ($i = 0; $i < strlen($email) - $oldpos; $i++)
            $newEmail .= '*';
//        if($newEmail == '')
//            $newEmail = '*****@*******';
        return $newEmail;
    }

    public function getInfoRegisterByAccount($account) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_GET_INFO_REGISTER';
            $aData["body"] = array($account);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == "1") {
                $data = $arrResult[1];
                $data = json_decode($data);
                return $data;
            } else {
                return '';
            }
        } catch (Exception $e) {
            return '';
        }
    }

    public function getListProduct($account) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_GET_ALL_PRODUCT';
            $aData["body"] = array(APP_SITECONFIG, $account);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($arrResult);die;
            if ($arrResult[0] == "1") {
                $data = $arrResult[1];
                $data = json_decode($data);
                return $data;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getListProduct(Lấy danh sách san phẩm)', $e->getMessage());
            return '';
        }
    }

    public function getListServerByProductID($productID) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_GET_LIST_SERVER_NAME_BY_PRODUCT';
            $aData["body"] = array($productID);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == "1") {
                $data = $arrResult[1];
                $data = json_decode($data);
                return $data;
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('getListServerByProductID (Lấy danh sách server)', $e->getMessage());
            return '';
        }
    }

    public function createRegisterSMSV2($account, $phoneNumber, $listDetail, $isUpdate, $registerID) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_CREATE_REGISTERV2';
            $aData["body"] = array($phoneNumber, $account, $listDetail, $isUpdate, $registerID);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;

            return $arrResult[0] . '<TT>' . $arrResult[1];
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('createRegister: createRegister', $e->getMessage());
            return '';
        }
    }

    public function deleteRegisterSMSDetailV2($account, $registerDetail) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_DELETE_REGISTERDETAIL';
            $aData["body"] = array($account, $registerDetail);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($aData["body"]);die;
            return $arrResult[0];
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('deleteRegisterSMSDetail: deleteRegisterSMSDetail', $e->getMessage());
            return '';
        }
    }

    public function updateRegisterSMSDetailV2($registerDetailID, $registerID, $productID, $fieldID, $serverID, $serverName, $gameName) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_UPDATE_REGISTER_DETAIL';
            $aData["body"] = array($registerDetailID, $registerID, $productID, $fieldID, $serverID, $serverName, $gameName);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            return $arrResult[0];
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('updateRegisterSMS: updateRegisterSMS', $e->getMessage());
            return '';
        }
    }

    public function deleteRegisterSMSV2($registerID) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'SMS_DELETE_REGISTER';
            $aData["body"] = array($registerID);
            $aData["userIP"] = Core_Map::getIp();
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

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            //print_r($arrResult);die;
            return $arrResult[0];
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Xóa đăng ký SMS: deleteRegisterSMSV2', $e->getMessage());
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
            if (is_array($arrResult->RequestPortalServiceResult->string) && $arrResult->RequestPortalServiceResult->string[0] == 1 && $arrResult->RequestPortalServiceResult->string[1] != "No_data" && $arrResult->RequestPortalServiceResult->string[1] != "0") {
                return $arrResult->RequestPortalServiceResult->string[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('Check HaveLinksurvey: HaveLinksurvey(API lay link Survey)', $e->getMessage());
            return '';
        }
    }

}
