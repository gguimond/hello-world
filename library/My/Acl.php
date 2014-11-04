<?php
class My_Acl
{
	public $acl;
	
	public function __construct()
	{
		$this->acl = new Zend_Acl();
	}
	public function setRoles()
	{
		$this->acl->addRole(new Zend_Acl_Role('guest'));
		$this->acl->addRole(new Zend_Acl_Role('user'));
		$this->acl->addRole(new Zend_Acl_Role('admin'));

	}

	public function setResources()
	{
		$this->acl->add(new Zend_Acl_Resource('error'));
		$this->acl->add(new Zend_Acl_Resource('index'));
		$this->acl->add(new Zend_Acl_Resource('login'));
	}

	public function setPrivileges()
	{
		$this->acl->allow('guest',array('index','error','login'));
		$this->acl->allow('user',array('index','error','login'));
		$this->acl->allow('admin');
	}
	public function setAcl()
	{
		Zend_Registry::set('acl',$this->acl);
	}
}