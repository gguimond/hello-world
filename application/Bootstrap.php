<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initFrontControllerPlugins()
	{
		Zend_Session::start();
		/*$usersNs = new Zend_Session_NameSpace("members");
		$usersNs->userType = "";*/
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new My_Plugin_Acl());
	}
	
	public function _initLog()
	{
		$log = new Zend_Log();
		$file = __DIR__ . '/application.log';
		$writer = new Zend_Log_Writer_Stream($file);
		$log->addWriter($writer);
		return $log;
	}
	
	protected function _initRouter()
	{
		$frontController = Zend_Controller_Front::getInstance();
		$router = $frontController->getRouter();
		$route = new Zend_Controller_Router_Route('error',
				array('controller' => 'error','action'=>'error'));
		//$router->addRoute('default', $route);
	}
	
	public function _initTranslate(){
		$translate = new Zend_Translate(
				array(
						'adapter' => 'gettext',
						'content' => __DIR__ . '/source_fr.mo',
						'locale'  => 'fr'
				)
		);
		$translate->setLocale('fr');
		return $translate;
	}
}

