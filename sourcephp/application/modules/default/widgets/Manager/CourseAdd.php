<?php

class Widget_Manager_CourseAdd extends Core_Widget
{

    public function run()
    {
        $isLogin = true;
        $listsubjects = '';
        $creatby = 'thuatnv';
        if ($isLogin) {
            $subjectId = $this->getRequest()->getParam('subid');

            $lsTeachers = Core_MysqlStatistic::getInstance()->getListTeacherActive();
            if (empty($_POST)) {
                if (isset($subjectId) && $subjectId > 0)
                    $dataSubject = Core_MysqlStatistic::getInstance()->getSubjectById($subjectId);
//                echo '<pre>';
//                print_r($dataSubject);
                $this->render('courseadd', array(
                    'lsTeachers' => $lsTeachers,
                    'dataget' => $dataSubject[0],
                    'id' => $subjectId
                ));
            } else {
//                echo '<pre>';
//                var_dump($_POST);
//                die;
                $datapost = array();
                $id = isset($_POST['id']) ? $_POST['id'] : 0;
                $datapost["title"] = isset($_POST['title']) ? $_POST['title'] : '';
                $datapost["description"] = isset($_POST['description']) ? $_POST['description'] : '';
                $datapost["subject_payment_type"] = isset($_POST['subject_payment_type']) ? $_POST['subject_payment_type'] : '';
                $datapost["subject_type"] = isset($_POST['subject_type']) ? $_POST['subject_type'] : '';
                if (isset($_POST['fromdate'])) {
//                    $dt = DateTime::createFromFormat('d/m/Y', $_POST['fromdate']);
//                    date("Y-m-d H:i:s",strtotime($_POST['fromdate']);
                    $fDate = str_replace('/', '-',$_POST['fromdate']);
                    $datapost["fromdate"] = date("Y-m-d",strtotime($fDate));
                }
                if (isset($_POST['todate'])) {
//                    $dt = DateTime::createFromFormat('d/m/Y', $_POST['todate']);
                    $tDate = str_replace('/', '-',$_POST['todate']);
                    $datapost["todate"] = date("Y-m-d",strtotime($tDate));
                }

                if (isset($_POST['timelearning'])) {
                    $timelearning = '';
                    $dTime = $_POST['timelearning'];
                    for ($i = 0; $i < count($dTime); $i++) {
                        if ($i != count($dTime) && $i > 0)
                            $timelearning .= ',';
                        $timelearning .= $dTime[$i];
                    }
                    $datapost["timelearning"] = $timelearning;
                }
                $datapost["fromhours"] = isset($_POST['fromhours']) ? $_POST['fromhours'] : '';
                $datapost["tohours"] = isset($_POST['tohours']) ? $_POST['tohours'] : '';
                $datapost["teacher_id"] = isset($_POST['teachers']) ? $_POST['teachers'] : 0;
                $datapost["money_total"] = isset($_POST['money_total']) ? $_POST['money_total'] : 0;
                $datapost["money_percent_for_teacher"] = isset($_POST['money_percent_for_teacher']) ? $_POST['money_percent_for_teacher'] : 0;
                $datapost["payment_type"] = isset($_POST['payment_type']) ? $_POST['payment_type'] : 0;
                $datapost["phase"] = isset($_POST['phase']) ? $_POST['phase'] : 0;
                $datapost["isactive"] = isset($_POST['isactive']) ? $_POST['isactive'] : 0;
                $datapost["is_support_old_student"] = isset($_POST['is_support_old_student']) ? $_POST['is_support_old_student'] : 0;
                $dataDetail = array("payment_onetime_hidden" => isset($_POST['payment_onetime_hidden'])?$_POST['payment_onetime_hidden']: null,
                    "payment_onetime" => isset($_POST['payment_onetime'])?$_POST['payment_onetime']: null,
                    "payment_month_hidden" => isset($_POST['payment_month_hidden'])?$_POST['payment_month_hidden']: null,
                    "payment_month" => isset($_POST['payment_month'])?$_POST['payment_month']: null,
                    "payment_phase_hidden" => isset($_POST['payment_phase_hidden'])?$_POST['payment_phase_hidden']: null,
                    "payment_phase" => isset($_POST['payment_phase'])?$_POST['payment_phase']: null);
//                echo '<pre>';
//                print_r($dataDetail);die;
                $result = Core_MysqlStatistic::getInstance()->insertSubject($datapost, $dataDetail,$id);
                $url = '/them-khoa-hoc.html';
                $this->forward($url);

            }
        } else {

        }
    }

}
