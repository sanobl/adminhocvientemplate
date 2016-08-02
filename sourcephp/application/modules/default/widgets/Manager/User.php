<?php

class Widget_Manager_User extends Core_Widget{
    
    public function run(){    
        $users = null;       
        if(!empty($_POST)){
            if(trim($this->getRequest()->getParam("useredt_id")) != ''){
                //delete
                Core_MysqlUser::getInstance()->deleteUser(trim($this->getRequest()->getParam("useredt_id")));
            }
        }
        $search_name = trim($this->getRequest()->getParam("user_name_search"));
        $search_fullname = trim($this->getRequest()->getParam("user_fullname_search"));
        if($search_name != '' || $search_fullname != ''){
            $users = Core_MysqlUser::getInstance()->getUserSearch($search_name, $search_fullname);
        } else
            $users = Core_MysqlUser::getInstance()->getUsers(); 
        $this->render('user_list', array(
            'users' => $users,
            'search_name' => $search_name,
            'search_fullname' => $search_fullname
        ));
    }
    
}
