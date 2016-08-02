<?php

class Widget_Manager_UserAdd extends Core_Widget{
    
    public function run(){    
        $user_id = intval($this->getRequest()->getParam("id"));
        $user = null;
        if($user_id !=0){
            $user = Core_MysqlTeacher::getInstance()->getTeacher($user_id);
        }
        $error = 0; 
        /*-1: exist
         * -2: 
         */
        if(!empty($_POST)){
            $user_name = $this->getRequest()->getParam("user_name");
            $user_email = $this->getRequest()->getParam("user_email");
            $user_phone = $this->getRequest()->getParam("user_phone");
            $user_fullname = $this->getRequest()->getParam("user_fullname");
            $user_isDelete = $this->getRequest()->getParam("user_isDelete");
            $user_isActive = $this->getRequest()->getParam("user_isActive");
            
            $createat = date('Y/m/d H:i:s');
            if($user_id !=0 && $user != null){ //update
                Core_MysqlTeacher::getInstance()->updateTeacher(array($user_name, $user_email, $user_phone, 
                intval($user_isActive), intval($user_isDelete), $createat,  $user_address, $user_id));

            } else{ //insert   
                if(Core_MysqlTeacher::getInstance()->checkExist($user_name)){
                    $error = -1;
                    return $this->render('user_add', array(    
                        'error' => $error,
                        'user' => array(
                            'name' => $user_name,
                            'email' => $user_email,
                            'phone' => $user_phone,
                            'address' => $user_address,
                            'isactive' => $user_isActive,
                            'isdelete' => $user_isDelete
                        )
                    ));
                } else {
                    Core_MysqlTeacher::getInstance()->insertTeacher(array($user_name, $user_email, $user_phone, 
                    intval($user_isActive), intval($user_isDelete), $createat, $createat,  $user_address));
                }
            }
            $url = '/quan-ly-nguoi-dung.html';
            $this->forward($url);
            
        } else {           
            if($user_id !=0 && $user != null){
                return $this->render('user_add', array(     
                    'error' => $error,
                    'user' => $user[0]
                ));
            }
        }
        return $this->render('user_add', array(   
            'error' => $error                
        ));
    }
    
}
