<?php
class Widget_Manager_StudentDetail extends Core_Widget{
    
    public function run(){
        $isLogin = true;
        $studentid = intval($this->getRequest()->getParam("index1"));
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
        $haserror = false;
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
            'studentid'=>$studentid
        ));
        
         
    }
    
}