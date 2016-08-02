<?php

class Core_SendZALO {

    private $config;
    private $key;
    protected static $_instance = null;

    const regex1 = '/(0)+(86|89|88|90|91|93|94|96|97|98|120|121|122|123|124|125|126|127|128|129|162|163|164|165|166|167|168|169)\d{7}$/';
    const regex2 = '/(84)+(86|89|88|90|91|93|94|96|97|98|120|121|122|123|124|125|126|127|128|129|162|163|164|165|166|167|168|169)\d{7}$/';

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    public function send($otp = '', $phonenumber = '', $countryCode = '') {
        $phone = '';
        $message = '';
        $sig = '';
        $linkAPI = $this->config->linksend;
        try {
            if($countryCode != '' && intval($countryCode) === 84){
                if (preg_match(Core_SendZALO::regex1, $phonenumber)) {
                    $phone = 84 . substr($phonenumber, 1);
                }
                if (preg_match(Core_SendZALO::regex2, $phonenumber)) {
                    $phone = $phonenumber;
                }
            }else {
                $phone = $countryCode.$phonenumber;
            }
            
            if ($phone != '' && $otp != '') {
                $message = 'Chương trình liên kết điểm tích lũy: mã xác nhận của bạn là ' . $otp . ', nhập mã xác nhận để tiếp tục tham gia chương trình (hiệu lực trong 30 phút)';
                $sig = hash('sha256', $this->config->keysend . $message.$phone);
                $data = array(
                    "type" => "zalo",
                    "sig" => $sig,
                    "message" => array(
                        "content" => $message,
                        "phonenumber" => $phone
                    )
                );
                $curl = curl_init($linkAPI);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($data)))
                );
                $curl_response = curl_exec($curl);
                if ($curl_response === false) {
                    $info = curl_getinfo($curl);
                    $messagelog = '[LINKED VIP][RESPONE Zend ZALO] - INFO:'.json_encode($info).' - DATA: ' . json_encode($data) . "\n";
                    Core_Log::sendLog($messagelog);
                }else {
                    curl_close($curl);
                    $decoded = json_decode($curl_response);
                    if (isset($decoded->status) && $decoded->status == '1') {
                        $messagelog = '[LINKED VIP][RESPONE SUCCESFULLY] OutPut: '.$curl_response. ' - DATA: ' . json_encode($data) . "\n";
                        Core_Log::sendLog($messagelog);
                        return TRUE;
                    }else {
                        return FALSE;
                    }
                    
                }
                
            }
        } catch (Exception $e) {
            $messagelog = '[LINKED VIP][RESPONE Exception] -  Exception: ' . $e->getMessage() . "\n";
            Core_Log::sendLog($messagelog);
        }
        return FALSE;
    }

}
