<?php
class Core_Global
{
    /**
     * Zend_Config_Ini
     * @var Zend_Config_Ini $config
     */
    private static $config = null;	
	
	/**
     * List mysqli storage
     */
    private static $arrStorage = array();	
	   
    /**
     * Get application application config     
     * @return <object>
     */
    public static function getApplicationIni(){
        
        //Get Ini Configuration
        if(is_null(self::$config)){
            if(Zend_Registry::isRegistered(APP_CONFIG)){
                self::$config = Zend_Registry::get(APP_CONFIG);
            }
            else{               
				self::$config = new Zend_Config(Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOptions());	
                Zend_Registry::set(APP_CONFIG, self::$config);
            }
        }
        
        //Return data
        return self::$config;
    }
	
	public static function getNavigation(){
		static $navigation;
		
        if(is_null($navigation)){
            if(Zend_Registry::isRegistered(APP_NAVIGATION))
            {
                $navigation = Zend_Registry::get(APP_NAVIGATION);
            }else{
                $navigationFile = 'nav.xml';
                $navigation = new Zend_Config_Xml(APPLICATION_PATH.'/configs/'.$navigationFile, 'nav');
                Zend_Registry::set(APP_NAVIGATION, $navigation);
            }
        }		
				
		return new Zend_Navigation($navigation);
	}
	
	/**
     * Get caching sharding instance     
     * @return <Core_Cache>
     */
    public static function getCaching(){
		static $caching = null;
		
        //Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }

        //Get caching instance
        if(is_null($caching)){
            //Get caching instance
            $caching = Core_Cache::getInstance(self::$config->caching->toArray());
        }

        //Return caching
        return $caching;
    }
	
	/**
     * Get meta config
     * @return <object>
     */
     public static function getMessage(){
		static $msgConfig = null;
		
        //Get Ini config
        if(is_null($msgConfig)){
            if(Zend_Registry::isRegistered(APP_MSG)){
                $msgConfig = Zend_Registry::get(APP_MSG);
            }
			else{
                $msgConfig = new Zend_Config(require(APPLICATION_PATH.'/../data/i18n/Message.php'));
                Zend_Registry::set(APP_MSG, $msgConfig);
            }
        }

        //Return data
        return $msgConfig;
    }
	
	/**
     * Get key prefix of caching
     * @param <string> $prefixKey
     * @return <string>
     */
    public static function getKeyPrefixCaching($prefixKey)
    {
		static $keyCaching = null;
		
        //Get Ini config
        if(is_null($keyCaching)){
            if(Zend_Registry::isRegistered(CACHING_CONFIG)){                
                $keyCaching = Zend_Registry::get(CACHING_CONFIG);
            }
            else{
                $cachingFile = 'caching.ini';                
                $keyCaching = new Zend_Config_Ini(APPLICATION_PATH.'/configs/'.$cachingFile);
                Zend_Registry::set(CACHING_CONFIG, $keyCaching);
            }
        }
        
        //Return prefix
        return $keyCaching->$prefixKey;
    }
	
	public static function getService(){
		static $service = null;
		//Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }
			
		if(is_null($service)){			
			$service = new Core_Service(self::$config->api->toArray());
		}
		
		return $service;
	}	
	
	public static function getGearmanWorker(){		
		static $worker;
		//Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }
			
		if(is_null($worker)){			
			$worker = new GearmanWorker();
			if (!empty(self::$config->gearman->server->servers)) {
				$worker->addServers(self::$config->gearman->server->servers);
			} 
			else{
				$worker->addServer();
			}
		}
		
		return $worker;
	}
	
	public static function getGearmanClient(){		
		static $client;
		//Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }
			
		if(is_null($client)){			
			$client = new GearmanWorker();
			if (!empty(self::$config->gearman->client->servers)) {
				$client->addServers(self::$config->gearman->client->servers);
			} 
			else{
				$client->addServer();
			}
		}
		
		return $client;
	}		
	
	/**
     * Get redis sharding instance
     * @return <Core_Nosql>
     */
    public static function getRedis(){
		static $redis;
        //Get Ini config
		try{
			if(is_null(self::$config)){
				self::$config = self::getApplicationIni();
			}	
			if(is_null($redis)){		
				if(isset(self::$config->redis)&&self::$config->redis){
					$redis = new Core_Redis(self::$config->redis->toArray());
				}
			}
		}catch (Exception $e) {
   			return false;
		}	
        //Return redis
        return $redis;
    }
	
	public static function getSolr(){
		static $solr;
        //Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }

		if(is_null($solr)){
			$solr = new Zend_Service_Solr(self::$config->api->solr->server, self::$config->api->solr->port, self::$config->api->solr->path);
		}
        //Return solr
        return $solr;
    }
	
	public static function setTranslator(){   
		static $translator = null;
		     
		if(is_null($translator)){
			if(Zend_Registry::isRegistered('Zend_Locale')){
				$locale = Zend_Registry::get('Zend_Locale');
				$locale->setLocale('en_US');
			}
			else{
				$locale = new Zend_Locale('en_US');	            
				Zend_Registry::set('Zend_Locale', $locale);
			}
			 
			$i18nFile = APPLICATION_PATH . '/../data/i18n/Zend_Validate.php';
			$translator = new Zend_Translate('Array', $i18nFile, $locale, array('disableNotices' => true));
			
			Zend_Registry::set('Zend_Translate', $translator);
			Zend_Form::setDefaultTranslator($translator);
		}
        //Return redis
        return $translator;
    }
		
	/**
     * Get admin storage instance
     * @return <Zend_Db>
     */
    public static function getDbMaster()
    {
		static $storageMaster = null;
		
        //Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }

        //Get storage instance
        if(is_null($storageMaster)){            
            //Set UTF-8 Collate and Connection
            $options_storage = self::$config->database->master->toArray();

            //Set params
            if(empty($options_storage['params']['driver_options'])){
                $options_storage['params']['driver_options'] = array(
                    1002    =>  'SET NAMES \'utf8\'',
                    12      =>  0
                );
            }            

            //Create object to Connect DB
            $storageMaster = Zend_Db::factory($options_storage['adapter'], $options_storage['params']);

            //Changing the Fetch Mode
            $storageMaster->setFetchMode(Zend_Db::FETCH_ASSOC);

           // Create Adapter default is Db_Table
            Zend_Db_Table::setDefaultAdapter($storageMaster);
			
            //Unclean
            unset($options_storage);

            //Push to queue
            self::$arrStorage[] = $storageMaster;
        }		

        //Return storage
        return $storageMaster;
    }
	
	/**
     * Get admin storage instance
     * @return <Zend_Db>
     */
    public static function getDbSlave(){
		static $storageSlave = null;
		
        //Get Ini config
        if(is_null(self::$config)){
            self::$config = self::getApplicationIni();
        }

        //Get storage instance
        if(is_null($storageSlave)){            
            //Set UTF-8 Collate and Connection
            $options_storage = self::$config->database->slave->toArray();

            //Set params
            if(empty($options_storage['params']['driver_options'])){
                $options_storage['params']['driver_options'] = array(
                    1002    =>  'SET NAMES \'utf8\'',
                    12      =>  0
                );
            }            

            //Create object to Connect DB
            $storageSlave = Zend_Db::factory($options_storage['adapter'], $options_storage['params']);

            //Changing the Fetch Mode
            $storageSlave->setFetchMode(Zend_Db::FETCH_ASSOC);

           // Create Adapter default is Db_Table
            Zend_Db_Table::setDefaultAdapter($storageSlave);
			
            //Unclean
            unset($options_storage);

            //Push to queue
            self::$arrStorage[] = $storageSlave;
        }		

        //Return storage
        return $storageSlave;
    }
	
	/**
     * Close all mysqli connection
     * @return <bool>
     */
    public static function closeAllDb(){        
        //Loop to close connection
        if(sizeof(self::$arrStorage) > 0){
            //Loop to close connection
            foreach(self::$arrStorage as $storage){
                //Try close
                if(is_object($storage) && ($storage->isConnected())){
                    //Close connection
                    $storage->closeConnection();

                    //Set storage is null
                    unset($storage);
                }
            }

            //Set all list connection
            self::$arrStorage = array();
        }
    }		
}
?>