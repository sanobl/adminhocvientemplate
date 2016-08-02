<?php
class Core_Message{
	public static function getInstance(){
		static $instance;
        if(null === $instance){
            $instance = new self();	
        }
        return $instance;
    }
	
	public function get($zingid){
		$result = array();
		
		if($zingid){
			list($public, $group) = $this->cache();
			
			foreach($group as $row){
				if(in_array($zingid, $row['zingid'])){
					$result[] = array(
						'content'=>$row['content'],
						'url'=>$row['url']
					);
				}
			}
			
			foreach($public as $row)
				$result[] = $row;
		}	
		
		return $result;
	}
	
	private function cache(){
		$result = array(array(), array());
		
		$caching = Core_Global::getCaching();
		$name = Core_Global::getKeyPrefixCaching('alert_message_key');		
		
		if(false!==($public = $caching->load("{$name}public"))){							
			$result[0] = $public;
		}			
		if(false!==($group = $caching->load("{$name}group"))){							
			$result[1] = $group;
		}		
		return $result;
	}
}
?>