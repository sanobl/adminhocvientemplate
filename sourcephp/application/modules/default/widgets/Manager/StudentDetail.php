<?php
class Widget_Manager_StudentDetail extends Core_Widget{
    
    public function run(){
        $isLogin = true;
        $studentid = intval($this->getRequest()->getParam("index1"));
        $isprint = intval($this->getRequest()->getParam("index2"));
        $service = intval($this->getRequest()->getParam("service"));
        $resultsubject = '';
        $studentdetail = '';
        $student_fullname = '';
        $student_fullname = '';
        $student_phone = '';
        $student_email = '';
        $parent_fullname = '';
        $parent_phone = '';
        $parent_email = '';
        $subject_id = '';
        $payment_type = '';
        $teachername = '';
        $subjectname = '';
        $money_total = '';
        $money_convert = '';
        $time = '';
        $haserror = false;
        $mess = '';
        $subject_class_id = 0;
        $money_detail = 0;
        $money_percent_for_teacher = 0;
        $money_of_teacher=0;
        $money_percent_for_old_student = 0;
        $fullname_agent = $_SESSION['full_name'];
        $listbillosstudent= '';
        if($isLogin){
            if($studentid != 0){
                $studentdetail = Core_MySQLManagerStudent::getInstance()->getstudentbyid($studentid);

                if(is_array($studentdetail) && count($studentdetail) > 0){
                    //echo json_encode($studentdetail);die;
                    $studentdetail = $studentdetail[0];
                    $student_fullname = $studentdetail['student_fullname'];
                    $student_phone = $studentdetail['student_phone'];
                    $student_email = $studentdetail['student_email'];
                    $parent_fullname = $studentdetail['parent_fullname'];
                    $parent_phone = $studentdetail['parent_phone'];
                    $parent_email = $studentdetail['parent_email'];
                    $subject_id = $studentdetail['subject_id'];
                    $payment_type = $studentdetail['payment_type'];
                    $subject_class_id = $studentdetail['subject_class_id'];
                    $money_detail = $studentdetail['money_detail'];
                    $money_percent_for_teacher = $studentdetail['money_percent_for_teacher'];
                    $money_of_teacher = $studentdetail['money_of_teacher'];
                    $money_percent_for_old_student = $studentdetail['money_percent_for_old_student'];
//                    $teachername = $studentdetail['name'];
                    $subjectname = $studentdetail['title'];
                    $money_total = $studentdetail['money_total'];
                    $money_convert = Core_Utilities::convert_number_to_words($money_total);
                    $resultsubject = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid($subject_id);
                    $subjectClass= Core_MySQLManagerStudent::getInstance()->getsubjectsClassBySubjectId($subject_id);
                    
                    $listbillosstudent = Core_MySQLManagerStudent::getInstance()->getbillofstudent($studentid);
//                    var_dump($listbillosstudent);die;
                    if(is_array($resultsubject) && count($resultsubject)>0){
                        if(isset($resultsubject[0]["monday"]) && $resultsubject[0]["monday"]!= null){
                            $time .= 'Thứ Hai, ';
                        }
                        if(isset($resultsubject[0]["tuesday"]) && $resultsubject[0]["tuesday"]!= null){
                            $time .= 'Thứ Ba, ';
                        }
                        if(isset($resultsubject[0]["wednesday"]) && $resultsubject[0]["wednesday"]!= null){
                            $time .= 'Thứ Tư, ';
                        }
                        if(isset($resultsubject[0]["thursday"]) && $resultsubject[0]["thursday"]!= null){
                            $time .= 'Thứ Năm, ';
                        }
                        if(isset($resultsubject[0]["friday"]) && $resultsubject[0]["friday"]!= null){
                            $time .= 'Thứ Sáu, ';
                        }
                        if(isset($resultsubject[0]["saturday"]) && $resultsubject[0]["saturday"]!= null){
                            $time .= 'Thứ Bảy, ';
                        }
                        if(isset($resultsubject[0]["sunday"]) && $resultsubject[0]["sunday"]!= null){
                            $time .= 'Chủ Nhật';
                        }
                        if(isset($result[0]["fromhours"]) && isset($result[0]["tohours"])){
                            $time .= '('.$result[0]["fromhours"] .'-'. $result[0]["tohours"].')';
                        }
                    }
            }else {
                $haserror = true;
                $mess = 'Không có dữ liệu học viên hoặc có lỗi trong quá trình tải.';
            }
                
            }else {
                $haserror = true;
                $mess = 'Chưa chọn học viên cần truy vấn thông tin.';
            }
        }
        $addressprint = '';
        if ($service == 1)
        {
            $addressprint = $student_phone;
        }
        else
        {
            $addressprint = $parent_phone;
        }
        return $this->render('studentdetail', array(
            'haserror'=>$haserror,
            'mess'=>$mess,
            'student_fullname'=>$student_fullname,
            'student_phone'=>$student_phone,
            'student_email'=>$student_email,
            'parent_fullname'=>$parent_fullname,
            'parent_phone'=>$parent_phone,
            'parent_email'=>$parent_email,
            'subject_id'=>$subject_id,
            'payment_type'=>$payment_type,
            'teachername'=>$teachername,
            'subjectname'=>$subjectname,
            'money_total'=>$money_total,
            'studentid'=>$studentid,
            'time' => $time,
            'isprint'=> $isprint,
            'money_convert'=>$money_convert,
            'subjectClass'=>$subjectClass,
            'listbill'=> $listbillosstudent,
            'subject_class_id'=>$subject_class_id,
            'fullname_agent' =>$fullname_agent,
            'service' =>$service,
            'money_percent_for_old_student'=>$money_percent_for_old_student,
            'money_percent_for_teacher'=>$money_percent_for_teacher,
            'money_of_teacher' =>$money_of_teacher,
            'money_detail'=>$money_detail,
            'address_print' =>$addressprint
        ));
        
         
    }
    
}