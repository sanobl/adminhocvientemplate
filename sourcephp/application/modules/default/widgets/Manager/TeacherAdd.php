<?php
class Widget_Manager_TeacherAdd extends Core_Widget{
    
    public function run(){
        $isadmin = $_SESSION['isadmin'];
        if ($isadmin != 1)
        {
            $this->forward("/quan-ly-hoc-vien.html");
        }
        $teacher_id = intval($this->getRequest()->getParam("id"));
        $teacher = null;
        if($teacher_id !=0){
            $teacher = Core_MysqlTeacher::getInstance()->getTeacher($teacher_id);
        }
        $error = 0; 
        /*-1: exist
         * -2: 
         */
        if(!empty($_POST)){
            $teacher_name = $this->getRequest()->getParam("teacher_name");
            $teacher_email = $this->getRequest()->getParam("teacher_email");
            $teacher_phone = $this->getRequest()->getParam("teacher_phone");
            $teacher_address = $this->getRequest()->getParam("teacher_address");
            $teacher_isDelete = $this->getRequest()->getParam("teacher_isDelete");
            $teacher_isActive = $this->getRequest()->getParam("teacher_isActive");
            
            $createat = date('Y/m/d H:i:s');
            if($teacher_id !=0 && $teacher != null){ //update
                Core_MysqlTeacher::getInstance()->updateTeacher(array($teacher_name, $teacher_email, $teacher_phone, 
                intval($teacher_isActive), intval($teacher_isDelete), $createat,  $teacher_address, $teacher_id));

            } else{ //insert   
                if(Core_MysqlTeacher::getInstance()->checkExist($teacher_name)){
                    $error = -1;
                    return $this->render('teacher_add', array(    
                        'error' => $error,
                        'teacher' => array(
                            'name' => $teacher_name,
                            'email' => $teacher_email,
                            'phone' => $teacher_phone,
                            'address' => $teacher_address,
                            'isactive' => $teacher_isActive,
                            'isdelete' => $teacher_isDelete
                        )
                    ));
                } else {
                    Core_MysqlTeacher::getInstance()->insertTeacher(array($teacher_name, $teacher_email, $teacher_phone, 
                    intval($teacher_isActive), intval($teacher_isDelete), $createat, $createat,  $teacher_address));
                }
            }
            $url = '/quan-ly-giao-vien.html';
            $this->forward($url);
            
        } else {           
            if($teacher_id !=0 && $teacher != null){
                return $this->render('teacher_add', array(     
                    'error' => $error,
                    'teacher' => $teacher[0]
                ));
            }
        }
        return $this->render('teacher_add', array(   
            'error' => $error                
        ));
    }
    
}