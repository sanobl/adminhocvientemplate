<?php
require_once ('MysqliDb.php');
class Core_MySQLManagerStudent
{
    var $config;
    protected $_db;
    protected static $_instance = null;
    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->mysql;
        //var_dump($this->config);die;
        $this->initialize();
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    private function initialize() {
        try {
            if (empty($this->config->host) && empty($this->config->username) && empty($this->config->databasename)) {
                return false;
                //Zend_Cache::throwException('Redis \'server\' not specified.');
            }

            $this->_db = new MysqliDb (Array (
                'host' => $this->config->host,
                'username' => $this->config->username,
                'password' => $this->config->password,
                'db'=> $this->config->databasename,
                'port' => 3306,
                'prefix' => 'my_',
                'charset' => 'utf8'));
        } catch (Exception $e) {
            return false;
        }
    }

    public function demomysql () {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $users = $this->_db->rawQuery('SELECT * from students where id >= ?', Array (0));
        foreach ($users as $user) {
            print_r ($user);
        }
        return $users;
    }
    
    public function getlistsubjects() {
        $listsubjects = $this->_db->rawQuery('SELECT id, title from subjects');
        
        return $listsubjects;
    }
    public function getliststudent() {
        $result = $this->_db->rawQuery('SELECT students.id,subjects.title, student_fullname, teachers.name,students.created_at from students INNER JOIN teachers ON students.teacher_id = teachers.id INNER JOIN subjects ON students.subject_id = subjects.id');       
        return $result;
    }
    
    public function getstudentbyid($id) {
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
                students.teacher_id,
                students.money_total,
                students.money_detail,
                students.payment_type,
                students.created_at,
                students.updated_at,
                students.created_by,
                students.updated_by,
                subjects.title,
                teachers.name
              FROM
                students
              INNER JOIN
                teachers ON students.teacher_id = teachers.id
              INNER JOIN
                subjects ON students.subject_id = subjects.id
              WHERE
                students.id = ?',
                array($id));       
        return $result;
    }
    
    public function getlistteacher() {
        $result = $this->_db->rawQuery('SELECT `id`, `name` FROM `teachers` ');       
        return $result;
    }
    
    public function getsubjectsbyid($data) {
        $listsubjects = $this->_db->rawQuery('SELECT id, title,teacher_id,money_total,payment_type,timelearning,fromdate,todate,fromhours,tohours from subjects where id = ?',array($data));
        return $listsubjects;
    }
    
    public function getteacherbyid($data) {
        $listsubjects = $this->_db->rawQuery('SELECT id, name from teachers where id = ?',$data);
        //var_dump($listsubjects);die;
        return $listsubjects;
    }
    
    public function insertstudent($student_fullname,$student_phone, $student_email,
            $parent_fullname,$parent_phone,$parent_email,$subject_id,$teacher_id,$payment_type,$money_total,$created_at,$createdby) {
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
    
     public function updatestudent($student_fullname,$student_phone, $student_email,
            $parent_fullname,$parent_phone,$parent_email,$subject_id,$teacher_id,$payment_type,$money_total,$created_at,$createdby,$id) {
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
                    `teacher_id` = ?,
                    `payment_type` = ?,
                    `money_total` = ?, 
                    `updated_at` = ?,
                    `updated_by` = ?
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
                    $teacher_id,
                    $payment_type,
                    $money_total,
                    $created_at,
                    $createdby,
                    $id
                ));     
//        $id = $this->_db->insert ('students', $data);
//        if($id)
//            echo 'user was created. Id=' . $id;
//        else 
//            echo 'die';
    }
    
    public function searchstudent($fullname,$teacherid,$subjectsid,$usercreate) {
        $sql= " SELECT 
                students.id,
                subjects.title, 
                student_fullname, 
                teachers.name,
                students.created_at 
            from students 
            INNER JOIN teachers ON students.teacher_id = teachers.id 
            INNER JOIN subjects ON students.subject_id = subjects.id
            Where student_fullname like  '%".$fullname."%' and
                students.teacher_id  = ".intval($teacherid)." and
                students.subject_id  = ".intval($subjectsid);
        $result = $this->_db->rawQuery($sql);
        return $result;
    }
    


}