<?php

require_once __DIR__ . '/Credis/Client.php';
require_once __DIR__ . '/Credis/Cluster.php';
require_once __DIR__ . '/Credis/Sentinel.php';

Class Core_RedisNew {

    private $db = 0;
    protected $sentinel;
    protected static $_instance = null;
    var $config;
    var $cluster;
    var $mess;

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->redis;        
        //var_dump($this->sentinel);
        $this->sentinel = new Credis_Sentinel(new Credis_Client($this->config->server, $this->config->portsentinel));
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        
        return self::$_instance; //singleton
    }

    public function getDB() {
        return $this->db;
    }

    public function setDB($db) {
        $this->db = (int)$db;
    }

    public function setData($key, $value) {
        if ($key != '') {
            try {                
                $cluster = $this->sentinel->getCluster($this->config->sentinelname,  $this->db);
                return ($cluster->set($key, $value));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return FALSE;
    }

    public function getData($key) {
        if ($key != '') {
            try {                
                $cluster = $this->sentinel->getCluster($this->config->sentinelname, $this->db);
                return $cluster->get($key);
            } catch (Exception $e) {
                
            }
        }
        return null;
    }

}
