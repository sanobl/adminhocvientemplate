<?php

class Widget_Manager_User extends Core_Widget{
    
    public function run(){    
        $users = null;
        $search = trim($this->getRequest()->getParam("teacher_name_search"));
//        if($search != ''){
//            $users = Core_MysqlTeacher::getInstance()->getTeachersSearch($search);
//        } else
//            $users = Core_MysqlTeacher::getInstance()->getTeachers(); 
        $this->render('user_list', array(
            'users' => $users,
            'search' => $search
        ));
    }
    
}
