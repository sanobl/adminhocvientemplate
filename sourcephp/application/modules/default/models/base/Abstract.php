<?php
class Model_Base_Abstract
{	
	public $_db;
	
	protected static $_instance = null;
	
	public function __construct(){
		//$this->_db = Core_Global::getDbMaster();
	}
	
    public static function getInstance($className=__CLASS__){
        //Check instance
        if(empty(self::$_instance[$className])){			
            self::$_instance[$className] = new $className;
        }

        //Return instance
        return self::$_instance[$className];
    }
	
	public static function toArray($object) {
        if(is_array($object) || is_object($object)) {
            $result = array();
            foreach($object as $key => $value) {
                $result[$key] = Model_Base_Abstract::toArray($value);
            }
            return $result;
        }
        return $object;
    }
	
	public static function getOffset($iPage, $iPageSize, $iCnt)
    {
        if ($iPageSize){
			$iPages  = ceil($iCnt / $iPageSize);			
            $iPage   = max(1, min($iPages, $iPage));		
            return $iPageSize*($iPage-1);
        }

        return 0;
    }
	
	public static function escape($string){
		$match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '"', ';', ' ');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\*', '\\?', '\\:', '\\"', '\\;', '\\ ');
        $string = str_replace($match, $replace, $string); 
        return $string;
    }
	
	public static function sumitem($arr){
		$aNum = array(); 
		$aPrice = array(); 
		foreach($arr as $k => $val){
			$aNum[] = $val['num']; 
			$aPrice[] = $val['totalprice']; 
		}		
		
		return array('totalitem'=>array_sum($aNum), 
					 'totalprice'=>number_format(array_sum($aPrice), 0, ',', '.'), 
					 'totalp' => array_sum($aPrice)
				); 
	}	

}