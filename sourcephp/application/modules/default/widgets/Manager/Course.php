<?php

class Widget_Manager_Course extends Core_Widget{
    
    public function run(){
        $isadmin = $_SESSION['isadmin'];
        if ($isadmin != 1)
        {
            $this->forward("/quan-ly-hoc-vien.html");
        }
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $teacherName = isset($_POST['name']) ? $_POST['name'] : '';
        $pageIndex = 0;
        $pageSize = 100;
        if(trim($this->getRequest()->getParam("course_id")) != ''){
            //delete
            Core_MysqlStatistic::getInstance()->deleteSubject(trim($this->getRequest()->getParam("course_id")));
        }
        $data = Core_MysqlStatistic::getInstance()->getListSubjectWithPaging($title,$teacherName,$pageIndex,$pageSize);
//        echo '<pre>';
//        print_r($data);die;
        $this->render('course', array(
            'data' =>$data,
            'title' => $title,
            'name' =>$teacherName
        ));
    }
    
}