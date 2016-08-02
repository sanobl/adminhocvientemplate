<?php

set_include_path(dirname(__FILE__) . '/PEAR' . PATH_SEPARATOR . get_include_path());
require_once 'HTTP/Request2.php';

class Core_LinkedVipService {

    protected static $_instance = null;
    private $auth;
    private $params;
    private $linkedvipConfig;
    private $prePath;
    private $appidParam = '';
    private $account_status = '';

    const CONTENT_TYPE = "application/json; charset=utf-8";
    // Define values to validate
    const MOBILE = 'mobile';
    const PC = 'pc';
    const SOURCE = 'plus';
    const SOURCE_CSTD = 'cstd';
    // Define error codes of error page
    const UNKNOW_ERROR = -1;
    const WRONG_PARAM_ERROR = 0;
    const TIMEOUT_ERROR = 1;
    const PERMISSION_DENY_ERROR = 2;
    const UNAUTHORIZED_ERROR = 3;
    const HAVE_NOT_PAYMENT_ERROR = 4;
    const INTERNAL_SERVER_ERROR = 5;
    const ERROR_BY_DEVELOPER = 6;
    const JOIN_VIP_FAILED = 7;
    const DOES_NOT_SUPPORT_APP = 8;
    const WRONG_USERNAME = 9;
    // Define status codes of API server
    const INTERNAL_API = -1;
    const INVALID_PARAMS_API = -2;
    const STATUS_NEW_API = 0;
    const STATUS_NOT_JOIN_API = 1;
    const STATUS_WAITING_API = 2;
    const OTP_EXPIRED_API = 3;
    const VERYFY_OTP_FAILED_API = 4;
    const ACCOUNT_HAVE_LINKED_API = 9;
    const NO_DATA_POINT_API = 10;
    const SUCCESS_POINT_API = 11;
    const NO_DATA_CALLING_CODE_API = 20;
    const SUCCESS_CALLING_CODE_API = 21;
    const JOIN_VIP_FAILED_API = 30;
    const JOIN_VIP_SUCCESS_API = 31;
    const REGISTER_VIP_SUCCESS_API = 41;
    const DOES_NOT_SUPPORT_API = 40;
    const UNAUTHORIZED_ERROR_API = 401;
    const BAD_REQUEST_API = 400;
    const UNJOINVIP_WAITING_OTP = 51;
    const DONOT_JOIN = 111;
    const UNJOINVIP_SUCCESS = 52;

    public function __construct($params) {
        // Get config of linked VIP
        $this->linkedvipConfig = Core_Global::getApplicationIni()->app->static->linkedvip;
        $this->auth = $this->linkedvipConfig->preAuth . ' ' . base64_encode($this->linkedvipConfig->username . ':' . $this->linkedvipConfig->password);

        // Set params
        $this->params = $params;

        // Set pre path
        $this->prePath = ($this->params['type'] == self::PC) ? $this->linkedvipConfig->zingpc : $this->linkedvipConfig->mobile;

        // If accesss by mobile
        if ($this->params['type'] == self::MOBILE) {
            $this->appidParam = '&appid=' . $this->params['productid'];
        }
    }

    public static function getInstance($params) {
        if (null === self::$_instance) {
            self::$_instance = new self($params);
        }
        return self::$_instance; //singleton
    }

    /**
     * commonValidation check params, timespan, signal and login
     * @return Number error code or null
     */
    public function commonValidation() {
        $checkinfopp = '';
        // Check params
        if (($this->params['type'] != self::PC && $this->params['type'] != self::MOBILE) 
                || !$this->params['accountname'] 
                || !$this->params['sig'] 
                || (!is_numeric($this->params['productid']) && $this->params['type'] == self::MOBILE) 
                || ($this->params['source'] != self::SOURCE && $this->params['source'] != self::SOURCE_CSTD) 
                || !is_numeric($this->params['time'])) {
            return self::WRONG_PARAM_ERROR;
        }
        // Check timespan
        if (time() - $this->params['time'] > $this->linkedvipConfig->timeDelay) {
            return self::TIMEOUT_ERROR;
        }
        // // Check signal
        $md5 = md5($this->linkedvipConfig->key . $this->params['type'] . $this->params['accountname'] . $this->params['source'] . $this->params['time']);
        //$message = $this->linkedvipConfig->key.'- type:' . $this->params['type'].'- accountname:' . $this->params['accountname'].'-source: ' . $this->params['source'].'- time:' . $this->params['time'].'- sig:'.$this->params['sig'];
        //Core_Log::sendLog('test');
//        echo '<pre>thuat-';
//        echo $md5 .'thuat<br>';
//        echo $this->params['sig'] .'thuat<br>';
//        var_dump($this->params);
        if ($md5 !== $this->params['sig']) {
            return self::PERMISSION_DENY_ERROR;
        }
        //echo 'thucnv';die;
        // Check login, have not API which check login for mobile
        if ($this->params['source'] != self::SOURCE_CSTD) {
            if ($this->params['type'] == self::PC) {
                $userInfo = Core_User::getInstance()->checkLoginStatus();
                if (!$userInfo) {
                    return self::UNAUTHORIZED_ERROR;
                }

                if ($this->params['accountname'] != $userInfo['acn']) {
                    return self::WRONG_USERNAME;
                }

                $this->params['accountname'] = $userInfo['acn'];
                $checkinfopp = Core_User::getInstance()->checkAccountFromPassport($userInfo['acn']);
                //self::ACCOUNT_STATUS = $checkinfopp->string[2];
                $this->account_status = $checkinfopp->string[2];
                
            }
        }


        return null;
    }

    /**
     * havePayment check the account have payment or not
     * @return sdtClass
     */
    public function havePayment() {
        $url = $this->linkedvipConfig->host . $this->prePath . $this->linkedvipConfig->getPoints;
        $url .= '&acc=' . $this->params['accountname'] . $this->appidParam;

        // Write log when start request
        $message = '[LINKED VIP][GET - Have Payment] - URL: ' . $url;
        Core_Log::sendLog($message);

        return $this->get($url);
    }

    /**
     * getPhoneList get code of countries
     * @return sdtClass
     */
    public function getPhoneList() {
        $url = $this->linkedvipConfig->host . $this->linkedvipConfig->mobile . $this->linkedvipConfig->phoneList;
        // Write log when start request
        $message = '[LINKED VIP][GET - Get Phone List] - URL: ' . $url;
        Core_Log::sendLog($message);

        return $this->get($url);
    }

    /**
     * hasLinkedVip check status of account: linked, not link, waiting confirm OTP, waiting join VIP
     * @return sdtClass
     */
    public function hasLinkedVip() {
        $url = $this->linkedvipConfig->host . $this->prePath . $this->linkedvipConfig->checkStatus;
        $url .= '&acc=' . $this->params['accountname'] . $this->appidParam;

        // Write log when start request
        $message = '[LINKED VIP][GET - Have Linked VIP] - URL: ' . $url;
        Core_Log::sendLog($message);

        return $this->get($url);
    }

    /**
     * registerVip
     * @param  Number   $countryCode
     * @param  String   $phone
     * @return sdtClass
     */
    public function registerVip($countryCode, $phone) {
        $url = $this->linkedvipConfig->host . $this->prePath . $this->linkedvipConfig->register;
        $data = array(
            'account' => $this->params['accountname'],
            'country_code' => $countryCode,
            'phone' => $phone
        );

        // Write log when start request
        $message = '[LINKED VIP][POST - Register VIP] - URL: ' . $url . ' DATA: ' . json_encode($data);
        Core_Log::sendLog($message);

        return $this->post($url, $data);
    }

    /**
     * confirmVip verify OTP
     * @param  Number   $countryCode
     * @param  String   $phone
     * @param  String   $OTP
     * @return sdtClass
     */
    public function confirmVip($countryCode, $phone, $OTP) {
        $url = $this->linkedvipConfig->host . $this->prePath . $this->linkedvipConfig->confirm;
        $data = array(
            'account' => $this->params['accountname'],
            'country_code' => $countryCode,
            'phone' => $phone,
            'confirm_code' => $OTP
        );

        // Write log when start request
        $message = '[LINKED VIP][POST - Confirm VIP] - URL: ' . $url . ' DATA: ' . json_encode($data);
        Core_Log::sendLog($message);

        return $this->post($url, $data);
    }

    /**
     * joinVip accept link VIP
     * @return sdtClass
     */
    public function joinVip() {
        $url = $this->linkedvipConfig->host . $this->prePath . $this->linkedvipConfig->joinvip;
        $data = array(
            'account' => $this->params['accountname']
        );

        // Write log when start request
        $message = '[LINKED VIP][POST - Join VIP] - URL: ' . $url . ' DATA: ' . json_encode($data);
        Core_Log::sendLog($message);

        return $this->post($url, $data);
    }

    /**
     * getParams these params is passed by URL
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * getPhoneNumber get phone number of account
     * @param  String $accountname
     * @return String return phone number or null if not exist
     */
    public function getPhoneNumber() {
        // Write log when start request
        $message = '[LINKED VIP][GET - Get Phone Number] {accountname: ' . $this->params['accountname'] . '}';
        Core_Log::sendLog($message);

        $Core_User = Core_User::getInstance();
        $data = $Core_User->checkAccountFromPassportNew($this->params['accountname']);

        if (isset($data) && isset($data->Telephone)) {
            $message = '[LINKED VIP][RESPONE SUCCESFULLY] - DATA: ' . $data->Telephone . "\n";
            Core_Log::sendLog($message);
            return $data->Telephone;
        }

        $message = '[LINKED VIP][RESPONE SUCCESFULLY]' . "\n";
        Core_Log::sendLog($message);
        return null;
    }

    public function isLoginZalo($phone) {
        $url = $this->linkedvipConfig->isSignUpZalo . $phone;

        // Write log when start request
        $message = '[LINKED VIP][GET - Check is sign up Zalo] URL - ' . $url;
        Core_Log::sendLog($message);

        return $this->get($url);
    }

    public function unjoinvip() {
        //$this->prePath = ($this->params['type'] == self::PC) ? $this->linkedvipConfig->zingpc : $this->linkedvipConfig->mobile;        
        $url = $this->linkedvipConfig->host . $this->linkedvipConfig->mobile . $this->linkedvipConfig->unjoinvip;
        $data = array(
            'account' => $this->params['accountname'],
        );
        if ($this->params['type'] == self::MOBILE) {
            $data['appid'] = $this->params['productid'];
        } else {
            $data['appid'] = 999999;
        }

        $message = '[LINKED VIP][POST - UnJoin VIP] - URL: ' . $url . ' DATA: ' . json_encode($data);
        Core_Log::sendLog($message);
        return $this->post($url, $data);
    }

    public function confirmunjoinvip($OTP = '') {
        //$this->prePath = ($this->params['type'] == self::PC) ? $this->linkedvipConfig->zingpc : $this->linkedvipConfig->mobile;        
        $url = $this->linkedvipConfig->host . $this->linkedvipConfig->mobile . $this->linkedvipConfig->confirmunjoinvip;
        $data = array(
            'account' => $this->params['accountname'],
            'confirm_code' => $OTP
        );
        if ($this->params['type'] == self::MOBILE) {
            $data['appid'] = $this->params['productid'];
        } else {
            $data['appid'] = 999999;
        }
        $message = '[LINKED VIP][POST - confirm UnJoin VIP] - URL: ' . $url . ' DATA: ' . json_encode($data);
        Core_Log::sendLog($message);
        return $this->post($url, $data);
    }
    
    public function isactiveaccount(){
        // check phone is active;
        $rs = str_split(strrev(decbin($this->account_status)));
        $message = '[LINKED VIP][POST - is_active_account] ACCOUNT '.$this->params['accountname'].'- DATA: ' . json_encode($rs);        
        Core_Log::sendLog($message);
        if (isset($rs[23])){
                if($rs[23] == 0)
                    return false;
        }else 
            return false;
        
        return true;
    }

    /**
     * get this function is used to call API by get method
     * @param  String   $url
     * @return sdtClass
     */
    public function get($url) {
        try {
            $request = new HTTP_Request2($url, HTTP_Request2::METHOD_GET);
            $request->setHeader(array(
                'Content-Type' => self::CONTENT_TYPE,
                'Authorization' => $this->auth
            ));

            $response = $request->send();
            $result = $response->getBody();

            $dataresult = json_decode($result);

            // Write log when request send successfully
            if (isset($dataresult->status) && $dataresult->status == self::SUCCESS_CALLING_CODE_API) {
                // Dose not write log for phone list
                $message = "[LINKED VIP][RESPONE SUCCESFULLY]\n";
            } else {
                $message = '[LINKED VIP][RESPONE SUCCESFULLY] - DATA: ' . $result . "\n";
            }
            Core_Log::sendLog($message);

            return $dataresult;
        } catch (Exception $exception) {
            return $this->exceptionHanlder($exception);
        }
    }

    /**
     * post this function is used to call API by post method
     * @param  String   $url
     * @param  array    $data
     * @return sdtClass
     */
    public function post($url, $data) {
        try {
            $request = new HTTP_Request2($url, HTTP_Request2::METHOD_POST);
            $request->setHeader(array(
                'Content-Type' => self::CONTENT_TYPE,
                'Authorization' => $this->auth
            ));

            // Every request of Mobile need to send appid
            if ($this->params['type'] == self::MOBILE) {
                $data['appid'] = $this->params['productid'];
            }
            $data = json_encode($data);
            $request->setBody($data);
            $response = $request->send();
            $result = $response->getBody();

            // Write log when request send successfully
            $message = '[LINKED VIP][RESPONE SUCCESFULLY] - DATA: ' . $result . "\n";
            Core_Log::sendLog($message);

            $dataresult = json_decode($result);
            return $dataresult;
        } catch (Exception $exception) {
            return $this->exceptionHanlder($exception);
        }
    }

    /**
     * exceptionHanlder
     * @param  Exception $exception
     */
    private function exceptionHanlder($exception) {
        // Write log when request get error
        $message = '[LINKED VIP][ERROR] - ' . $exception->getMessage() . "\n";
        Core_Log::sendLog($message);
        $error = new stdClass;
        $error->status = self::INTERNAL_API;
        //echo '<pre>';
        //var_dump($exception->getMessage());
        //die;
        return $error;
    }

}

?>