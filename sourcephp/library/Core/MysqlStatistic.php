<?php
require_once ('MysqliDb.php');
class Core_MysqlStatistic
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
                'prefix' => '',
                'charset' => 'utf8'));
        } catch (Exception $e) {
            return false;
        }
    }

    public function demomysql () {
        // obtain db object created in init  ()
        //$this->_db = MysqliDb::getInstance();
      
        $users = $this->_db->rawQuery('SELECT * from students where id >= ?', Array (0));
        //  print_r($this->_db);die;
        foreach ($users as $user) {
            print_r ($user);
        }
        return $users;
    }


}