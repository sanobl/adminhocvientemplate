<?php
set_include_path(dirname(__FILE__) . '/PEAR' . PATH_SEPARATOR . get_include_path());
//date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'HTTP/Request2.php';


class Core_CheckPay {
    private $clientID = 'CS';
    private $api_key = 'Wmc$to0!';
    protected static $_instance = null;
    
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }
    public function checkpay($account){
        try {
            //echo Date('d-m-Y H:I:s',time());
            $time_request = round(microtime(true) * 1000);
            $time_request = number_format($time_request,0,".","");
            $token = md5($account . $this->api_key . $account . $time_request);
            $data = array(
                'token' => $token,
                'ts' => $time_request,
                'zingid' => $account,
                'clientid' => $this->clientID,
            );
            $data = json_encode($data);
            $url = "http://api.hotro.zing.vn/APIPayingSupport/vip360-v1/chkpoint";
            $request = new HTTP_Request2($url, HTTP_Request2::METHOD_POST);
            $content_type = "application/json; charset=utf-8";
            $request->setHeader('Content-Type: ' . $content_type);
            $request->setBody($data);
            $response = $request->send();
            $result = $response->getBody();
            $dataresult = json_decode($result);
            if($dataresult->code == 1){
                if(is_array($dataresult->data) && $dataresult->data[0]->TotalZingXu >= 200){
                    return true;
                }else {
                    return false;                
                }
            }else {
                return false;
            }
            
        } catch (Exception $exc) {
            return false;
        }

        
        
    }
    
}
