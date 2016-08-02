<?php
class Core_Cache
{	
	private static $_instance = null;
	
	public $_cache;
	
	public $keyPrefix = '';
	
    public static function getInstance($config = array()){				
		if(is_null(self::$_instance)){
			self::$_instance = new Core_Cache;
			self::$_instance->_cache = Zend_Cache::factory('Core', 'Memcached', $config['frontend'], $config['backend']);
		}
		return self::$_instance;
	}
	
	protected function generateUniqueKey($key){
		return preg_replace('/[^a-zA-Z0-9_]/i', '_', $this->keyPrefix.$key);
		//return md5($this->keyPrefix.$key);
	}
	
	public function load($id, $doNotTestCacheValidity = false){
		if(isset($_GET['debug']) && 'none'==$_GET['debug']){
			return false;
		}		
				
		if($key = $this->generateUniqueKey($id)){
			$result = $this->_cache->load($key, $doNotTestCacheValidity);
			Core_Debug::getInstance()->append('CacheId', $id, $result);
			return $result;
		}
		return array();		
    }
	
	public function save($data, $id, $tags = array(), $specificLifetime = false){
        return $this->_cache->save($data, $this->generateUniqueKey($id), $tags, $specificLifetime);
    }
	
	public function remove($id){
        return $this->_cache->remove($this->generateUniqueKey($id));
    }
	
	public function getMetadatas($id){
		return $this->_cache->getMetadatas($this->generateUniqueKey($id));
	}
	
	public function touch($id, $extraLifetime){
		return $this->_cache->touch($this->generateUniqueKey($id), $extraLifetime);
	}
	
	public function increment($key, $value=1){
		if(FALSE === ($cnt = $this->load($key))){
			$this->save(1, $key);
			return 1;	
		}
		else{
			$this->save((((int)$cnt)+$value), $key);
		}
				
		return ((int)$cnt+$value);
	}
	public function incrementInt($id='',$counter=1){
		$current_value = $this->increment($this->generateUniqueKey($id), $counter);
		if(!$current_value) {$this->save(1, $id);return 1;}
		return $current_value;
	}
	public function __call($method, $args){
		return call_user_func_array(array($this->_cache, $method), $args);
	}
}