<?php
// print_r('<pre>');
// print_r($_SERVER);exit;
//@session_start();
defined('ROOT_PATH')
        || define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
		
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

error_reporting(1);
error_reporting(E_ALL);
require_once APPLICATION_PATH . '/configs/defined.php';
try{
	$URI = $_SERVER['REQUEST_URI'];
	if (preg_match("/^\/(pRtNM\/)/", $URI)) {	
		try{
			header("Location: http://hotro.zing.vn");
			} 
catch(Exception $exception){   
//var_dump($exception);die;
}		}
	//$key = "application_".APPLICATION_ENV.'.ini';	    
	$config = APPLICATION_PATH.'/configs/application-'.APPLICATION_ENV.'.ini';	
	//Get options
	$options = array(
		'config' => array(
			APPLICATION_PATH.'/configs/application-'.APPLICATION_ENV.'.ini',
			APPLICATION_PATH.'/configs/application-'.APPLICATION_ENV.'.ini',
		)	    
	);
//	$cached = true;	
//	if(apc_exists($key) && empty($_GET['apc_reload'])){
//		$config = apc_fetch($key);
//		$cached = false;
//	}
	
	require_once 'Zend/Application.php';
	$application = new Zend_Application(
		APPLICATION_ENV,
		$options
	);
	
//	if($cached){
//		apc_store($key, $application->getOptions());
//	}
	
	
    $application->bootstrap()->run();
} 
catch(Exception $exception){   
	echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="refresh" content="4" /><title>hotro.zing.vn</title></head><body>'
	.'<div style="padding:10px;text-align:center;color:#666666;font-size:16px;line-height:30px;text-transform:uppercase">'
	.'<a href=""><img src="" border="0" /></a><br/>'
	.'Nội dung đang được cập nhật... vui lòng đợi trong giây lát!</div>';
    if(APPLICATION_ENV == 'production'){
		print_r($exception);
        echo '<br /><br />'.$exception->getMessage().'<br />'
        .'<div align="left">Stack Trace:'
        .'<pre>'.$exception->getTraceAsString().'</pre></div>';
    }
	if(APPLICATION_ENV == 'qc'){
        echo '<br /><br />'.$exception->getMessage().'<br />'
        .'<div align="left">Stack Trace:'
        .'<pre>'.$exception->getTraceAsString().'</pre></div>';
    }
    echo '</body></html>';
    exit(1);
}