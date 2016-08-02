<?php
class Core_Service{
	private $api_url;	
	private $api_secret;
	private $rest = array();
	private $method = array();
	
    public function __construct($config){
        $this->api_url = $config['api_url'];
		$this->api_secret = $config['api_secret'];
    }
	
	public function __call($name, $args){
		if(count($this->method)>=2){
			$this->method = array();				
		}
		$this->method[] = ucfirst($name);
				
		if(2 == count($this->method)){
			$result = false;			
			$start = microtime(true);			

			$path = "/Api/{$this->method[0]}/{$name}";						
			$client = new Zend_Rest_Client("{$this->api_url}{$path}");

			$post = array();
			$post['args'] = $args;
			$post['api_secret'] = $this->api_secret;						
			$response = $client->restPost($path, $post);			
			if($response->isSuccessful()){
				try{
					$result = Core_DataList_JSON::decode($response->getBody());					
				}
				catch(Exception $e){	
					$mData = array('type'=>'fe_service_rest_exception','code'=>-1,'info'=>array('store'=>'Core_Service_call','err'=>$e->getMessage(),'date'=>date("Y-m-d H:i:s")));
					Model_Redis::getInstance()->monitorDaily($mData);															
					throw new Zend_Exception($response->getBody());
				}				
			}		
			
			$end = microtime(true);
			Core_Debug::getInstance()->add("api:{$this->method[0]}->{$name}", (($end-$start)*1000), $args, $result);						
			return $result;
		}
		return $this;
	}
}