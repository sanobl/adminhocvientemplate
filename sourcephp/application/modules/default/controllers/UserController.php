<?php
session_start();
class UserController extends Zend_Controller_Action {
    
    public function init() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }
    public function indexAction() {
        
    }
    public function loginAction() {         

        Core_Facebook::login();
                 
    }
    public function logoutAction() {
        session_destroy();
        $_SESSION = array();
        echo 1;die;
        
    }
}
