<?php
require_once('MysqliDb.php');

class Core_MySQLManagerStudent
{
    var $config;
    protected $_db;
    protected static $_instance = null;

    public function __construct()
    {
        $this->config = Core_Global::getApplicationIni()->app->static->mysql;
        //var_dump($this->config);die;
        $this->initialize();
    }

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    private function initialize()
    {
        try {
            if (empty($this->config->host) && empty($this->config->username) && empty($this->config->databasename)) {
                return false;
                //Zend_Cache::throwException('Redis \'server\' not specified.');
            }

            $this->_db = new MysqliDb (Array(
                'host' => $this->config->host,
                'username' => $this->config->username,
                'password' => $this->config->password,
                'db' => $this->config->databasename,
                'port' => 3306,
                'prefix' => '',
                'charset' => 'utf8'));
        } catch (Exception $e) {
            return false;
        }
    }

    public function demomysql()
    {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $users = $this->_db->rawQuery('SELECT * from students where id >= ?', Array(0));
        foreach ($users as $user) {
            print_r($user);
        }
        return $users;
    }

    public function getlistsubjects()
    {
        $this->_db = MysqliDb::getInstance();
        $listsubjects = $this->_db->rawQuery('SELECT id, title from subjects');

        return $listsubjects;
    }

    public function getliststudent()
    {
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('select st.id,st.student_fullname,s.title,t.`name`,st.`created_at`
 from `students` st inner join `subjects` s on st.subject_id = s.id
left join `subject_class` sc on st.`subject_class_id` = sc.id
left join `teachers` t on sc.teacher_id = t.id
order by s.id desc');
        return $result;
    }

    public function getstudentbyid($id)
    {
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('
            SELECT
                students.id,
                student_fullname,
                student_phone,
                student_email,
                parent_fullname,
                parent_phone,
                parent_email,
                is_old_student,
                students.subject_id,
                students.subject_class_id,
                students.money_total,
                students.money_detail,
                students.payment_type,
                students.created_at,
                students.updated_at,
                students.created_by,
                students.updated_by,
                subjects.title
              FROM
                students
              INNER JOIN
                subjects ON students.subject_id = subjects.id
              WHERE
                students.id = ?',
            array($id));
        return $result;
    }

    public function getlistteacher()
    {
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('SELECT `id`, `name` FROM `teachers` ');
        return $result;
    }

    public function getsubjectsbyid($data)
    {
        $this->_db = MysqliDb::getInstance();
        $sql = 'SELECT id, title,money_total,payment_type,fromdate,todate
        is_support_old_student,subject_type from subjects where id = ?';
        $listsubjects = $this->_db->rawQuery($sql, array($data));
        return $listsubjects;
    }

    public function getsubjectsClassBySubjectId($data)
    {
        $this->_db = MysqliDb::getInstance();
        $sql = 'select sc.id,sc.timelearning,sc.fromhours,sc.tohours,t.`name` as teacher_name,sc.teacher_id
from `subject_class` sc inner JOIN teachers t on t.id = sc.teacher_id where sc.subject_id =?';
        $listsubjects = $this->_db->rawQuery($sql, array($data));
        return $listsubjects;
    }

    public function getteacherbyid($data)
    {
        $this->_db = MysqliDb::getInstance();
        $listsubjects = $this->_db->rawQuery('SELECT id, name from teachers where id = ?', $data);
        //var_dump($listsubjects);die;
        return $listsubjects;
    }

    public function insertstudent($student_fullname, $student_phone, $student_email,
                                  $parent_fullname, $parent_phone, $parent_email, $subject_id, $teacher_id, $payment_type, $money_total, $created_at, $createdby)
    {
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('
                INSERT INTO `students` 
                    (`student_fullname`, 
                    `student_phone`, 
                    `student_email`, 
                    `parent_fullname`, 
                    `parent_phone`, 
                    `parent_email`,
                    `subject_id`,
                    `teacher_id`,
                    `payment_type`,
                    `money_total`,
                    `created_at`,
                    `created_by`
                    ) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)', array(
            $student_fullname,
            $student_phone,
            $student_email,
            $parent_fullname,
            $parent_phone,
            $parent_email,
            $subject_id,
            $teacher_id,
            $payment_type,
            $money_total,
            $created_at,
            $createdby
        ));
//        $id = $this->_db->insert ('students', $data);
//        if($id)
//            echo 'user was created. Id=' . $id;
//        else 
//            echo 'die';
    }

    public function insertstudent2($student_fullname, $student_phone, $student_email,
                                   $parent_fullname, $parent_phone, $parent_email, $subject_id, $payment_type, $money_total,
                                   $created_at, $createdby, $is_old_student, $subject_class_id,$teacher_id)
    {
        $this->_db = MysqliDb::getInstance();
        $data = Array("student_fullname" => $student_fullname,
            "student_phone" => $student_phone,
            "student_email" => $student_email,
            "parent_fullname" => $parent_fullname,
            "parent_phone" => $parent_phone,
            "parent_email" => $parent_email,
            "subject_id" => $subject_id,
            "payment_type" => $payment_type,
            "money_total" => $money_total,
            "created_at" => $created_at,
            "created_by" => $createdby,
            "is_old_student" => $is_old_student,
            "subject_class_id"=>$subject_class_id,
            "teacher_id" => $teacher_id
        );
        $id = $this->_db->insert('students', $data);
        if ($id)
            return $id;
        else
            return '';
//        $id = $this->_db->insert ('students', $data);
//        if($id)
//            echo 'user was created. Id=' . $id;
//        else 
//            echo 'die';
    }

    public function updatestudent($student_fullname, $student_phone, $student_email,
                                  $parent_fullname, $parent_phone, $parent_email, $subject_id, $payment_type,
                                  $money_total, $created_at, $createdby, $id, $is_old_student,$subject_class_id,$teacher_id)
    {
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('
                UPDATE
                    `students`
                SET
                    `student_fullname` = ?,
                    `student_phone` = ?,
                    `student_email` = ?,
                    `parent_fullname` = ?,
                    `parent_phone` = ?,
                    `parent_email` = ?,
                    `subject_id` = ?, 
                    `payment_type` = ?,
                    `money_total` = ?, 
                    `updated_at` = ?,
                    `updated_by` = ?,
                    `is_old_student` = ?,
                    `subject_class_id`=?,
                    `teacher_id`=?
                WHERE
                    `id` = ?
                  ', array(
            $student_fullname,
            $student_phone,
            $student_email,
            $parent_fullname,
            $parent_phone,
            $parent_email,
            $subject_id,
            $payment_type,
            $money_total,
            $created_at,
            $createdby,
            $id, $is_old_student,$subject_class_id,$teacher_id
        ));
//        $id = $this->_db->insert ('students', $data);
//        if($id)
//            echo 'user was created. Id=' . $id;
//        else 
//            echo 'die';
    }

    public function searchstudent($fullname, $teacherid, $subjectsid, $usercreate)
    {
        $this->_db = MysqliDb::getInstance();
        $sql = "select st.id,st.student_fullname,s.title,t.`name`,st.`created_at`
 from `students` st inner join `subjects` s on st.subject_id = s.id
left join `subject_class` sc on st.`subject_class_id` = sc.id
left join `teachers` t on sc.teacher_id = t.id";
        $sqlWhere = ' where 1=1';
        if (!empty($fullname))
            $sqlWhere .= " and st.student_fullname like  '%" . $fullname . "%'";
        if (!empty($usercreate))
            $sqlWhere .= " and st.created_by like  '%" . $usercreate . "%'";
        if ($teacherid > 0)
            $sqlWhere .= " and sc.teacher_id  = " . intval($teacherid);
        if ($subjectsid > 0)
            $sqlWhere .= "  and st.subject_id  = " . intval($subjectsid);
        $result = $this->_db->rawQuery($sql . $sqlWhere);
        return $result;
    }

    public function insertStudentDetail($dataDetail, $dataBill)
    {
        try
        {
            $this->_db = MysqliDb::getInstance();
            $dataDetail['created_at'] = $this->_db->now();
            $detailId = $this->_db->insert('student_detail', $dataDetail);
            $dataBill['created_at'] = $this->_db->now();
            $billId = $this->_db->insert('student_bill', $dataBill);

        }
        catch (Exception $e)
        {

        }
    }

    public function insertBillCode1()
    {
        try
        {
            $this->_db = MysqliDb::getInstance();
            $dataDetail['datenow'] = $this->_db->now();
            $bId = $this->_db->insert('genbillcode1', $dataDetail);
            return $bId;
        }
        catch (Exception $e)
        {

        }
    }



}