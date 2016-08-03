<?php
class Widget_Manager_StudentDetail extends Core_Widget{
    
    public function run(){
        $isLogin = true;
        $studentid = intval($this->getRequest()->getParam("index1"));
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
        $time = '';
        $haserror = false;
        $mess = '';
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
                    $teachername = $studentdetail['name'];
                    $subjectname = $studentdetail['title'];
                    $money_total = $studentdetail['money_total'];
                    $resultsubject = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid($subject_id);
                    if(is_array($resultsubject) && count($resultsubject)>0){
                        if(isset($resultsubject[0]["monday"]) && $resultsubject[0]["monday"]!= null){
                            $time .= 'Hai, ';
                        }
                        if(isset($resultsubject[0]["tuesday"]) && $resultsubject[0]["tuesday"]!= null){
                            $time .= 'Ba, ';
                        }
                        if(isset($resultsubject[0]["wednesday"]) && $resultsubject[0]["wednesday"]!= null){
                            $time .= 'Tư, ';
                        }
                        if(isset($resultsubject[0]["thursday"]) && $resultsubject[0]["thursday"]!= null){
                            $time .= 'Năm, ';
                        }
                        if(isset($resultsubject[0]["friday"]) && $resultsubject[0]["friday"]!= null){
                            $time .= 'Sáu, ';
                        }
                        if(isset($resultsubject[0]["saturday"]) && $resultsubject[0]["saturday"]!= null){
                            $time .= 'Bảy, ';
                        }
                        if(isset($resultsubject[0]["sunday"]) && $resultsubject[0]["sunday"]!= null){
                            $time .= 'Chủ nhật';
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
            'time' => $time
        ));
        
         
    }
    
}