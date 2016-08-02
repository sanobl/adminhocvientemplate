<?php
 if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
class Core_TokenKey {

    protected static  $_token_name = 'token';
    private $_time_live = 3600;
    protected static $_value = '';
    protected static $_instance = null;

    public function __construct() {
        
    }

    public static function getInstance() {
        
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
        
    }

    public static function create_token() {    
        $token = '';
        $now = time();
        if (!isset($_SESSION['token'])) {
            $token = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']. $now . 'cstdvng');
            try {
                $_SESSION['token'] = $token;
            } catch (Exception $e) {

            }
        }else {
            $token = $_SESSION['token'];
        }
        return $token;
    }

    public static function _validate($token) {
        if (!isset($_SESSION['token'])) {
            return false;
        } else if ($token != $_SESSION['token']) {
            return false;
        }
        return true;
    }

}
