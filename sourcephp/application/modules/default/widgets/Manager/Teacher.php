<?php
class Widget_Manager_Teacher extends Core_Widget{
    
    public function run(){   
        $teachers = null;        
        if(!empty($_POST)){
            if(trim($this->getRequest()->getParam("teacheredt_id")) != ''){
                //delete
                Core_MysqlTeacher::getInstance()->deleteTeachers(trim($this->getRequest()->getParam("teacheredt_id")));
            }
        }
        $search = trim($this->getRequest()->getParam("teacher_name_search"));
        if($search != ''){
            $teachers = Core_MysqlTeacher::getInstance()->getTeachersSearch($search);
        } else
            $teachers = Core_MysqlTeacher::getInstance()->getTeachers();
        $this->render('teacher_list', array(
                'teachers' => $teachers,
            'search' => $search
        ));
    }
    
}