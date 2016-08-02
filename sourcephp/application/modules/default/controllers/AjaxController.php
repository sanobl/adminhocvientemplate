<?php

class AjaxController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction() {
        //echo 'ffff';die;
    }

    public function imageAction() {
//        $this->_helper->layout->disableLayout();
//        $this->_helper->viewRenderer->setNoRender(true);

        $w = isset($_GET['w']) ? preg_replace('/[\/\&%#\$\?\:\;\"\'\--\.\0\b\n\r\t\Z\\\_]/', '', htmlspecialchars($_GET['w'])) : '142';
        $h = isset($_GET['h']) ? preg_replace('/[\/\&%#\$\?\:\;\"\'\--\.\0\b\n\r\t\Z\\\_]/', '', htmlspecialchars($_GET['h'])) : '38';
        $c = isset($_GET['c']) ? '#' . preg_replace('/[\/\&%#\$\?\:\;\"\'\--\.\0\b\n\r\t\Z\\\_]/', '', htmlspecialchars($_GET['c'])) : '#ddd';

        $captcha = new Core_Captcha($w, $h, $c);

        $key = isset($_GET['k']) ? preg_replace('/[\/\&%#\$\?\:\;\"\'\--\.\0\b\n\r\t\Z\\\_]/', '', htmlspecialchars($_GET['k'])) : '';
        if (empty($key))
            exit;
        $text = $captcha->FetchRegistrationString(6);

        $captcha->setImage($text);
        $sessionCaptcha = new Zend_Session_Namespace('Verify_Code');
        $sessionCaptcha->vCode = $text;
        $sessionCaptcha->setExpirationSeconds(360);
        //$caching = Core_Global::getCaching(); 
        //$caching->save($text, $key, array(), 5*60*60);
        $captcha->show_image();
    }

    public function checkloginAction() {
        if (Core_User::getInstance()->checkLoginStatus()) {
            echo '1';
            die;
        } else {
            echo '-1';
            die;
        }
    }

    public function checkaccountAction() {
//        $this->_helper->layout->disableLayout();
//        $this->_helper->viewRenderer->setNoRender(true);        
        $account = $this->_request->getParam('account'); //isset($_GET['account']) ? $_GET['account'] : '';
        $keyImg = $this->_request->getParam('key'); //isset($_GET['key']) ? $_GET['key'] : '';
        $img = $this->_request->getParam('img'); //isset($_GET['img']) ? $_GET['img'] : '';      
        $type = $this->_request->getParam('type'); //isset($_GET['img']) ? $_GET['img'] : ''; 
        if ($type > 0) {
            $userInfo = Core_User::getInstance()->checkLoginStatus();
            if ($userInfo) {
                $account = $userInfo['acn'];
            } else {
                echo "[{isExisted:-1,img:0,status:0}]";
                die;
            }
        }
        if (!empty($account) && !empty($keyImg) && !empty($img)) {
            $sessionCaptcha = new Zend_Session_Namespace('Verify_Code');
            $verifyImg = 0;
            $checkAccount = 0;
            $statusAccount = 0;
            $serverImg = isset($sessionCaptcha->vCode) ? $sessionCaptcha->vCode : '';
            if (strtolower($img) == strtolower($serverImg)) {
                $verifyImg = 1;
            }
            if (strtolower($account) == 'minh') {//neu account la account cua A. Minh thi luon thong bao la tai khoan khong ton tai
                $checkAccount = 0;
            } else {
                $result = Core_User::getInstance()->checkAccountFromPassport($account);
                if (is_array($result->string)) {
                    if ($result->string[0] == '1') {
                        $checkAccount = 1;
                        // kiem tra status cua account
                        $iStatusAccount = $result->string[2];
                        $arrStatus = $this->getAccount($iStatusAccount);
                        if (isset($arrStatus[11]) && $arrStatus[11] == 1)
                            $statusAccount = 1;
                    }else if ($result->string[0] == '0') {
                        $checkAccount = 0;
                    } else if ($result->string[0] == '2') {
                        $checkAccount = 2;
                    } else if ($result->string[0] == '4') {
                        $checkAccount = 4;
                    } else if ($result->string[0] == '5') {
                        $checkAccount = 5;
                    } else if ($result->string[0] == '1000') {
                        $checkAccount = 1000;
                    } else if ($result->string[0] == '2001') {
                        $checkAccount = 2001;
                    }
                }
                //$checkAccount = 1;
                //$statusAccount = 1;
            }
            echo "[{isExisted:" . $checkAccount . ",img:" . $verifyImg . ",status:" . $statusAccount . "}]";
        } else {
            echo "[{isExisted:0,img:0,status:0}]";
        }
    }

    //UploadFile    
    public function uploadAction() {
        $userInfo = Core_User::getInstance()->checkLoginStatus();
        $account = '';
        if ($userInfo) {
            $account = $userInfo['acn'];
        } else {
            //echo -1;die; //chua log in
            $account = 'formgopy';
        }
        $key = isset($_GET['k']) ? preg_replace('/[\/\&%#\$\?\:\;\"\'\--\.\0\b\n\r\t\Z\\\_]/', '', htmlspecialchars($_GET['k'])) : '';
        $preventspamId = new Zend_Session_Namespace('cst' . $account . trim($_SERVER['REMOTE_ADDR']) . trim($key));
        if ($preventspamId->array == null) {
            $term = array();
            $term["time"] = time(); // Account type
            $term['count'] = 0;
            $term['file'] = array();
            $preventspamId->array = $term;
        }
        $expire = time() - $preventspamId->array['time'];
        if ($expire > 600) { //10phut
            $term = array();
            $term['time'] = time();
            $term['count'] = 1;
            $term['file'] = array();
            $preventspamId->array = $term;
        } else {
            $term = array();
            $term['time'] = $preventspamId->array['time'];
            $term['count'] = $preventspamId->array['count'] + 1;
            $term['file'] = $preventspamId->array['file'];
            $preventspamId->array = $term;
        }

        $dirImageName = isset($_GET['dir']) ? preg_replace('/[\/\&%#\$\?\:\;\"\'\--\.\0\b\n\r\t\Z\\\_]/', '', htmlspecialchars($_GET['dir'])) : '';
        Core_UploadFile::getInstance()->initialize(null, true, null, $dirImageName, $preventspamId);
    }

    
}

?>