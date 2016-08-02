<?php

class Core_CCTalk {

    private $config;
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

    /*
     * @Description: Lay tai khoan tu Uin
     */

    public function getAcnByUin($passportId) {
        $arrParams = array(
            'PassportId' => $passportId,
            'auth' => $this->config->passportWrapperauthCCTalk
        );
        try {
            $client = new SoapClient($this->config->passport->url);
            $result_list = $client->getAcnByUin($arrParams);
            if ($result_list->getAcnByUinResult->string[0] == 1) {
                return $result_list->getAcnByUinResult->string[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('lay tai khoan: getAcnByUin', $e->getMessage());
            return '';
        }
    }
	public function getProfileContactByAcn($account) {
		$url = $this->config->passport->url;
        $arrParams = array(
            'accountName' => $account,
            'auth' => md5("cstool@123".$account."cstool@123")
        );
        try {
			$client = new SoapClient($this->config->passport->url);
            $result_list = $client->getProfileContactByAcn($arrParams);
            if ($result_list->getProfileContactByAcnResult->string[0] == 1) {
                return $result_list->getProfileContactByAcnResult->string[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
			var_dump($e);die;
            return '';
        }
    }
    public function getUinByAcn($account) {
        $arrParams = array(
            'accountName' => $account,
            'auth' => $this->config->passportWrapperauthCCTalk
        );
        try {
            $client = new SoapClient($this->config->passport->url);
            $result_list = $client->getUinByAcn($arrParams);
            if ($result_list->getUinByAcnResult->string[0] == 1) {
                return $result_list->getUinByAcnResult->string[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('lay tai khoan: getAcnByUin', $e->getMessage());
            return '';
        }
    }

    public function CheckVip($account) {
        try {
            $functionNo = 'RequestService';
            $aData["serviceName"] = 'VIP_GETDETAIL_VIPINFOR_BYACC';
            $aData["body"] = array($account);
            $aData['userIP'] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->api->sig;
            // if (!is_array($aData["body"])) {
            // $signal.= $aData['serviceName'];
            // } else {
            // $temp = "";
            // for ($i = 0; $i < count($aData["body"]); $i++) {
            // $temp .= $aData["body"][$i];
            // }
            // $signal .= $aData["serviceName"] . $temp;
            // }
            $client = new SoapClient($this->config->api->VIPService);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestServiceResult->ArrayOfstring;
            if (is_array($arrResult) && $arrResult[0]->string[0] > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Core_SendMail::getInstance()->SendMailError('CheckVIP (Chức năng kiểm tra account có phải Khach hang dc ho tro cctal)', $e->getMessage());
        }
        return false;
    }

    public function listProduct() {
        return array(
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/GUNNY.gif', 'roomId' => 88882, 'productId' => 162, 'productName' => 'Gunny'),
            // array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images.'cctalk/GUNNY.gif',	'roomId' => 10476, 'productId' => 151, 'productName' => 'Boom Online'),
            // array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images.'cctalk/GUNNY.gif',	'roomId' => 10476, 'productId' => 162, 'productName' => 'Củ Hành'),
            // array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images.'cctalk/GUNNY.gif',	'roomId' => 10476, 'productId' => 162, 'productName' => 'Hàng Rong'),
            // array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images.'cctalk/GUNNY.gif',	'roomId' => 10476, 'productId' => 162, 'productName' => 'Khu Vườn Trên Mây'),
            // array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images.'cctalk/GUNNY.gif',	'roomId' => 10476, 'productId' => 162, 'productName' => 'Phong Thần'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLTK2.gif', 'roomId' => 88884, 'productId' => 150, 'productName' => 'Võ Lâm Truyền Kỳ 2'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/9k.jpg', 'roomId' => 88884, 'productId' => 282, 'productName' => '9k Truyền kỳ'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/THANKHUC.jpg', 'roomId' => 88884, 'productId' => 213, 'productName' => 'Thần Khúc'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/NGOALONG.jpg', 'roomId' => 88884, 'productId' => 182, 'productName' => 'Ngọa Long'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/AIMYNHAN.jpg', 'roomId' => 88884, 'productId' => 231, 'productName' => 'Ải Mỹ Nhân'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLCTC.gif', 'roomId' => 88881, 'productId' => 281, 'productName' => 'VLTK - Công Thành Chiến'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/NHAICO.gif', 'roomId' => 88881, 'productId' => 276, 'productName' => 'Nhai Cơ Tam Quốc'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLTK.gif', 'roomId' => 88881, 'productId' => 166, 'productName' => 'Võ Lâm Miễn Phí'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLTK.gif', 'roomId' => 88881, 'productId' => 164, 'productName' => 'Võ Lâm Truyền Kỳ 1'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLCM.gif', 'roomId' => 88883, 'productId' => 180, 'productName' => 'Võ Lâm Chi Mộng'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/2s.gif', 'roomId' => 88883, 'productId' => 163, 'productName' => '2S'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/kiemthe.jpg', 'roomId' => 88883, 'productId' => 165, 'productName' => 'Kiếm Thế'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLCM-vuigame.jpg', 'roomId' => 88883, 'productId' => 258, 'productName' => 'Võ Lâm Chi Mộng (VuiGame)'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLCM-ZME.jpg', 'roomId' => 88883, 'productId' => 246, 'productName' => 'Võ Lâm Chi Mộng (ZMe)'),
            array('imageName' => Core_Global::getApplicationIni()->app->static->frontend->images . '/cctalk/VLCM-ZPLAY.jpg', 'roomId' => 88883, 'productId' => 252, 'productName' => 'Võ Lâm Chi Mộng (ZPlay)')
        );
    }

    public function listRoomByProduct() {
        return array(
            162 => array('roomId' => 88882, 'subroomId' => 'Gunny'),
            151 => array('roomId' => 88882, 'subroomId' => 'Boom'),
            220 => array('roomId' => 88882, 'subroomId' => 'Củ hành'),
            339 => array('roomId' => 88882, 'subroomId' => 'độc bộ thiên hạ'),
            351 => array('roomId' => 88882, 'subroomId' => 'Gunny 1'),
            188 => array('roomId' => 88882, 'subroomId' => 'Hàng rong'),
            189 => array('roomId' => 88882, 'subroomId' => 'Khu vườn trên mây'),
            158 => array('roomId' => 88882, 'subroomId' => 'Phong thần'),
            288 => array('roomId' => 88882, 'subroomId' => 'Phong vân'),
            337 => array('roomId' => 88882, 'subroomId' => 'Tân thien long 3D'),
            264 => array('roomId' => 88882, 'subroomId' => 'Thời loạn'),
            150 => array('roomId' => 88884, 'subroomId' => 'Võ Lâm Truyền Kỳ 2'),
            282 => array('roomId' => 88884, 'subroomId' => '9k Truyền kỳ'),
            213 => array('roomId' => 88884, 'subroomId' => 'Thần Khúc'),
            182 => array('roomId' => 88884, 'subroomId' => 'Ngọa Long'),
            231 => array('roomId' => 88884, 'subroomId' => 'Ải Mỹ Nhân'),
            280 => array('roomId' => 88884, 'subroomId' => 'FarmeryZ'),
            257 => array('roomId' => 88884, 'subroomId' => 'Tháp phòng anh hùng chiến'),
            154 => array('roomId' => 88884, 'subroomId' => 'ZingPlay'),
            281 => array('roomId' => 88881, 'subroomId' => 'VLTK - Công Thành Chiến'),
            276 => array('roomId' => 88881, 'subroomId' => 'Nhai Cơ Tam Quốc'),
            166 => array('roomId' => 88881, 'subroomId' => 'Võ Lâm Miễn Phí'),
            164 => array('roomId' => 88881, 'subroomId' => 'Võ Lâm Truyền Kỳ 1'),
            254 => array('roomId' => 88881, 'subroomId' => '2U'),
            348 => array('roomId' => 88881, 'subroomId' => 'Bách chiến vô song'),
            204 => array('roomId' => 88881, 'subroomId' => 'Đảo rồng'),
            201 => array('roomId' => 88881, 'subroomId' => 'Long tướng'),
            261 => array('roomId' => 88881, 'subroomId' => 'Mộng càn khôn'),
            219 => array('roomId' => 88881, 'subroomId' => 'Phàm nhân tu tiên'),
            290 => array('roomId' => 88881, 'subroomId' => 'Tiểu võ lâm'),
            180 => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng'),
            163 => array('roomId' => 88883, 'subroomId' => '2S'),
            165 => array('roomId' => 88883, 'subroomId' => 'Kiếm Thế'),
            258 => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng (VuiGame)'),
            246 => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng (ZMe)'),
            252 => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng (ZPlay)'),
            286 => array('roomId' => 88883, 'subroomId' => 'Giải cứu thế giới'),
            285 => array('roomId' => 88883, 'subroomId' => 'Ngự long tại thiên'),
            265 => array('roomId' => 88883, 'subroomId' => 'Tướng thần'),
            294 => array('roomId' => 88883, 'subroomId' => 'Võ lâm chi mộng 2'),
            216 => array('roomId' => 88883, 'subroomId' => 'Võ lâm 3')
        );
    }

    public function listRoomByProductCode() {
        return array(
            'GN' => array('roomId' => 88882, 'subroomId' => 'Gunny', 'productId' => 162),
            'BnB' => array('roomId' => 88882, 'subroomId' => 'Boom', 'productId' => 151),
            '3Q' => array('roomId' => 88882, 'subroomId' => 'Củ hành', 'productId' => 220),
            'DB' => array('roomId' => 88882, 'subroomId' => 'độc bộ thiên hạ', 'productId' => 339),
            'GNC' => array('roomId' => 88882, 'subroomId' => 'Gunny 1', 'productId' => 351),
            'HR' => array('roomId' => 88882, 'subroomId' => 'Hàng rong', 'productId' => 188),
            'KVTM' => array('roomId' => 88882, 'subroomId' => 'Khu vườn trên mây', 'productId' => 189),
            'FS' => array('roomId' => 88882, 'subroomId' => 'Phong thần', 'productId' => 158),
            'FV' => array('roomId' => 88882, 'subroomId' => 'Phong vân', 'productId' => 288),
            'TTL' => array('roomId' => 88882, 'subroomId' => 'Tân thien long 3D', 'productId' => 337),
            'COCCGSN' => array('roomId' => 88882, 'subroomId' => 'Thời loạn', 'productId' => 264),
            'JX2' => array('roomId' => 88884, 'subroomId' => 'Võ Lâm Truyền Kỳ 2', 'productId' => 150),
            '9K' => array('roomId' => 88884, 'subroomId' => '9k Truyền kỳ', 'productId' => 282),
            'WTVN' => array('roomId' => 88884, 'subroomId' => 'Thần Khúc', 'productId' => 213),
            'WLY' => array('roomId' => 88884, 'subroomId' => 'Ngọa Long', 'productId' => 182),
            'AMN' => array('roomId' => 88884, 'subroomId' => 'Ải Mỹ Nhân', 'productId' => 231),
            'FMRZ' => array('roomId' => 88884, 'subroomId' => 'FarmeryZ', 'productId' => 280),
            'TDVN' => array('roomId' => 88884, 'subroomId' => 'Tháp phòng anh hùng chiến', 'productId' => 257),
            'ZPL' => array('roomId' => 88884, 'subroomId' => 'ZingPlay', 'productId' => 154),
            'JX1CTC' => array('roomId' => 88881, 'subroomId' => 'VLTK - Công Thành Chiến', 'productId' => 281),
            'JJSG' => array('roomId' => 88881, 'subroomId' => 'Nhai Cơ Tam Quốc', 'productId' => 276),
            'JXF' => array('roomId' => 88881, 'subroomId' => 'Võ Lâm Miễn Phí', 'productId' => 166),
            'JX1' => array('roomId' => 88881, 'subroomId' => 'Võ Lâm Truyền Kỳ 1', 'productId' => 164),
            '2U' => array('roomId' => 88881, 'subroomId' => '2U', 'productId' => 254),
            '348' => array('roomId' => 88881, 'subroomId' => 'Bách chiến vô song', 'productId' => 348),
            'DRFB' => array('roomId' => 88881, 'subroomId' => 'Đảo rồng', 'productId' => 204),
            'LOTU' => array('roomId' => 88881, 'subroomId' => 'Long tướng', 'productId' => 201),
            'MCK' => array('roomId' => 88881, 'subroomId' => 'Mộng càn khôn', 'productId' => 261),
            'PNTC2' => array('roomId' => 88881, 'subroomId' => 'Phàm nhân tu tiên', 'productId' => 219),
            'TVLJBS' => array('roomId' => 88881, 'subroomId' => 'Tiểu võ lâm', 'productId' => 290),
            'IAN' => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng', 'productId' => 180),
            'ZS' => array('roomId' => 88883, 'subroomId' => '2S', 'productId' => 163),
            'KTHE' => array('roomId' => 88883, 'subroomId' => 'Kiếm Thế', 'productId' => 165),
            'IANVUIG' => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng (VuiGame)', 'productId' => 258),
            'IANZM' => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng (ZMe)', 'productId' => 246),
            'IANZPL' => array('roomId' => 88883, 'subroomId' => 'Võ Lâm Chi Mộng (ZPlay)', 'productId' => 252),
            'ZBFBS2' => array('roomId' => 88883, 'subroomId' => 'Giải cứu thế giới', 'productId' => 286),
            'YLZT' => array('roomId' => 88883, 'subroomId' => 'Ngự long tại thiên', 'productId' => 285),
            'TT' => array('roomId' => 88883, 'subroomId' => 'Tướng thần', 'productId' => 265),
            'AOJIAN2' => array('roomId' => 88883, 'subroomId' => 'Võ lâm chi mộng 2', 'productId' => 294),
            'JX3' => array('roomId' => 88883, 'subroomId' => 'Võ lâm 3', 'productId' => 216),
        );
    }

    public function listRoomBySGCode() {
        return array(
            'SG1' => array('roomId' => 10423),
            'SG2' => array('roomId' => 88882),
            'SG3' => array('roomId' => 88883),
            'SG4' => array('roomId' => 88884)
        );
    }

    public function GetLastProduct($phoneProtect, $account) {
        $arrParams = array();
        $arrParams["telephoneNumber"] = $phoneProtect;
        $arrParams["account"] = $account;
        //$arrParams["CallUCID"] = $this->config->sFromAddress;
        try {
            $client = new SoapClient($this->config->api->IVRService);
            $oResult = $client->V3_IVR_CHECK_AccountLastContact($arrParams);
            $iResult = $oResult->V3_IVR_CHECK_AccountLastContactResult;
            if (is_object($iResult))
                return $iResult;
        } catch (Exception $e) {
            Core_Log::writeScribe(0, 0, 0, 33, 'CCtalk GetLastProduct, input: ' + json_encode($arrParams) + ' error: ' + $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('CCtalk GetLastProduct (Lay product cuối cùng gui y/c)', $e->getMessage());
        }
        return '';
    }

    public function getProductId($productCode) {
        $aData['serviceName'] = "GET_PRODUCTID_BY_PRODUCTCODE";
        $aData['body'] = array($productCode);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->api->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));
            // var_dump($result_list);die;
            if ($result_list->RequestPortalServiceResult->string[0] == 1 && $result_list->RequestPortalServiceResult->string[1] != 'No_data') {
                return $result_list->RequestPortalServiceResult->string[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_Log::writeScribe(0, 0, 0, 33, 'cctalk getProductId, input: ' + json_encode($aData['body']) + ' error: ' + $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: getProductId', $e->getMessage());
            return '';
        }
    }

    public function getServiceGroup($productId) {
        $aData['serviceName'] = "GET_SG_BY_PRODUCTID";
        $aData['body'] = array($productId);
        $aData['userIP'] = Core_Map::getIp();
        $aData['browserName'] = $_SERVER['HTTP_USER_AGENT'];
        $signal = $this->config->sig . $aData['serviceName'] . $aData['userIP'];
        $aData['signal'] = md5(md5($signal));
        try {
            $client = new SoapClient($this->config->api->support);
            $result_list = $client->__soapCall('RequestPortalService', array($aData));
            // var_dump($result_list);die;
            if ($result_list->RequestPortalServiceResult->string[0] == 1 && $result_list->RequestPortalServiceResult->string[1] != 'No_data') {
                return $result_list->RequestPortalServiceResult->string[1];
            } else {
                return '';
            }
        } catch (Exception $e) {
            Core_Log::writeScribe(0, 0, 0, 33, 'cctalk getProductId, input: ' + json_encode($aData['body']) + ' error: ' + $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('Gửi yêu cầu: getProductId', $e->getMessage());
            return '';
        }
    }
    
   
}

?>