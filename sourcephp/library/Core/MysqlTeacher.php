<?php
require_once ('MysqliDb.php');
class Core_MysqlTeacher
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

    public function checkExist ($name) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $teacher = $this->_db->rawQuery('SELECT `id` from teachers where `name` = ?', Array ($name));
        
        return $teacher!=null;
    }
    
    public function insertTeacher ($teacher) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('INSERT INTO `teachers`(`name`, `email`, `phone`, `isactive`, `isdelete`, `created_at`, `updated_at`, `address`) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $teacher);
        
        return $result!=null;
    }
    public function updateTeacher ($teacher) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('UPDATE `teachers` SET `name`= ?,'
                . '`email`=?,`phone`=?,`isactive`=?,`isdelete`=?,'
                . '`updated_at`=?,`address`=? WHERE `id` = ?', $teacher);
        //var_dump($teacher);die;
        return $result!=null;
    }
    public function getTeacher ($id) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $teacher = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `phone`, `isactive`, `isdelete`, `address` FROM `teachers` WHERE `id` = ?', Array ($id));
        
        return $teacher!=null?$teacher:null;
    }
    public function getTeachers () {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $teacher = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `phone`, `isactive`, `isdelete`, `address` FROM `teachers`');
        
        return $teacher;
    }
    public function getTeachersSearch ($name) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $teacher = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `phone`, `isactive`, `isdelete`, `address` FROM `teachers` WHERE `name` like \'%'.$name.'%\'');
//        $teacher = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `phone`, `isactive`, `isdelete`, `address` FROM `teachers` WHERE `name` like \'%?%\'', array($name));
        
        return $teacher;
    }
    public function deleteTeachers ($id) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $teacher = $this->_db->rawQuery('UPDATE `teachers` SET `isdelete`=1 WHERE `id` = ?', array($id));
        
        return $teacher;
    }
}