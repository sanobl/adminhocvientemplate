<?php

class Widget_Manager_StudentAdd extends Core_Widget {

    public function run() {
        $isLogin = true;
        $listsubjects = '';
        $creatby = 'thuatnv';
        if ($isLogin) {
            $listsubjects = Core_MySQLManagerStudent::getInstance()->getlistsubjects();
            //var_dump($listsubjects);die;
            if (empty($_POST)) {
                $this->render('studentadd', array(
                    'listsubjects'=> $listsubjects
                ));
            } else {
                //var_dump($_POST);die;
                $datapost = array();
                $datapost[] = isset($_POST['student_fullname']) ? $_POST['student_fullname'] : '';
                $datapost[] = isset($_POST['student_phone']) ? $_POST['student_phone'] : '';
                $datapost[] = isset($_POST['student_email']) ? $_POST['student_email'] : '';
                $datapost[] = isset($_POST['parent_fullname']) ? $_POST['parent_fullname'] : '';
                $datapost[] = isset($_POST['parent_phone']) ? $_POST['parent_phone'] : '';
                $datapost[] = isset($_POST['parent_email']) ? $_POST['parent_email'] : '';
                $datapost[] = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
                
                if($_POST['subject_id'] != ''){
                    $dataid = array();
                    $dataid[] = $_POST['subject_id'];
                    $subjectsdetail = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid($dataid);
                    if($subjectsdetail != '' && is_array($subjectsdetail)){
                        $subjectsdetail = $subjectsdetail[0];
                        $datapost[] =  $subjectsdetail['teacher_id'];
                        $datapost[] =  $subjectsdetail['payment_type'];
                        $datapost[] =  $subjectsdetail['money_total'];
                        
                    }
                }
                //var_dump($datapost);die;
                $result = Core_MySQLManagerStudent::getInstance()->insertstudent($datapost);
                
                
                var_dump($result);
            }
        } else {
            
        }
    }

}
