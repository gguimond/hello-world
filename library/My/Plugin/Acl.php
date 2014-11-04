<?php
class My_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	protected $acl;
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$opts =  Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('resources');
		echo $opts["frontController"]["controllerDirectory"];
		$translate = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('Translate');
		print $translate->_("title") . "\n";
		
		$this->acl = $this->getCache()->load("mykey");
		if(!$this->acl){
			$helper= new My_Acl();
			$helper->setRoles();
			$helper->setResources();
			$helper->setPrivileges();
			$helper->setAcl();
			$this->getCache()->save($helper, "mykey");
		}
		
		
		$acl = Zend_Registry::get('acl');
		$usersNs = new Zend_Session_NameSpace("members");
		if($usersNs->userType==""){
		$roleName='guest';
	} else {
		$userType = $usersNs->userType;
		$roleName=$userType;
	}
	$privilageName=$request->getActionName();
	echo $privilageName;
	echo $roleName;
	if(!$acl->isAllowed($roleName,$privilageName)){
		$request->setControllerName('Error');
		$request->setActionName('error');
	}
}

protected function getCache()
{
	static $cache = null;

	if ($cache === null) {
		$frontendOptions = array(
				'lifetime' => 5,
				'automatic_serialization' => true
		);
		$backendOptions = array(
				'cache_dir' => APPLICATION_PATH . '/cache'
		);
		$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
	}
	return $cache;
}
}