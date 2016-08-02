<?php
class Core_Debug{
	protected static $_instance = null;	

	private $tracker;
	
	public static function getInstance(){		
		//Check instance
		if(empty(self::$_instance)){			
			self::$_instance = new Core_Debug;
		}
		
		//Return instance
		return self::$_instance;
	}
	
	public function add($name, $time, $arg=array(), $result=array()){
		if('development' == APPLICATION_ENV || isset($_GET['debug'])){
			$this->tracker[] = array($name, $time, $arg, $result);
		}
	}
	
	public function append($key, $name, $result=array()){
		if('development' == APPLICATION_ENV || isset($_GET['debug'])){
			if(empty($this->tracker[$key]))
				$this->tracker[$key] = array($key, 0, array($name=>$result), array());	
			else
				$this->tracker[$key][2][$name] = $result;		
		}
	}
	
	public function get(){
		return $this->tracker;
	}
}
?>