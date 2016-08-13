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

        $users = $this->_db->rawQuery('SELECT * from students where id >= ?', Array(0));
        //  print_r($this->_db);die;
        foreach ($users as $user) {
            print_r($user);
        }
        return $users;
    }

    public function getListSubject()
    {
        $this->_db = MysqliDb::getInstance();
        // obtain db object created in init  ()
//        $this->_db = MysqliDb::getInstance();
        $lsSubjects = $this->_db->rawQuery('Select id,title from `subjects`');
        return $lsSubjects;
    }

    public function getListTeacher()
    {
        $this->_db = MysqliDb::getInstance();
        // obtain db object created in init  ()
//        $this->_db = MysqliDb::getInstance();
        $lsTeacher = $this->_db->rawQuery('Select id,`name` from  `teachers`');
        return $lsTeacher;
    }

    public function getListTeacherActive()
    {
        $this->_db = MysqliDb::getInstance();
        $lsTeacher = $this->_db->rawQuery('Select id,`name` from  `teachers` where `isactive` = 1 and `isdelete` = 0');
        return $lsTeacher;
    }

    public function getTechcherSalaryOnMonth($date)
    {
        $this->_db = MysqliDb::getInstance();
        // obtain db object created in init  ()
//        $this->_db = MysqliDb::getInstance();
      /*  $sql = 'Select `name`,`address`,`title`,GROUP_CONCAT(money_percent_for_teacher) as money_percent_for_teacher,
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
group by `name`,`address`,`title`';*/
        $sql = 'select `name`,`address`,`title`,GROUP_CONCAT(money_percent_for_teacher) as money_percent_for_teacher,
GROUP_CONCAT(totalmoney) as totalmoney,GROUP_CONCAT(totalmoney) as totalmoneyteacher,
GROUP_CONCAT(totalstudent) as totalstudent
 from (
select t.`name`,t.`address`,s.title,ifnull(st.`money_percent_for_teacher`,0) as money_percent_for_teacher
, st.`is_old_student`,ifnull(sum(st.`money_of_teacher`),0) as totalmoneyteacher,
ifnull(sum(st.`money_detail`),0) as totalmoney, count(st.id) as totalstudent
 from `teachers` t inner join `subject_class` sc
on t.id = sc.teacher_id inner join `subjects` s on sc.subject_id = s.id
inner join `students` st on st.subject_class_id = sc.id
group by t.`name`,t.`address`,s.title,ifnull(st.`money_percent_for_teacher`,0),st.`is_old_student`
order by t.`name`
) as TableA
group by `name`,`address`,`title`';
        $data = $this->_db->rawQuery($sql, Array($date));
//        foreach ($users as $user) {
//            print_r($user);
//        }
        return $data;
    }

    public function getHoaDon($date)
    {
        $this->_db = MysqliDb::getInstance();
        /*$arr = array();
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
        }*/
        $sql = 'select isservice,SUM(money) as total,MAX(bill_code) as maxbill,MIN(bill_code) as minbill
                from `student_bill` where IFNULL(isdelete,0) <> 1
                and DATE_FORMAT(created_at, \'%Y-%m\') = \'2016-08\'
                group by isservice';
        $data = $this->_db->rawQuery($sql);
        return $data;
    }

    public function insertSubject($data, $datadetail, $id, $dataClass)
    {
        try {
            $this->_db = MysqliDb::getInstance();
            if ($id > 0) { //update
                $this->_db->where('id', $id);
                $data['updated_at'] = $this->_db->now();
                if ($this->_db->update('subjects', $data)) { //update thanh cong
                    $subjectId = $id;
                }
            } else {
                $data['created_at'] = $this->_db->now();
                $data['updated_at'] = $this->_db->now();
                $subjectId = $this->_db->insert('subjects', $data);
            }
            if ($subjectId > 0) {
                //data detail
                if (isset($datadetail) && count($datadetail) > 1) {
                    if ($id > 0) { //delete data cu
                        $this->_db->where('subject_id', $id);
                        if ($this->_db->delete('subject_detail')) {
                            //delete thanh cong
                        }
                    }
                    $aOTPeriod = $datadetail['payment_onetime_hidden'];
                    $aOTValue = $datadetail['payment_onetime'];
                    if (isset($aOTPeriod) && isset($aOTValue)) {
                        for ($i = 0; $i < count($aOTValue); $i++) {
                            $arr[] = array("pay_period" => $aOTPeriod[$i],
                                "pay_money" => $aOTValue[$i],
                                "subject_id" => $subjectId,
                                "payment_type" => 1);
                        }
                    }
                    $aOTPeriod = $datadetail['payment_month_hidden'];
                    $aOTValue = $datadetail['payment_month'];
                    if (isset($aOTPeriod) && isset($aOTValue)) {
                        for ($i = 0; $i < count($aOTValue); $i++) {
                            $arr[] = array("pay_period" => $aOTPeriod[$i],
                                "pay_money" => $aOTValue[$i],
                                "subject_id" => $subjectId,
                                "payment_type" => 2);
                        }
                    }
                    $aOTPeriod = $datadetail['payment_phase_hidden'];
                    $aOTValue = $datadetail['payment_phase'];
                    if (isset($aOTPeriod) && isset($aOTValue)) {
                        for ($i = 0; $i < count($aOTValue); $i++) {
                            $arr[] = array("pay_period" => $aOTPeriod[$i],
                                "pay_money" => $aOTValue[$i],
                                "subject_id" => $subjectId,
                                "payment_type" => 3);
                        }
                    }
                    if (isset($arr) && count($arr) > 0)
                        $ids = $this->_db->insertMulti('subject_detail', $arr);
                }
                //data class
                if (isset($dataClass) && count($dataClass) > 0) {
                    if ($id > 0) { //delete data cu
                        $this->_db->where('subject_id', $id);
                        if ($this->_db->delete('subject_class')) {
                            //delete thanh cong
                        }
                    }
                    $arrClass = [];
                    foreach ($dataClass as $item) {
                        $timeLearning = '';
                        if (isset($item['timelearning'])) {
                            for ($i = 0; $i < count($item['timelearning']); $i++) {

                                $timeLearning .= $item['timelearning'][$i];
                                if ($i != count($item['timelearning']))
                                    $timeLearning .= ';';
                            }
                            $timeLearning = rtrim($timeLearning, ";");
                        }
                        $arrClass[] = array("timelearning" => $timeLearning,
                            "fromhours" => $item['fromhours'],
                            "tohours" => $item['tohours'],
                            "subject_id" => $subjectId,
                            "teacher_id" => $item['teachers']);
                    }
                    if (isset($arrClass) && count($arrClass) > 0)
                        $ids = $this->_db->insertMulti('subject_class', $arrClass);
                }
            }
        } catch (Exception $e) {
            print_r($e);
            die;
        }
    }

    public function getSubjectById($id)
    {
        try {
            $this->_db = MysqliDb::getInstance();
            $sql = 'select s.id,s.title,s.description,s.subject_type,s.fromdate,s.todate,s.money_total,s.phase,s.isactive,s.is_support_old_student,
s.money_percent_for_teacher,s.subject_payment_type,s.money_percent_for_old_student,
GROUP_CONCAT(sd.pay_period) as pay_period,GROUP_CONCAT(sd.pay_money) as pay_money,
GROUP_CONCAT(sd.payment_type) as payment_type from `subjects` s inner join `subject_detail` sd
on s.id = sd.subject_id 
where s.id = ?';
            $data = $this->_db->rawQuery($sql, Array($id));
        } catch (Exception $e) {
            print_r($e);
            die;
        }
        return $data;
    }


    public function getListSubjectClassById($id)
    {
        try {
            $this->_db = MysqliDb::getInstance();
            $sql = 'select sc.id,sc.subject_id,sc.timelearning,sc.fromhours,sc.tohours,sc.teacher_id,t.`name` from `subject_class` sc 
inner join `teachers` t on sc.teacher_id = t.id
where sc.subject_id = ?';
            $data = $this->_db->rawQuery($sql, Array($id));
        } catch (Exception $e) {
            print_r($e);
            die;
        }
        return $data;
    }

    public function getListSubjectWithPaging($title, $teacherName, $pageIndex, $pageSize)
    {
        try {
            $this->_db = MysqliDb::getInstance();
            $pageIndex = $pageIndex * $pageSize;
            $sql = 'select s.id,s.title,t.`name` as teacher_name,s.todate,s.created_at,t.id as teacher_id,
s.fromdate,GROUP_CONCAT(sc.tohours) as tohours,GROUP_CONCAT(sc.fromhours) as fromhours,
GROUP_CONCAT(sc.timelearning) as timelearning from `subjects` s 
inner join `subject_class` sc on s.id = sc.subject_id
inner join `teachers` t
on sc.teacher_id = t.id
where IFNULL(s.isdelete,0) <> 1 and s.subject_payment_type = 1' ;
            $sqlGroupBy = ' group by s.id,s.title,t.`name`,s.todate,s.created_at,t.id,s.fromdate';
            $sqlWhere = '';
            if (!empty($title)) {
                $sqlWhere .= " and s.title like '%$title%'";
//                $param[] = $title;
            }
            if (!empty($teacherName)) {
                $sqlWhere .= " and t.`name` like '%$teacherName%'";
//                $param[] = $teacherName;
            }
//            print_r($sqlWhere);die;
            $param[] = $pageIndex;
            $param[] = $pageSize;
            $sqlOrder = ' order by s.id desc limit ?,?';
            $sql = $sql . $sqlWhere . $sqlGroupBy . $sqlOrder;
//           var_dump($sql);
//            print_r($param);die;
            $data = $this->_db->rawQuery($sql, $param);
//            print_r($data);die;
        } catch (Exception $e) {
            print_r($e);
            die;
        }
        return $data;
    }

    public function getListServiceWithPaging($title, $pageIndex, $pageSize)
    {
        try {
            $this->_db = MysqliDb::getInstance();
            $pageIndex = $pageIndex * $pageSize;
            $sql = 'select s.id,s.title,s.todate,s.created_at from `subjects` s  
                        where IFNULL(s.isdelete,0) <> 1 and subject_payment_type = 0';
            $sqlGroupBy = ' group by s.id,s.title,s.created_at';
            $sqlWhere = '';
            if (!empty($title)) {
                $sqlWhere .= " and s.title like '%$title%'";
//                $param[] = $title;
            }

//            print_r($sqlWhere);die;
            $param[] = $pageIndex;
            $param[] = $pageSize;
            $sqlOrder = ' order by s.id desc limit ?,?';
            $sql = $sql . $sqlWhere . $sqlGroupBy . $sqlOrder;
//           var_dump($sql);
//            print_r($param);die;
            $data = $this->_db->rawQuery($sql, $param);
//            print_r($data);die;
        } catch (Exception $e) {
            print_r($e);
            die;
        }
        return $data;
    }

    public function deleteSubject($id)
    {
        $this->_db = MysqliDb::getInstance();
        $user = $this->_db->rawQuery('update `subjects` set `subjects`.`isdelete` = 1 where id =?', array($id));
        return $user;
    }

    public function checkUserLogin($username, $password)
    {
        $this->_db = MysqliDb::getInstance();
        $results = $this->_db
            ->where('name', $username)
            ->where('isdelete', 0)
            ->where("password", md5($password))
            ->get('users');
        return $results;
    }


    public function insertService($data, $id)
    {
        try {
            $this->_db = MysqliDb::getInstance();
//
            if ($id > 0) { //update
                $this->_db->where('id', $id);
                $data['updated_at'] = $this->_db->now();
                if ($this->_db->update('subjects', $data)) { //update thanh cong
                    $subjectId = $id;
                }
            } else {
                $data['created_at'] = $this->_db->now();
                $data['updated_at'] = $this->_db->now();
                $subjectId = $this->_db->insert('subjects', $data);
            }
            return $subjectId;
        } catch (Exception $e) {
            print_r($e);
            die;
        }
    }
}