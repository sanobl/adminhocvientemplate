<?php

class Widget_Manager_ServiceAdd extends Core_Widget
{

    public function run()
    {
        $isadmin = $_SESSION['isadmin'];
        if ($isadmin != 1)
        {
            $this->forward("/quan-ly-hoc-vien.html");
        }
        $isLogin = true;
        $dataSubject[] = null;
        $dataSubjectClass = null;
        $listsubjects = '';
//        $creatby = 'thuatnv';
        session_start();
        $createdby = $_SESSION['name'];
        if ($isLogin) {
//            $subjectId = $this->getRequest()->getParam('subid');
            $subjectId = intval($this->getRequest()->getParam("subid"));
//            print_r($subjectId);
            if (empty($_POST)) {
                if (isset($subjectId) && $subjectId > 0) {
                    $dataSubject = Core_MysqlStatistic::getInstance()->getSubjectById($subjectId);
                }
                //echo '<pre>';
                //echo json_encode($dataSubjectClass);
                $this->render('service_add', array(
                    'dataget' => $dataSubject[0],
                    'id' => $subjectId
                ));
            } else {
                $datapost = array();
                $id = isset($_POST['id']) ? $_POST['id'] : 0;
                $datapost["title"] = isset($_POST['title']) ? $_POST['title'] : '';
                $datapost["description"] = isset($_POST['description']) ? $_POST['description'] : '';
                $datapost["subject_payment_type"] = 0;
                $datapost["subject_type"] = 2;
                $datapost["payment_type"] = 2;
                $money_total = isset($_POST['money_total']) ? $_POST['money_total'] : 0;
                if ($money_total != 0) {
//                    print_r('abcde'.$money_total);
//                    $tmp = intval($money_total);
//                    print_r($tmp);
                    $money_total = str_replace(".", "", $money_total);
//                    print_r('abcd'.$money_total);
                    $datapost["money_total"] = $money_total;
                }
//                else {
//                    print_r('abc'.$money_total);
//                }

//                $datapost["money_percent_for_teacher"] = isset($_POST['money_percent_for_teacher']) ? $_POST['money_percent_for_teacher'] : 0;

//                $datapost["phase"] = isset($_POST['phase']) ? $_POST['phase'] : 0;
                $datapost["isactive"] = isset($_POST['isactive']) ? $_POST['isactive'] : 0;
                $datapost["is_support_old_student"] = isset($_POST['is_support_old_student']) ? $_POST['is_support_old_student'] : 0;

                $dataClass = $_POST['class'];
                $result = Core_MysqlStatistic::getInstance()->insertService($datapost, $id);

                $url = '/quan-ly-dich-vu.html';
                $this->forward($url);

            }
        } else {

        }
    }

}
