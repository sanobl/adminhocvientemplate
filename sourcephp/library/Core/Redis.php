<?php

class Core_Redis {

    protected $_redis;
    protected $_redisnew;
    var $config;
    protected static $_instance = null;

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->redis;
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
            if (empty($this->config->server)) {
                return false;
                //Zend_Cache::throwException('Redis \'server\' not specified.');
            }

            if (empty($this->config->port) && substr($this->config->server, 0, 1) != '/') {
                return false;
                //Zend_Cache::throwException('Redis \'port\' not specified.');
            }

            $this->_redis = new Redis();
            if (isset($this->config->timeout)) {
                $this->_redis->connect($this->config->server, $this->config->port, $this->config->timeout);
            } else {
                $this->_redis->connect($this->config->server, $this->config->port);
            }
            $this->_redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
        } catch (Exception $e) {
            return false;
        }
    }

    public function __call($name, $args) {
        //var_dump($this->_redis);die;
        return call_user_func_array(array($this->_redis, $name), $args);
        
    }
    private function callredisnew($database, $ip, $port){
        try {
            if (empty($ip)) {
                return false;
            }

            if (empty($port) && substr($ip, 0, 1) != '/') {
                return false;
            }
            
            $this->_redisnew = new Redis();
           
            if (isset($this->config->timeout)) {
                $this->_redisnew->connect($ip, $port, $this->config->timeout);
                $this->_redisnew->select($database);
            } else {
                $this->_redisnew->connect($ip, $port);
                $this->_redisnew->select($database);
            }
            
            $this->_redisnew->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
            
        } catch (Exception $ex) {

        }
    }
    public function __callnew($name, $args, $database, $ip, $port) {
        $this->callredisnew($database, $ip, $port);
        return call_user_func_array(array($this->_redisnew, $name), $args);        
    }

	public function addProductIngame($productId)
	{
		try {
			$ListProductInteraction = $this->__callnew('get', array('ListProductInteraction'), 15, $this->config->server, $this->config->port);
			// echo '<pre>start';
			// print_r($ListProductInteraction);
			// echo '2<br>';
			if ($ListProductInteraction == null){
				//them moi
				$ListProductInteraction = array();
                $ListProductInteraction[$productId] = date('d-m-Y H:i:s',time()); //productId-key : time-value
			}
			else{
				//check exist
				// if (isset($ListProductInteraction[$productId])){
					// $ListProductInteraction[$productId] = time();
				// }
				// else{
					// $ListProductInteraction[$productId] = time();
				// }	
				$ListProductInteraction[$productId] = date('d-m-Y H:i:s',time());				
			}
			// print_r($ListProductInteraction);
			// echo 'cache<br>';
			$this->__callnew('set', array('ListProductInteraction', $ListProductInteraction), 15, $this->config->server, $this->config->port);
			// $ListProductInteraction = $this->__callnew('get', array('ListProductInteraction'), 15);
			// print_r($ListProductInteraction);
			// echo '----------------------<br>';
		} catch (Exception $e) {		
            return;
        }
	}
}
