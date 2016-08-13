<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        //echo 'ffff';die;
    }


    public function getinfocourseAction()
    {
        $courseid = intval($this->_request->getParam('id'));
        $is_old_student = intval($this->_request->getParam('is_old_student'));
        $student_id = intval($this->_request->getParam('student_id'));
        $service = intval($this->_request->getParam('service'));
        $is_old_student = intval($this->_request->getParam('is_old_student'));
        $result = null;
        $result = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid($courseid);
//        print_r($result);die;
        $html = '';
        $time = '';
        $datatecher = array();
        $teacherresult = null;
        $teachername = '';
//       var_dump($result);
        if (is_array($result) && count($result) > 0) {
            $teacherid = 0;// isset($result[0]['teacher_id']) ? $result[0]['teacher_id'] : 0;
            if ($teacherid > 0) {
                $datatecher[] = $teacherid;
                $teacherresult = Core_MySQLManagerStudent::getInstance()->getteacherbyid($datatecher);
//                var_dump($teacherresult);die;
                if (is_array($teacherresult) && count($teacherresult) > 0) {
                    $teachername = $teacherresult[0]['name'];
                }
            }


//            if (isset($result[0]["timelearning"]) && !empty($result[0]["timelearning"]))
//                $time = Core_Utilities::convertListDayToVN($result[0]["timelearning"]);
//
//            if (isset($result[0]["fromhours"]) && isset($result[0]["tohours"])) {
//                $time .= '(' . $result[0]["fromhours"] . '-' . $result[0]["tohours"] . ')';
//            }
            $subjectClass = Core_MySQLManagerStudent::getInstance()->getsubjectsClassBySubjectId($courseid);
            $studentdetail = Core_MySQLManagerStudent::getInstance()->getstudentbyid($student_id);
            $subject_class_id = 0;
            if (isset($studentdetail) && count($studentdetail)) {
                $subject_class_id = $studentdetail[0]['subject_class_id'];
            }
            $money_percent_for_old_student = intval($result[0]['money_percent_for_old_student']);

            $totalpayment = isset($result[0]['money_total']) ? $result[0]['money_total'] : '';
            $paymentdetail = 0;
//            var_dump($money_percent_for_old_student > 0);
//            var_dump($is_old_student == 1);
//            print_r($money_percent_for_old_student);
//            print_r($is_old_student);
//            echo '<pre>';
            if ($money_percent_for_old_student > 0 && $is_old_student == 1) {
//                $tmp = $money_percent_for_old_student * $totalpayment;
////                print_r($tmp);
//                $tmp2 = $tmp/100;
////                print_r($tmp2);
                $paymentdetail = round(($money_percent_for_old_student * $totalpayment) / 100);
                $paymentdetail = $totalpayment - $paymentdetail;
            }
//            print_r($paymentdetail);die;
            if ($totalpayment != '' || $time != '' || $teachername != '') {
//                $html = '<div id="khoahocinfo">
//                    <div class="control-group">
//                    <label class="control-label">Giáo viên</label>
//                    <div class="controls" style="padding-top:5px"> ' . $teachername . '</div>
//                    </div>
//            <div class="control-group">
//                    <label class="control-label">Thời gian học</label>
//                    <div class="controls" style="padding-top:5px"> ' . $time . '</div>
//                    </div>';
                $html = '';
                if ($service != 1) {
                    if (isset($subjectClass) && count($subjectClass) > 0) {
                        $i = 0;
                        foreach ($subjectClass as $item) {
                            $checked = '';
                            if ($subject_class_id == $item['id'])
                                $checked = 'checked=checked';
                            if ($i == 0) {
                                $html .= ' <div class="control-group">';
                                $html .= '<label class="control-label">Thời gian học<span class="f_req">*</span></label>';
                                $html .= ' <div class="controls" style="padding-top:5px">';
                                $html .= '<input type="radio" style="margin-top: 0px;" name="subject_class_id" value="' . $item['id'] . '" ' . $checked . '/>';
                                $html .= '<strong style="margin-left:10px;font-weight: 400;">' . Core_Utilities::convertListDayToVN($item['timelearning']) . ' - ' . $item['fromhours'] . '->' .
                                    $item['tohours'] . ' - ' . $item['teacher_name'] . '</strong>';
                                $html .= '</div>';
                                $html .= '</div>';
                            } else {
                                $html .= ' <div class="control-group">';
                                $html .= '<label class="control-label"></label>';
                                $html .= ' <div class="controls" style="padding-top:5px">';
                                $html .= '<input type="radio" style="margin-top: 0px;" name="subject_class_id" value="' . $item['id'] . '" ' . $checked . '/>';
//                                echo $item['timelearning'];
                                $html .= '<strong style="margin-left:10px;font-weight: 400;">' . Core_Utilities::convertListDayToVN($item['timelearning']) . ' - ' . $item['fromhours'] . '->' .
                                    $item['tohours'] . ' - ' . $item['teacher_name'] . '</strong>';
                                $html .= '</div>';
                                $html .= '</div>';

                            }
                            $i++;
                        }
                        $html .= '<div class="control-group" id="TimeLearningError" style="display: none;"><label class="control-label"></label> <div class="controls" style="padding-top:5px"><label generated="true" class="error" id="error" style="color: red;">Vui lòng chọn</label></div></div>';
                        $html .= '';
                    }
                }
                if ($result[0]['payment_type'] == 2) {
                    $html .= '
            <div clascontrol-group"> 
                    <label class="control-label">Số tiền/tháng(VNĐ)</label>
             <div class="controls" style="padding-top:5px"> ';

                    if ($paymentdetail > 0) {
                        $html .= number_format($totalpayment, 0, '.', '.') . ' VNĐ - Số tiền đã giảm (' . $money_percent_for_old_student . '%): ' . number_format($paymentdetail, 0, '.', '.');
                    } else
                        $html .= number_format($totalpayment, 0, '.', '.');
                    $html .= ' VNĐ</div> 
                    </div>';
                } else {
                    $html .= '
            <div class="control-group"> 
                    <label class="control-label">Số tiền/khoá(VNĐ)</label>
             <div class="controls" style="padding-top:5px"> ' . number_format($totalpayment, 0, '.', '.') . ' VNĐ</div> 
                    </div>';
                }
//                if ($is_old_student == 1)
//                    $htmlCheck = 'checked="checked"';
//                if ($result[0]['is_support_old_student'] == 1) {
//                    $html .= '<div class="control-group">
//                                            <label class="control-label">Hỗ trợ học viên cũ </label>
//  <div class="controls">
//                    <div class="span12">
//
//                                                <input name="is_old_student" value="1" type="checkbox" ' . $htmlCheck . '>';
//                    $html .= '</div></div>
//
//                                        </div>';
//                }
//                if ($result[0]['subject_type'] == 1) {
//                    $html .= '<div class="control-group">
//                                            <label class="control-label">Khoá học </label>
//                                             <div class="controls" style="padding-top:5px"> ngắn hạn </div>
//
//                                        </div>';
//                } else if ($result[0]['subject_type'] == 2) {
//                    $html .= '<div class="control-group">
//                                            <label class="control-label">Khoá học </label>
//                                             <div class="controls" style="padding-top:5px"> dài hạn </div>
//
//                                        </div>';
//                }
//                if ($result[0]['payment_type'] == 2) {
//
//                } else {
//                    $html .= '<div class="control-group">
//                    <label class="control-label">Hình thức thanh toán</label>
//                    <div class="controls">
//                    <div class="span12">
//                    <label class="checkbox inline">
//                    <input type="radio" name="payment_type" value="1"> Đóng 1 lần </label>
//                    <label class="checkbox inline">
//                    <input type="radio" name="payment_type" value="2">  Theo tháng  </label>
//                    <label class="checkbox inline">
//                    <input type="radio" name="payment_type" value="3"> Theo đợt </label>
//                    </div>
//                    </div>
//                    </div>
//                    </div>';
//                }
            } else {
                $html = '<div class="control-group">Chưa có thông tin khóa học</div>';
            }

            echo $html;
            die;
        }

    }

    public function paymenttypedetailAction()
    {
        $courseid = intval($this->_request->getParam('id'));
        $paymenttype = intval($this->_request->getParam('type'));
        $formdate = '';
        $todate = '';
        $money_total = '';
        $timedate = '';
        $result = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid($courseid);
        $html = '';
        if (is_array($result) && count($result) > 0) {
            $money_total = ($result[0]["money_total"] != '') ? $result[0]["money_total"] : 0;
            switch ($paymenttype) {
                case '2':
                    if (isset($result[0]["fromdate"]) && $result[0]["fromdate"] != null) {
                        $formdate = $result[0]["fromdate"];
                    }
                    if (isset($result[0]["todate"]) && $result[0]["todate"] != null) {
                        $todate = $result[0]["todate"];
                    }

                    if ($formdate != '' && $todate != '') {
                        $ts1 = strtotime($formdate);
                        $ts2 = strtotime($todate);

                        $year1 = date('Y', $ts1);
                        $year2 = date('Y', $ts2);

                        $month1 = date('m', $ts1);
                        $month2 = date('m', $ts2);
                        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

                        $html = '<div class="control-group"> <label class="control-label"> </label> <div class="controls"><div class="span12">';

                        if ($diff > 0) {
                            $moneyonmonth = $money_total / ($diff + 1);
                            $months = 0;
                            $html .= '<label class="checkbox inline">  <input type="checkbox"> T' . $month1 . '/' . $year1 . ' - ' . $moneyonmonth . ' VNĐ</label>';
                            while ($months < $diff) {
                                $months++;
                                $datetmp = strtotime('+ ' . $months . ' MONTH', $ts1);
                                $monthtmp = date('m', $datetmp);
                                $yeartmp = date('Y', $datetmp);
                                $html .= '<label class="checkbox inline">  <input type="checkbox"> T' . $monthtmp . '/' . $yeartmp . ' - ' . $moneyonmonth . ' VNĐ</label>';
                            }
                        } else {
                            $moneyonmonth = $money_total;
                            $html .= '<label class="checkbox inline">  <input type="checkbox"> T' . $month1 . '/' . $year1 . ' - ' . $moneyonmonth . ' VNĐ</label>';
                        }
                        $html .= '</div></div>';

                    }
                    break;
                case '3':

                    break;

            }
        }
        echo $html;
        die;
    }

    public function excelAction()
    {
        $output = '<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
</head>
<style>.xlText { mso-number-format: "\@"; } th,td { border:solid 0.1pt #000000; }body { border:solid 0.1pt #000000; }</style>';
        $output .= '  
                <table class="table">  <THEAD>
                     <tr>  
                          <th>Id</th>  
                          <th>First Name</th>  
                          <th>Last Name</th>  
                     </tr>  </THEAD>
                     <TBODY>
                      <tr>  
                          <th>1</th>  
                          <th>First Name</th>  
                          <th>Last Name</th>  
                     </tr>  </TBODY>

           ';

        $output .= '</table>';
//        header("Content-Type: application/xlsx");
//        header("Content-Disposition: attachment; filename=download.xlsx");
//        header("Content-Type: application/vnd.ms-excel;");
//        header("Content-Disposition: attachment; filename=reports.xls");
//        header("Pragma: no-cache");
//        header("Expires: 0");
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=card-history-reports.xls");
//        header("Pragma: no-cache");
//        header("Expires: 0");
        echo $output;
        die;
    }

    public function insertbillAction()
    {
//        $created_by = 'thuatnv';
        session_start();
        $created_by = $_SESSION['name'];
        $student_fullname = trim($this->_request->getParam('student_fullname'));
        $student_id = trim($this->_request->getParam('student_id'));
        $subjecttitle = trim($this->_request->getParam('subjecttitle'));
        $subject_id = trim($this->_request->getParam('subject_id'));
        $money = trim($this->_request->getParam('money'));
        $service = trim($this->_request->getParam('service'));
        $content = trim($this->_request->getParam('content'));
        $address = trim($this->_request->getParam('address'));
        if ($money != 0) {
            $money = str_replace(".", "", $money);
        }
        $idCode = '';
        try {
            if ($service == 1) { // process dich vu
                $idCode = Core_MySQLManagerStudent::getInstance()->insertBillCodeService();
                if ($idCode > 0) {

                    $dataBill = array();
                    $idCode = $dataBill['bill_code'] = str_pad($idCode, 6, '0', STR_PAD_LEFT);
                    $dataBill['student_id'] = $student_id;
                    $dataBill['money'] = $money;
                    $dataBill['created_by'] = $created_by;
                    $dataBill['is_status'] = 0;
                    $dataBill['subject_id'] = $subject_id;
                    $dataBill['content'] = $content;
                    $dataBill['address'] = $address;
                    $dataBill['isservice'] = 1;
                    $student_bill_id = Core_MySQLManagerStudent::getInstance()->insertStudentBillService($dataBill);
                }
            } else { //process dang ky hoc
                $idCode = Core_MySQLManagerStudent::getInstance()->insertBillCode1();
                if ($idCode > 0) {

                    $dataBill = array();
                    $idCode = $dataBill['bill_code'] = str_pad($idCode, 6, '0', STR_PAD_LEFT);
                    $dataBill['student_id'] = $student_id;
                    $dataBill['money'] = $money;
                    $dataBill['created_by'] = $created_by;
                    $dataBill['is_status'] = 0;
                    $dataBill['subject_id'] = $subject_id;
                    $dataBill['content'] = $content;
                    $dataBill['address'] = $address;
                    $dataBill['isservice'] = 0;
                    $student_bill_id = Core_MySQLManagerStudent::getInstance()->insertNewBill($dataBill);
                }
            }

        } catch (Exception $exc) {

        }


        echo $idCode.'-'.$student_bill_id;
        die;
    }

    public function updatebillAction()
    {
//        $created_by = 'thuatnv';
        session_start();
        $created_by = $_SESSION['name'];
        $student_fullname = trim($this->_request->getParam('student_fullname'));
        $content = trim($this->_request->getParam('content'));
        $address = trim($this->_request->getParam('address'));
        $money = trim($this->_request->getParam('money_total'));
        $student_bill_id = intval($this->_request->getParam('student_bill_id'));
        if ($money != 0) {
            $money = str_replace(".", "", $money);
        }
        $idCode = 0;
        try {
            $dataBill = array();
            $dataBill['money'] = $money;
            $dataBill['created_by'] = $created_by;
            $dataBill['is_status'] = 1;
            $dataBill['content'] = $content;
            $dataBill['isservice'] = 0;
            $dataBill['isdelete'] = 0;
            $dataBill['address'] = $address;
            $idCode = Core_MySQLManagerStudent::getInstance()->updateStudentBill($dataBill, $student_bill_id);

        } catch (Exception $exc) {

        }


        echo $idCode;
        die;
    }

    public function deletebillAction()
    {
//        $created_by = 'thuatnv';
        session_start();
        $created_by = $_SESSION['name'];
        $student_bill_id = intval($this->_request->getParam('student_bill_id'));
//        if ($money != 0) {
//            $money = str_replace(".", "", $money);
//        }
        $idCode = 0;
        try {
            $dataBill = array();
            $dataBill['isdelete'] = 1;
            $idCode = Core_MySQLManagerStudent::getInstance()->updateStudentBillIsDelete($dataBill, $student_bill_id);

        } catch (Exception $exc) {

        }
        echo $idCode;
        die;
    }
}

?>