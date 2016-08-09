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
            $totalpayment = isset($result[0]['money_total']) ? $result[0]['money_total'] : '';
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
                if (isset($subjectClass) && count($subjectClass) > 0) {
                    $i = 0;
                    foreach ($subjectClass as $item) {
                        if ($i == 0) {
                            $html .= ' <div class="control-group">';
                            $html .= '<label class="control-label">Thời gian học</label>';
                            $html .= ' <div class="controls" style="padding-top:5px">';
                            $html .= '<input type="radio" name="subject_class_id" value="' . $item['id'] . '" />';
                            $html .= Core_Utilities::convertListDayToVN($item['timelearning']) . '-' . $item['fromhours'] . '->' .
                                $item['tohours'] . '-' . $item['teacher_name'];
                            $html .= '</div>';
                            $html .= '</div>';
                        } else {
                            $html .= ' <div class="control-group">';
                            $html .= '<label class="control-label"></label>';
                            $html .= ' <div class="controls" style="padding-top:5px">';
                            $html .= '<input type="radio" name="subject_class_id" value="' . $item['id'] . '" />';
                            $html .= Core_Utilities::convertListDayToVN($item['timelearning']) . '-' . $item['fromhours'] . '->' .
                                $item['tohours'] . '-' . $item['teacher_name'];
                            $html .= '</div>';
                            $html .= '</div>';
                        }
                        $i++;
                    }
                }
                if ($result[0]['payment_type'] == 2) {
                    $html .= '
            <div clascontrol-group"> 
                    <label class="control-label">Số tiền/tháng(VNĐ)</label>
             <div class="controls" style="padding-top:5px"> ' . $totalpayment . ' VNĐ</div> 
                    </div>';
                } else {
                    $html .= '
            <div class="control-group"> 
                    <label class="control-label">Số tiền/khoá(VNĐ)</label>
             <div class="controls" style="padding-top:5px"> ' . $totalpayment . ' VNĐ</div> 
                    </div>';
                }
                if ($is_old_student == 1)
                    $htmlCheck = 'checked="checked"';
                if ($result[0]['is_support_old_student'] == 1) {
                    $html .= '<div class="control-group">
                                            <label class="control-label">Hỗ trợ học viên cũ </label>
  <div class="controls"> 
                    <div class="span12">
                                           
                                                <input name="is_old_student" value="1" type="checkbox" ' . $htmlCheck . '>';
                    $html .= '</div></div>
                                               
                                        </div>';
                }
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
                if ($result[0]['payment_type'] == 2) {

                } else {
                    $html .= '<div class="control-group">
                    <label class="control-label">Hình thức thanh toán</label> 
                    <div class="controls"> 
                    <div class="span12">
                    <label class="checkbox inline"> 
                    <input type="radio" name="payment_type" value="1"> Đóng 1 lần </label>
                    <label class="checkbox inline">    
                    <input type="radio" name="payment_type" value="2">  Theo tháng  </label>
                    <label class="checkbox inline"> 
                    <input type="radio" name="payment_type" value="3"> Theo đợt </label>  
                    </div>  
                    </div>  
                    </div>
                    </div>';
                }
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

}

?>