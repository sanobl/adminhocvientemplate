<?php
class Model_Page extends Model_Base_Page
{
	public static function getInstance($className=__CLASS__){
        return parent::getInstance($className);
    }
	
	public function find($req){	      
		//$caching = Core_Global::getCaching();
		$page = array();
		$req = $this->update($req);
                

		$req['template']=$req['title'];
//		if(!empty($req['template'])){
//			$name = Core_Global::getKeyPrefixCaching('page_key').$req['template'];
//			if(false===($page = $caching->load($name))){		
//				$path = APPLICATION_PATH.'/configs/page/'.Core_Map::formatString($name).'.php';						
//				if(file_exists($path)){
//					$page = require($path);				
//					$caching->save($page, $name);
//				}
//			}		
//		}
         
                if(!empty($req['template'])){
				$name = Core_Global::getKeyPrefixCaching('page_key').$req['template'];	
                                $path = APPLICATION_PATH.'/configs/page/'.Core_Map::formatString($name).'.php';	
                           	if(file_exists($path)){
					$page = require($path);				
					
				}
				
		}	
		return array($page, $req);
	}
	
	public function update($req){		
            	if(!empty($req['title']) && !empty($title[$req['title']])){
				$param = $title[$req['title']];
				
				unset($req['title']);	
				
				foreach($param as $k=>$v)
					$req[$k] = $v;
		}
		
		return $req;		
	}
}
?>