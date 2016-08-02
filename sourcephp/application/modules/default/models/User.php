<?php
class Model_User //extends Model_Base_User
{
	public $zingId = NULL;
	public $passportId;

    public function __construct() {
        parent::__construct();

        // initial check login
        $this->getZingId();
    }

    /**
     * Return singleton instance of this class
     * @param string $className
     * @return Model_User
     */
	public static function getInstance($className=__CLASS__){
		return parent::getInstance($className);
	}

    /**
     * Verify a user is logged in or not
     * @return boolean Return true if user has logged in, otherwise return false
     */
    public function isLoggedIn() {
        $session = new Zend_Session_Namespace('vngauth');
        if(isset($session->vngauth) && isset($session->acn) && isset($session->uin)
                && !empty($session->vngauth) && !empty($session->acn) && !empty($session->uin)) {
            return true;
        }
        return false;
    }

    /**
     * Return Zend_Session_Namespace which holds the user identity
     * @return \Zend_Session_Namespace
     */
    public function getUserSession() {
        return new Zend_Session_Namespace('vngauth');
    }

    /**
     * Clear user authentication
     */
	public function clearCache(){
        $session = new Zend_Session_Namespace('vngauth');
        $session->vngauth = NULL;
        $session->acn = NULL;
        $session->uin = NULL;
		setcookie("uin", NULL,0,"/");
		setcookie("acn", NULL,0,"/");
		setcookie("vngauth",NULL,0,"/");
	}

    /**
     * Get the zingid of logged in user
     * Return NULL if user has not logged in yet
     * @return string The zing id
     */
    public function getZingId(){
		if(empty($this->zingId) || empty($this->passportId)){

			$session = new Zend_Session_Namespace('vngauth');
			if($session->vngauth){
				$vngauth = $session->vngauth;
			}
			if(empty($session->vngauth)){
				if(empty($_COOKIE['acn']) || empty($_COOKIE['vngauth']) || empty($_COOKIE['uin'])){
					return NULL;
				}else{
					$vngauth = $_COOKIE['vngauth'];
				}
			}else{
				if($_COOKIE['vngauth']!=$session->vngauth){
					$session->vngauth = $_COOKIE['vngauth'];
				}
			}
			$vngauth = isset($_COOKIE['vngauth'])?$_COOKIE['vngauth']:'';
			if(!$vngauth) return NULL;
            if ($vngauth != '-1') { // login sso
                $user = new Core_User();
                $info = $user->getUserLogin($vngauth);
                if(!isset($info['zingid']) || empty($info['zingid'])){
                    $this->clearCache();
                }else{
                    $session->vngauth = $vngauth;
                    $session->acn = $info['zingid'];
                    $session->uin = $info['passportid'];
                    $this->zingId = $info['zingid'];
                    $this->passportId = $info['passportid'];
                }
            } else { //login social
                $this->zingId = $_COOKIE['acn'];
                $this->passportId = $_COOKIE['uin'];
                $session->acn = $_COOKIE['acn'];
                $session->uin = $_COOKIE['uin'];
                $session->vngauth = '-1';
            }
		}
		return $this->zingId;
	}

	public function getPassportId(){
		$this->getZingId();
		return $this->passportId;
	}

    public function getInfoByZingId($zingId){
		if(!empty($zingId)){
			return parent::getInfoByZingId($zingId);
		}
		return '';
	}
}

