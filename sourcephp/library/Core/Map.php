<?php
class Core_Map{		
	public static function mergeArray($a,$b){
		if(!empty($b)){
			foreach($b as $k=>$v){
				if(is_integer($k))
					isset($a[$k]) ? $a[]=$v : $a[$k]=$v;
				else if(is_array($v) && isset($a[$k]) && is_array($a[$k]))
					$a[$k]=self::mergeArray($a[$k],$v);
				else
					$a[$k]=$v;
			}		
		}
		return $a;
	}
	
	public static function in_array($needle, $haystack){
		if(is_array($needle)){
			foreach($needle as $v){
				if(in_array($v, $haystack))
					return true;
			}
		}else{
			return in_array($needle, $haystack);
		}		
		return false;
	}
	
	public static function parseIni($string){
        $group = NULL;
        $array = array();
	    $lines = preg_split("[\n]", $string);
       
        foreach($lines as $line){
            $statement = preg_match("/^(?!;)(?P<key>[^\=]+?)\s*=\s*(?P<value>.+?)\s*$/", $line, $match);
            if($statement){
                $key = $match['key'];
                $value = $match['value'];
               
                if(preg_match( "/^\".*\"$/", $value ) || preg_match( "/^'.*'$/", $value)){
                    $value = mb_substr($value, 1, mb_strlen( $value ) - 2);
                }
               
			   	if(!empty($group))
	                $array[$group][$key] = $value;
				else
					$array[$key] = $value;	
            }else if(preg_match("/^\[\s*(\w+)\s*\]\s*$/", $line, $match)){
				$group=$match[1];
			}
        }
        return $array;
    }
	
	public static function removeAccents($string, $bank='-'){
		$trans = array ('à'=>'a','á'=>'a','ả'=>'a','ã'=>'a','ạ'=>'a',
						'ă'=>'a','ằ'=>'a','ắ'=>'a','ẳ'=>'a','ẵ'=>'a','ặ'=>'a',
						'â'=>'a','ầ'=>'a','ấ'=>'a','ẩ'=>'a','ẫ'=>'a','ậ'=>'a',
						'À'=>'a','Á'=>'a','Ả'=>'a','Ã'=>'a','Ạ'=>'a',
						'Ă'=>'a','Ằ'=>'a','Ắ'=>'a','Ẳ'=>'a','Ẵ'=>'a','Ặ'=>'a',
						'Â'=>'a','Ầ'=>'a','Ấ'=>'a','Ẩ'=>'a','Ẫ'=>'a','Ậ'=>'a',
						'đ'=>'d','Đ'=>'d',
						'è'=>'e','é'=>'e','ẻ'=>'e','ẽ'=>'e','ẹ'=>'e',
						'ê'=>'e','ề'=>'e','ế'=>'e','ể'=>'e','ễ'=>'e','ệ'=>'e',
						'È'=>'e','É'=>'e','Ẻ'=>'e','Ẽ'=>'e','Ẹ'=>'e',
						'Ê'=>'e','Ề'=>'e','Ế'=>'e','Ể'=>'e','Ễ'=>'e','Ệ'=>'e',
						'ì'=>'i','í'=>'i','ỉ'=>'i','ĩ'=>'i','ị'=>'i',
						'Ì'=>'i','Í'=>'i','Ỉ'=>'i','Ĩ'=>'i','Ị'=>'i',
						'ò'=>'o','ó'=>'o','ỏ'=>'o','õ'=>'o','ọ'=>'o',
						'ô'=>'o','ồ'=>'o','ố'=>'o','ổ'=>'o','ỗ'=>'o','ộ'=>'o',
						'ơ'=>'o','ờ'=>'o','ớ'=>'o','ở'=>'o','ỡ'=>'o','ợ'=>'o',
						'Ò'=>'o','Ó'=>'o','Ỏ'=>'o','Õ'=>'o','Ọ'=>'o',
						'Ô'=>'o','Ồ'=>'o','Ố'=>'o','Ổ'=>'o','Ỗ'=>'o','Ộ'=>'o',
						'Ơ'=>'o','Ờ'=>'o','Ớ'=>'o','Ở'=>'o','Ỡ'=>'o','Ợ'=>'o',
						'ù'=>'u','ú'=>'u','ủ'=>'u','ũ'=>'u','ụ'=>'u',
						'ư'=>'u','ừ'=>'u','ứ'=>'u','ử'=>'u','ữ'=>'u','ự'=>'u',
						'Ù'=>'u','Ú'=>'u','Ủ'=>'u','Ũ'=>'u','Ụ'=>'u',
						'Ư'=>'u','Ừ'=>'u','Ứ'=>'u','Ử'=>'u','Ữ'=>'u','Ự'=>'u',
						'ỳ'=>'y','ý'=>'y','ỷ'=>'y','ỹ'=>'y','ỵ'=>'y',
						'Y'=>'y','Ỳ'=>'y','Ý'=>'y','Ỷ'=>'y','Ỹ'=>'y','Ỵ'=>'y', ' '=>$bank, '/'=>$bank, '.'=>$bank);						
		return strtr ($string , $trans);
	}
	
	public static function formatString($string){
		return preg_replace('/[\-]{2,}/i','-',trim(preg_replace('/[^a-z0-9\-]/i','',strtolower(Core_Map::removeAccents($string, '-'))),'-'));
	}
	
	public static function array_random_assoc($arr, $num = 1) {
	    $keys = array_keys($arr);
	    shuffle($keys);	    
	    $r = array();
	    for ($i = 0; $i < $num; $i++) {
	        $r[$keys[$i]] = $arr[$keys[$i]];
	    }
	    return $r;
	}
	
	public static function getIp(){
		if (isset($_SERVER["HTTP_CLIENT_IP"])){
			return $_SERVER["HTTP_CLIENT_IP"];
		}
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		if (isset($_SERVER["HTTP_X_FORWARDED"])){
			return $_SERVER["HTTP_X_FORWARDED"];
		}
		if (isset($_SERVER["HTTP_FORWARDED_FOR"])){
			return $_SERVER["HTTP_FORWARDED_FOR"];
		}
		if (isset($_SERVER["HTTP_FORWARDED"])){
			return $_SERVER["HTTP_FORWARDED"];
		}
		return $_SERVER["REMOTE_ADDR"];		
	}
	
	public static function truncate($text = '', $length = 100, $suffix = '...', $encode = 'UTF-8'){		
        if(mb_strlen($text, $encode)>$length){			
			$last = mb_strrpos(mb_substr($text, 0, $length, $encode), ' ', 0, $encode);			
			$output = mb_substr($text, 0, empty($last)?$length:$last, $encode).$suffix;
			return $output;
		}
		return $text;
    }
	
	public static function formatTitle($title, $replace='<br/>', $len=35){		
		if(preg_match("/^(?P<first>[^\(]+)(?P<second>.+)$/", " {$title} ", $match)){
			$match['first'] = trim($match['first']);
			$match['second'] = trim($match['second']);
			if(!empty($match['second']) && !empty($match['first']))
				return htmlspecialchars(Core_Map::truncate($match['first'], 20)).$replace.htmlspecialchars(Core_Map::truncate($match['second'], 20, ''));
		}
		return htmlspecialchars(Core_Map::truncate($title, $len));
	}
        /*public static function getParamByIndex($index){
            $tmp = explode("/",$_SERVER["REQUEST_URI"]);
            $tmp = explode(".",$tmp[count($tmp)-1]);
            return isset($tmp[$index])?$tmp[$index]:0;
        }*/
     //
     //check date vaild mm/dd/yyyy | mm-dd-yyyy | ....
     public static function isDateValid($date, $format){
        $date = str_replace(array('\'', '-', '.', ',', ' '), '/', $date);
        $a_date = explode('/', $date); 
       
        if(count($a_date)<3)
            return FALSE;
        if($format == 'vi'){//dd/mm/yyyy
            $month = $a_date[1];
            $day = $a_date[0];
            $year = $a_date[2];
        }
        else if($format == 'usa'){//mm/dd/yyyy
            $month = $a_date[0];
            $day = $a_date[1];
            $year = $a_date[2];
        }
        else if($format == 'ISO-8601'){//yyyy/mm/dd
            $year = $a_date[0];
            $month = $a_date[1];
            $day = $a_date[2];
        }
        if (!is_numeric($month) || !is_numeric($day) || !is_numeric($year)){
            return FALSE;
        }
        if ( checkdate($month, $day,$year) )
        {
            return TRUE;
        }
        return FALSE;
     }
     public static function limitText( $txt, $sze ) {		
		$txt = strip_tags($txt,"");		
		if(empty($txt))
			return 'Đang cập nhật';
		else 
		{
			 $txt = preg_replace("/<img[^>]+\>/i", " ", $txt); 
			 //$txt = htmlchars($txt);
			  if ( strlen( $txt ) > 0 ) {
	
				   if ( strlen( $txt ) > intval($sze) ){
						$txt = substr( $txt, 0, $sze );
	
						// If possible, do chop at the last space
						//
						$lastSpace = strrpos( $txt, " " );
						if ( $lastSpace !== false )
							 $txt = substr( $txt, 0, $lastSpace );
				   }
			  }
			  $matches = array();
			  //preg_match_all('#<div[^>]*>(.*?)</div>#', $txt, $matches);
			  //var_dump($matches[1]);
			  return $txt.'...';
		}
    }
}
?>