<?php

class Widget_Manager_Student extends Core_Widget {

    public function run() {
       
        $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
        $teacherid = isset($_POST['teacher']) ? trim($_POST['teacher']) : '';
        $subjectsid = isset($_POST['subjects']) ? trim($_POST['subjects']) : '';
        $usercreate = isset($_POST['usercreate']) ? trim($_POST['usercreate']) : '';
        $type = isset($_POST['type']) ? trim($_POST['type']) : 2;
        $liststudent = null;
        $listteacher = null;
        $listsubjects = null;
        $listsubjects = Core_MySQLManagerStudent::getInstance()->getlistsubjects(0);
        $listteacher = Core_MySQLManagerStudent::getInstance()->getlistteacher();
        if($fullname != '' || $teacherid != '' || $subjectsid != '' || $usercreate != ''){
            $liststudent = Core_MySQLManagerStudent::getInstance()->searchstudent($fullname,$teacherid,$subjectsid,$usercreate,$type);
        }else {
            $liststudent = Core_MySQLManagerStudent::getInstance()->searchstudent($fullname,$teacherid,$subjectsid,$usercreate,$type);//getliststudent();
        }
        
        return $this->render('student', array(
            'data' => $liststudent,
            'listsubjects' => $listsubjects,
            'listteacher' => $listteacher,
            'fullname' => $fullname,
            'teacherid' => $teacherid,
            'subjectsid' => $subjectsid,
            'usercreate' => $usercreate,
            'type' => $type
        ));
    }

}
