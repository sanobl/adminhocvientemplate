<?php
session_start();
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/Facebook/');
require_once __DIR__ . '/Facebook/autoload.php';

class Core_Facebook {

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    public static function getlogin() {
        $response = false;
        $login = array();        
        $fb = new Facebook\Facebook([
            'app_id' => '1493107534322324',
            'app_secret' => '1dd334c2c60aa8b43f50a0e48a84edfc',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getJavaScriptHelper();
        //$helper = $fb->getCanvasHelper();
        try {
            if(isset($_SESSION['fb_access_token'])){
                $accessToken = $_SESSION['fb_access_token'];
            }else {
                $accessToken = $helper->getAccessToken();
            }                  
            $response = $fb->get('/me?fields=id,name,email', $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            //echo '<pre> 1';
            //var_dump($e);die;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            //echo '<pre> 2';
            //var_dump($e);die;
        }
        if ($response) {
            $login = $response->getDecodedBody();
        }
        return $login;
    }
    public static function login() {

        $fb = new Facebook\Facebook([
            'app_id' => '1493107534322324',
            'app_secret' => '1dd334c2c60aa8b43f50a0e48a84edfc',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getJavaScriptHelper();
        try {            
            $accessToken = $helper->getAccessToken();   
        } catch (Facebook\Exceptions\FacebookResponseException $e) {

        } catch (Facebook\Exceptions\FacebookSDKException $e) {

        }
        if (!isset($accessToken)) {
            echo 0;// 'No cookie set or no OAuth data could be obtained from cookie.';
            exit;
        }
        $_SESSION['fb_access_token'] = (string)$accessToken;
        return 1;
    }
    public static function logout(){
        $fb = new Facebook\Facebook([
            'app_id' => '1493107534322324',
            'app_secret' => '1dd334c2c60aa8b43f50a0e48a84edfc',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getJavaScriptHelper();
    }

}
