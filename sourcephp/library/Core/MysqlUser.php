<?php
require_once ('MysqliDb.php');
class Core_MysqlUser
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
        $user = $this->_db->rawQuery('SELECT `id` from users where `name` = ?', Array ($name));
        
        return $user!=null;
    }
    
    public function insertUser ($user) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('INSERT INTO `users`(`name`, `password`, `email`, `phone`, `isadmin`, `isdelete`, `created_at`, `updated_at`, `full_name`) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', $user);
        
        return $result!=null;
    }
    public function updateUser ($user) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $result = $this->_db->rawQuery('UPDATE `users` SET `name`=?,`email`=?,'
                . '`password`=?, `updated_at`=?,'
                . '`isadmin` =?, `isdelete`=?,'
                . '`phone`=?,`full_name`=? WHERE `id` = ?', $user);
        //var_dump($user);die;
        return $result!=null;
    }
    public function getUser ($id) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $user = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `password`, `remember_token`, `phone`, `full_name`, `isdelete`, `isadmin` FROM `users` WHERE `id` = ?', Array ($id));
        
        return $user!=null?$user:null;
    }
    public function getUsers () {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $user = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `password`, `remember_token`, `phone`, `full_name`, `isdelete`, `isadmin` FROM `users`');
        
        return $user;
    }
    public function getUserSearch ($name, $fullName) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        if($name != '' && $fullName != '')
        $user = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `password`, `remember_token`, `phone`, `full_name`, `isdelete`, `isadmin` FROM `users` WHERE `name` like \'%'.$name.'%\' and '
                . '`full_name` like \'%'.$fullName.'%\'');
//        $user = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `phone`, `isactive`, `isdelete`, `address` FROM `users` WHERE `name` like \'%?%\'', array($name));
        else if($fullName != '')
            $user = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `password`, `remember_token`, `phone`, `full_name`, `isdelete`, `isadmin` FROM `users` WHERE `full_name` like \'%'.$fullName.'%\'');
        else if($name != '')
            $user = $this->_db->rawQuery('SELECT `id`, `name`, `email`, `password`, `remember_token`, `phone`, `full_name`, `isdelete`, `isadmin` FROM `users` WHERE `name` like \'%'.$name.'%\'');
        return $user;
    }
    public function deleteUser ($id) {
        // obtain db object created in init  ()
        $this->_db = MysqliDb::getInstance();
        $user = $this->_db->rawQuery('UPDATE `users` SET `isdelete`=1 WHERE `id` = ?', array($id));
        
        return $user;
    }
}