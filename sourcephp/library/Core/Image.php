<?php
class Core_Image
{		
	public static function path($file, $thum=NULL, $site = 'frontend'){
		if(preg_match('/^([0-9]+)\_/', $file, $matches)){
			$time = (int)$matches[1];
			
			$param = array();
			$param[] = Core_Global::getApplicationIni()->app->static->{$site}->uploads;
			$param[] = date('d', $time);
			$param[] = date('m', $time);
			$param[] = date('Y', $time);
			
			if(!empty($thum)){
				$param[] = $thum;
			}
			
			$param[] = $file;
			return join('/', $param);			
		}
		return NULL;			
	}
	
	public static function info($file, $thum=NULL){
		if(preg_match('/^([0-9]+)\_/', $file, $matches)){
			$time = (int)$matches[1];
			
			$param = array();
			$param[] = Core_Global::getApplicationIni()->app->static->backend->uploads_dir;
			$param[] = date('d', $time);
			$param[] = date('m', $time);
			$param[] = date('Y', $time);
			
			if(!empty($thum)){
				$param[] = $thum;
			}
			
			
			$param[] = $file;
							
			$path = join(DIRECTORY_SEPARATOR, $param);
			if(is_file($path) && file_exists($path)){
				$info = getimagesize($path);
				return array('width'=>$info[0], 'height'=>$info[1]);
			}
		}
		return array('width'=>0, 'height'=>0);
	}
}
?>