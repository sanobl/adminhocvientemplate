<?php

class Widget_Manager_StudentAdd extends Core_Widget {

    public function run() {
        $isLogin = true;
        $listsubjects = '';
        $createdby = 'thuatnv';
        $studentdetail = '';
        if ($isLogin) {
            $listsubjects = Core_MySQLManagerStudent::getInstance()->getlistsubjects();
            $studentid = intval($this->getRequest()->getParam("index1"));

            if (empty($_POST)) {
                $student_fullname = '';
                $student_fullname = '';
                $student_phone = '';
                $student_email = '';
                $parent_fullname = '';
                $parent_phone = '';
                $parent_email = '';
                $subject_id = '';
                $payment_type = '';
                if($studentid != 0){
                    $studentdetail = Core_MySQLManagerStudent::getInstance()->getstudentbyid($studentid);
                    if(is_array($studentdetail) && count($studentdetail) > 0){
                        $studentdetail = $studentdetail[0];
                        $student_fullname = $studentdetail['student_fullname'];
                        $student_phone = $studentdetail['student_phone'];
                        $student_email = $studentdetail['student_email'];
                        $parent_fullname = $studentdetail['parent_fullname'];
                        $parent_phone = $studentdetail['parent_phone'];
                        $parent_email = $studentdetail['parent_email'];
                        $subject_id = $studentdetail['subject_id'];
                        $payment_type = $studentdetail['payment_type'];
                    }
                   
                }
                $this->render('studentadd', array(
                    'listsubjects'=> $listsubjects,
                    'student_fullname'=> $student_fullname,
                    'student_phone'=> $student_phone,
                    'student_email'=> $student_email,
                    'parent_fullname'=> $parent_fullname,
                    'parent_phone'=> $parent_phone,
                    'parent_email'=> $parent_email,
                    'subject_id'=> $subject_id,
                    'payment_type'=>$payment_type
                ));
            } else {
                //var_dump($_POST);die;
                $datapost = array();
                $teacher_id = 0;
                $money_total = 0;
                $student_fullname = isset($_POST['student_fullname']) ? $_POST['student_fullname'] : '';
                $student_phone = isset($_POST['student_phone']) ? $_POST['student_phone'] : '';
                $student_email = isset($_POST['student_email']) ? $_POST['student_email'] : '';
                $parent_fullname = isset($_POST['parent_fullname']) ? $_POST['parent_fullname'] : '';
                $parent_phone = isset($_POST['parent_phone']) ? $_POST['parent_phone'] : '';
                $parent_email = isset($_POST['parent_email']) ? $_POST['parent_email'] : '';
                $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : 0;
                $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
                if($_POST['subject_id'] != ''){
                    $subjectsdetail = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid(intval($subject_id));
                    if($subjectsdetail != '' && is_array($subjectsdetail)){
                        $subjectsdetail = $subjectsdetail[0];
                        $teacher_id =  $subjectsdetail['teacher_id'];
                        $money_total =  $subjectsdetail['money_total'];
                        
                    }
                }
                $created_at = date("Y-m-d H:i:s");
                if($studentid != 0){
                    $result = Core_MySQLManagerStudent::getInstance()->updatestudent($student_fullname,$student_phone, $student_email,
                                                                                $parent_fullname,$parent_phone,$parent_email,
                                                                                $subject_id,$teacher_id,$payment_type,
                                                                                $money_total,$created_at,$createdby,$studentid);  
                }else {
                    $result = Core_MySQLManagerStudent::getInstance()->insertstudent($student_fullname,$student_phone, $student_email,
                                                                                $parent_fullname,$parent_phone,$parent_email,
                                                                                $subject_id,$teacher_id,$payment_type,
                                                                                $money_total,$created_at,$createdby);  
                }
                              
                $url = '/quan-ly-hoc-vien.html';
                $this->forward($url);
                
            }
        } else {
            
        }
    }

}
