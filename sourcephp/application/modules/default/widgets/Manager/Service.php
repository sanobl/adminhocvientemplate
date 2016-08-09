<?php

/**
 * Created by PhpStorm.
 * User: bangnk
 * Date: 8/9/16
 * Time: 11:16 AM
 */
class Widget_Manager_Service extends Core_Widget
{
    public function run(){
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $pageIndex = 0;
        $pageSize = 100;
        if(trim($this->getRequest()->getParam("course_id")) != ''){
            //delete
            Core_MysqlStatistic::getInstance()->deleteSubject(trim($this->getRequest()->getParam("course_id")));
        }
        $data = Core_MysqlStatistic::getInstance()->getListServiceWithPaging($title,$pageIndex,$pageSize);
//        print_r($data);
        $this->render('service_list', array(
            'data' =>$data,
            'title' => $title
        ));
    }

}