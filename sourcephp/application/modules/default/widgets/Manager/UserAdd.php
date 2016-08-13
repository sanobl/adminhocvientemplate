<?php

class Widget_Manager_UserAdd extends Core_Widget{
    
    public function run(){
        $isadmin = $_SESSION['isadmin'];
        if ($isadmin != 1)
        {
            $this->forward("/quan-ly-hoc-vien.html");
        }
        $user_id = intval($this->getRequest()->getParam("id"));
        $view = intval($this->getRequest()->getParam("view"));
        $user = null;
        if($user_id !=0){
            $user = Core_MysqlUser::getInstance()->getUser($user_id);
        }
        $error = 0; 
        /*-1: exist
         * -2: 
         */
        if(!empty($_POST)){
            $user_name = $this->getRequest()->getParam("user_name");
            $user_email = $this->getRequest()->getParam("user_email");
            $user_phone = $this->getRequest()->getParam("user_phone");
            $user_password = md5($this->getRequest()->getParam("user_password"));
            $user_fullname = $this->getRequest()->getParam("user_fullname");
            $user_isDelete = $this->getRequest()->getParam("user_isdelete");
            $user_isAdmin = $this->getRequest()->getParam("user_isadmin");
            
            $createat = date('Y/m/d H:i:s');
            if($user_id !=0 && $user != null){ //update
                Core_MysqlUser::getInstance()->updateUser(array($user_name, $user_email, $user_password,
                    $createat, intval($user_isAdmin), intval($user_isDelete), $user_phone, $user_fullname, $user_id));

            } else{ //insert   
                if(Core_MysqlUser::getInstance()->checkExist($user_name)){
                    $error = -1;
                    return $this->render('user_add', array(    
                        'error' => $error,
                        'user' => array(
                            'name' => $user_name,
                            'email' => $user_email,
                            'phone' => $user_phone,
                            'password' => $user_password,
                            'isadmin' => $user_isAdmin,
                            'isdelete' => $user_isDelete,
                            'full_name' => $user_fullname,
                            'view' =>$view
                        )
                    ));
                } else {
                    Core_MysqlUser::getInstance()->insertUser(array($user_name, $user_password, $user_email, $user_phone, 
                    intval($user_isAdmin), intval($user_isDelete), $createat, $createat,  $user_fullname));
                }
            }
            $url = '/quan-ly-nguoi-dung.html';
            $this->forward($url);
            
        } else {           
            if($user_id !=0 && $user != null){
                return $this->render('user_add', array(     
                    'error' => $error,
                    'user' => $user[0],
                    'view' =>$view
                ));
            }
        }
        return $this->render('user_add', array(   
            'error' => $error                
        ));
    }
    
}
