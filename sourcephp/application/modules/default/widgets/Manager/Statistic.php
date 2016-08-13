<?php
class Widget_Manager_Statistic extends Core_Widget{

    public function run(){
        $isadmin = $_SESSION['isadmin'];
        if ($isadmin != 1)
        {
            $this->forward("/quan-ly-hoc-vien.html");
        }
        $typeShowData = isset($_POST['typeshowdata']) ? $_POST['typeshowdata'] : 0;
        $subjectId = isset($_POST['subject']) ? $_POST['subject'] : 0;
        $teacherId = isset($_POST['teacher']) ? $_POST['teacher'] : 0;
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $timeValue = isset($_POST[$time]) ? $_POST[$time] : '';
        $user = isset($_POST['user']) ? $_POST['user'] : '';
        $lsSubjects = Core_MysqlStatistic::getInstance()->getListSubject();
        $lsTeachers = Core_MysqlStatistic::getInstance()->getListTeacher();
        $lsData = null;
        if (!empty($_POST)) {
            if ($typeShowData == 1)
                $lsData = Core_MysqlStatistic::getInstance()->getTechcherSalaryOnMonth('2016-08-02');
            else if ($typeShowData == 2)
                $lsData = Core_MysqlStatistic::getInstance()->getHoaDon('2016-08-02');
        }
//        echo '<pre>';
//        print_r($lsData);die;
        $this->render('statistic', array(
            'lsSubjects' => $lsSubjects,
            'lsTeachers' => $lsTeachers,
            'subjectId' => $subjectId,
            'teacherId' =>$teacherId,
            'time' => $time,
            'timeValue' =>$timeValue,
            'user' =>$user,
            'lsData' => $lsData,
            'typeShowData' => $typeShowData
        ));
    }

}