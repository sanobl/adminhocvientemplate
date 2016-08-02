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
        $listsubjects = $this->_db->rawQuery('SELECT id, title from students join');
        
        return $listsubjects;
    }
    
    public function getsubjectsbyid($data) {
        $listsubjects = $this->_db->rawQuery('SELECT id, title,teacher_id,money_total,payment_type,monday,tuesday,wednesday,thursday,friday,saturday,sunday,fromdate,todate,fromhours,tohours from subjects where id = ?',$data);        
        return $listsubjects;
    }
    
    public function getteacherbyid($data) {
        $listsubjects = $this->_db->rawQuery('SELECT id, name from teachers where id = ?',$data);
        //var_dump($listsubjects);die;
        return $listsubjects;
    }
    
    public function insertstudent($data) {
        $result = $this->_db->rawQuery('INSERT INTO `students`(`student_fullname`, `student_phone`, `student_email`, `parent_fullname`, `parent_phone`, `parent_email`,`subject_id`,`teacher_id`,`payment_type`,`money_total`) '
        . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $data);     
//        $id = $this->_db->insert ('students', $data);
//        if($id)
//            echo 'user was created. Id=' . $id;
//        else 
//            echo 'die';
    }

}