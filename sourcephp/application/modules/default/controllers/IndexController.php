<?php

class IndexController extends Zend_Controller_Action {

    public function indexAction() {
        try {
            $page = Core_Page::getInstance();
            $page->init($this->_request, $this->view);
            $page->load();          
            if(!empty($page->_page['title']))
                $this->view->headTitle()->prepend($page->_page['title']);
            else
                $this->view->headTitle()->prepend('Hỗ trợ khách hàng');
            foreach ($page->_page['meta'] as $key => $des) {
                if (!empty($des)){
                    $this->view->headMeta()->prependName($key, $des);
                    //$this->view->headMeta()->setName($key, $des);
                }
            }
        } catch (Exception $ex) {
            var_dump($ex);
            die;
        }
    }
}

?>