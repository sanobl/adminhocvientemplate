<?php
class Core_Plugin_Env extends Zend_Controller_Plugin_Abstract
{	
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        //Set parent params
        Zend_Registry::set(PARENT_PARAMS_CONFIG, $request->getParams());

		$module = strtolower($request->getParam('module', 'default'));
        $controller = strtolower($request->getParam('controller', 'index'));  
        $action = strtolower($request->getParam('action', 'index'));
		
		//Get application configuration
		$app = Core_Global::getApplicationIni();	
		
		//Layout setup
		$layoutInstance = Zend_Layout::startMvc(
			array(
				'layout'     => 'main',
				'viewSuffix' => 'php',
				'layoutPath' => APPLICATION_PATH.'/modules/'.$module.'/views/layouts',
			)
		);
		
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		if (null === $viewRenderer->view){
			$viewRenderer->initView();
		}

		$viewRenderer->setViewSuffix('php');

		//Get current view
		$viewInstance = $layoutInstance->getView();		

		$viewInstance->addBasePath(APPLICATION_PATH .'/modules/'.$module.'/views');
		$viewInstance->addHelperPath(APPLICATION_PATH .'/modules/'.$module.'/views/helpers');				
		
		//Register language and default configuration
		$viewInstance->app = $app->app;
		$viewInstance->api = $app->api;
		
		$loaders[$module] = new Zend_Application_Module_Autoloader(array( 
			'namespace' => NULL, 
			'basePath'  => APPLICATION_PATH.'/modules/'.$module,
		));					
		$widgets = 'widgets';
		$loaders[$module]->addResourceTypes(array(			
			'Form'    => array(
				'namespace' => 'Form',
				'path'      => 'forms',
			),
			'Filter'    => array(
				'namespace' => 'Form_Filter',
				'path'      => 'forms/filters',
			),
			'Model'    => array(
				'namespace' => 'Model',
				'path'      => 'models',
			),	
			'Model_Base'    => array(
				'namespace' => 'Model_Base',
				'path'      => 'models/base',
			),							
			'Widget' => array(
				'namespace' => 'Widget',
				'path'      => $widgets,
			)
		));	
		
		//Core_Verify::getInstance()->allow();      
		
		//Cleanup data
		unset($layoutInstance, $viewInstance);
    }
	
    public function dispatchLoopShutdown(){        
       Core_Global::closeAllDb();		
    }
}