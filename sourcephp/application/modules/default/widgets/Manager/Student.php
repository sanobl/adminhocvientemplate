<?php
class Widget_Manager_Student extends Core_Widget{
    
    public function run(){
        $action = $this->getRequest()->getParam('act');
        
        if($action != ''){
            
        }else {
            $liststudent = null;
            $liststudent = Core_MySQLManagerStudent::getInstance()->getliststudent();
            $this->render('student', array(
                'data' =>$liststudent
            ));
        
        } 
    }
    
}