<?php
class Widget_Manager_StudentDetail extends Core_Widget{
    
    public function run(){
        $action = $this->getRequest()->getParam('act');
        if($action != ''){
            
        }else {
        $this->render('studentdetail', array(
                
        ));
        
        } 
    }
    
}