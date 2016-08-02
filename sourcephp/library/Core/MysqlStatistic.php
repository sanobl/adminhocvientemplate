<?php
require_once('MysqliDb.php');

class Core_MysqlStatistic
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
      
        $users = $this->_db->rawQuery('SELECT * from students where id >= ?', Array (0));
        //  print_r($this->_db);die;
        foreach ($users as $user) {
            print_r($user);
        }
        return $users;
    }

    public function getListSubject()
    {
        // obtain db object created in init  ()
//        $this->_db = MysqliDb::getInstance();
        $lsSubjects = $this->_db->rawQuery('Select id,title from `subjects`');
        return $lsSubjects;
    }

    public function getListTeacher()
    {
        // obtain db object created in init  ()
//        $this->_db = MysqliDb::getInstance();
        $lsTeacher = $this->_db->rawQuery('Select id,`name` from  `teachers`');
        return $lsTeacher;
    }

    public function getTechcherSalaryOnMonth($date)
    {
        // obtain db object created in init  ()
//        $this->_db = MysqliDb::getInstance();
        $sql = 'Select `name`,`address`,`title`,GROUP_CONCAT(money_percent_for_teacher) as money_percent_for_teacher,
GROUP_CONCAT(stu) as stu,GROUP_CONCAT(money) as money,GROUP_CONCAT(money_of_teacher) as money_of_teacher
 from 
(
select t.`name`,t.address,s.title,st.is_old_student,st.money_percent_for_teacher,count(st.id) as stu, sum(st.money_detail) as money
,sum(st.money_of_teacher)  as money_of_teacher
 from `teachers` t inner join `students` st
on t.id = st.teacher_id inner join `subjects` s on s.id = st.subject_id
where DATE(st.created_at) =  ?
group by t.`name`,t.address,s.title,st.is_old_student,st.money_percent_for_teacher
order by t.`name` 
) as tableA
group by `name`,`address`,`title`';
        $data = $this->_db->rawQuery($sql, Array($date));
//        foreach ($users as $user) {
//            print_r($user);
//        }
        return $data;
    }

    public function getHoaDon($date)
    {
        $arr = array();
        $sql = 'SELECT MIN(bill_code) as min, MAX(bill_code) as max FROM `student_bill`
where DATE_FORMAT(created_at, \'%Y-%m\') = \'2016-08\'';
        $data = $this->_db->rawQuery($sql);

        if (isset($data)) {
            $min = $data[0]['min'];
            $max = $data[0]['max'];
            $sumtotal = 0;
            $sqldetail = 'select sum(money) as total from `student_bill` where bill_code >= \'000213\' and bill_code <= \'0003232\'';
            $datadetail = $this->_db->rawQuery($sqldetail);
            if (isset($datadetail))
                $sumtotal = $datadetail[0]['total'];
            $arr = array($min, $max, $sumtotal);
        }
        return $arr;
    }

}