<?php

class Widget_Manager_StudentAdd extends Core_Widget
{

    public function run()
    {
        $isLogin = true;
        $listsubjects = '';
//        session_start();
        $createdby = $_SESSION['name'];
//        $createdby = 'thuatnv';
        $studentdetail = '';
        if ($isLogin) {

            $studentid = intval($this->getRequest()->getParam("index1"));
            $service = intval($this->getRequest()->getParam("service"));
            $listsubjects = Core_MySQLManagerStudent::getInstance()->getlistsubjects($service);
            if (empty($_POST)) {
                $student_fullname = '';
                $student_fullname = '';
                $student_phone = '';
                $student_email = '';
                $parent_fullname = '';
                $parent_phone = '';
                $parent_email = '';
                $subject_id = '';
                $payment_type = '';
                $subject_class_id = 0;
                $is_old_student = 0;
                if ($studentid != 0) {
                    $studentdetail = Core_MySQLManagerStudent::getInstance()->getstudentbyid($studentid);
                    if (is_array($studentdetail) && count($studentdetail) > 0) {
                        $studentdetail = $studentdetail[0];
                        $student_fullname = $studentdetail['student_fullname'];
                        $student_phone = $studentdetail['student_phone'];
                        $student_email = $studentdetail['student_email'];
                        $parent_fullname = $studentdetail['parent_fullname'];
                        $parent_phone = $studentdetail['parent_phone'];
                        $parent_email = $studentdetail['parent_email'];
                        $subject_id = $studentdetail['subject_id'];
                        $payment_type = $studentdetail['payment_type'];
                        $is_old_student = $studentdetail['is_old_student'];
                        $subject_class_id = $studentdetail['subject_class_id'];
                    }

                }
                $this->render('studentadd', array(
                    'listsubjects' => $listsubjects,
                    'student_fullname' => $student_fullname,
                    'student_phone' => $student_phone,
                    'student_email' => $student_email,
                    'parent_fullname' => $parent_fullname,
                    'parent_phone' => $parent_phone,
                    'parent_email' => $parent_email,
                    'subject_id' => $subject_id,
                    'payment_type' => $payment_type,
                    'is_old_student' => $is_old_student,
                    'subject_class_id' => $subject_class_id,
                    'student_id' => $studentid,
                    'service' => $service
                ));
            } else {
//                echo '<pre>';
//                print_r(json_encode($_POST));die;
                $datapost = array();
                $teacher_id = 0;
                $timel_learning = '';
                $fromhours = '';
                $tohours = '';
                $money_total = 0;
                $money_percent_for_teacher = 0;
                $money_percent_for_old_student = 0;
                $subject_title= '';
                $student_fullname = isset($_POST['student_fullname']) ? $_POST['student_fullname'] : '';
                $student_phone = isset($_POST['student_phone']) ? $_POST['student_phone'] : '';
                $student_email = isset($_POST['student_email']) ? $_POST['student_email'] : '';
                $parent_fullname = isset($_POST['parent_fullname']) ? $_POST['parent_fullname'] : '';
                $parent_phone = isset($_POST['parent_phone']) ? $_POST['parent_phone'] : '';
                $parent_email = isset($_POST['parent_email']) ? $_POST['parent_email'] : '';
                $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : 0;
                $subject_class_id = isset($_POST['subject_class_id']) ? $_POST['subject_class_id'] : 0;
                $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
                $is_old_student = isset($_POST['is_old_student']) ? $_POST['is_old_student'] : 0;
                if ($_POST['subject_id'] != '') {
                    if ($service == 1){
                        $subjectsdetail = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid(intval($subject_id));

                    }
                    else {
                        $subjectsdetail = Core_MySQLManagerStudent::getInstance()->getsubjectsWithClassDetailBySubjectClassId(intval($subject_class_id));
                    }
                    if ($subjectsdetail != '' && is_array($subjectsdetail)) {
                        $subjectsdetail = $subjectsdetail[0];
                        $teacher_id = $subjectsdetail['teacher_id'];
                        $money_total = $subjectsdetail['money_total'];
                        $subject_title = $subjectsdetail['title'];
                        if ($service != 1) {
                            $timel_learning = $subjectsdetail['timelearning'];
                            $fromhours = $subjectsdetail['fromhours'];
                            $tohours = $subjectsdetail['tohours'];
                            $money_percent_for_teacher = $subjectsdetail['money_percent_for_teacher'];
                            $money_percent_for_old_student = $subjectsdetail['money_percent_for_old_student'];
                        }
                    }
                }
                $paymentdetail = 0;
                $money_of_teacher = 0;
                //tinh so tien hoc sinh phai dong va giao vien nhan duoc
                if ($is_old_student == 1)
                { // check dong mien giam hoc phi
                    $paymentdetail = round(($money_percent_for_old_student * $money_total) / 100);
                    $paymentdetail = $money_total - $paymentdetail;
                    $money_of_teacher = $paymentdetail;
                }
                else {
                    $paymentdetail = $money_total;
                    $money_of_teacher = round(($money_percent_for_teacher * $money_total) / 100);
                }
                $created_at = date("Y-m-d H:i:s");
                if ($studentid != 0) {

                    $result = Core_MySQLManagerStudent::getInstance()->updatestudent($student_fullname, $student_phone, $student_email,
                        $parent_fullname, $parent_phone, $parent_email,
                        $subject_id, $payment_type,
                        $money_total, $created_at, $createdby, $studentid, $is_old_student, $subject_class_id, $teacher_id
                        ,$money_percent_for_teacher,$money_percent_for_old_student,$paymentdetail,$money_of_teacher);
                } else {
                    $result = Core_MySQLManagerStudent::getInstance()->insertstudent2($student_fullname, $student_phone, $student_email,
                        $parent_fullname, $parent_phone, $parent_email,
                        $subject_id, $payment_type,
                        $money_total, $created_at, $createdby, $is_old_student, $subject_class_id, $teacher_id
                    ,$money_percent_for_teacher,$money_percent_for_old_student,$paymentdetail,$money_of_teacher);
                    if ($result > 0) { // process bill
                        $subject = Core_MySQLManagerStudent::getInstance()->getsubjectsbyid($subject_id);
                        if (isset($subject)) {
                            $subject_type = $subject[0]['subject_type'];
                            if ($subject_type == 2) //mon hoc dai han
                            {
                                if ($service != 1) { // process cho mon hoc
                                    //insert data vao table student_detail
                                    $dataDetail = array();
                                    $dataDetail['pay_period'] = date("m/Y");
                                    $dataDetail['pay_money'] = $paymentdetail;
                                    $dataDetail['pay_total'] = $money_total;
                                    $dataDetail['student_id'] = $result;
                                    $dataDetail['created_by'] = $createdby;
                                    $dataDetail['is_status'] = 0;
                                    $dataDetail['subject_id'] = $subject_id;

                                    //insert data vao table student_bill
                                    // createbuildcode
                                    $idCode = Core_MySQLManagerStudent::getInstance()->insertBillCode1();
                                    if ($idCode > 0) {
                                        $dataBill = array();
                                        $dataBill['bill_code'] = str_pad($idCode, 6, '0', STR_PAD_LEFT);
                                        $dataBill['student_id'] = $result;
                                        $dataBill['money'] = $paymentdetail;
                                        $dataBill['created_by'] = $createdby;
                                        $dataBill['is_status'] = 0;
                                        $dataBill['subject_id'] = $subject_id;
                                        $content = '';
                                        if (!empty($subject_title))
                                            $content .= $subject_title;
                                        if (!empty($timel_learning))
                                            $content .= ' - '.Core_Utilities::convertListDayToVN($timel_learning);
                                        if (!empty($fromhours))
                                            $content .= ' - '.$fromhours;
                                        if (!empty($tohours))
                                            $content .= '->'.$tohours;
                                        $content .= ' - T'.date("m/Y");
                                        $dataBill['content'] = $content;
                                        $dataBill['isservice'] = 0;
                                        $dataBill['address'] = $parent_phone;
                                        $dataBill['isdelete'] = 0;
                                        Core_MySQLManagerStudent::getInstance()->insertStudentDetail($dataDetail, $dataBill);
                                    } else { // error insert

                                    }
                                } else { //process hoa don cho dich vu
                                    // create build code
                                    $idCode = Core_MySQLManagerStudent::getInstance()->insertBillCodeService();

                                    if ($idCode > 0) {
                                        $dataBill = array();
                                        $dataBill['bill_code'] = str_pad($idCode, 6, '0', STR_PAD_LEFT);
                                        $dataBill['student_id'] = $result;
                                        $dataBill['money'] = $paymentdetail;
                                        $dataBill['created_by'] = $createdby;
                                        $dataBill['is_status'] = 0;
                                        $dataBill['subject_id'] = $subject_id;
                                        $dataBill['content'] = $subject_title.' - T'.date("m/Y");;
                                        $dataBill['isservice'] = 1;
                                        $dataBill['address'] = $student_phone;
                                        $dataBill['isdelete'] = 0;
                                        Core_MySQLManagerStudent::getInstance()->insertStudentBillService($dataBill);
                                    } else { // error insert

                                    }
                                }

                            } else if ($subject_type == 1) //mon hoc ngan han
                            {

                            }
                        }
                    }
                    if (isset($_POST['save_print']) && $_POST['save_print'] == 1) {
                        if ($result != '') {
                            $url = '/chi-tiet-hoc-vien_' . (intval($result)) . '.html?service=' . $service;
                            $this->forward($url);
                        } else {

                        }
                    }


                }
                if ($studentid > 0)
                {
                    $url = '/chi-tiet-hoc-vien_' . (intval($studentid)) . '.html?service=' . $service;
                    $this->forward($url);
                }

                $url = '/quan-ly-hoc-vien.html';
                $this->forward($url);

            }
        } else {

        }
    }

}
