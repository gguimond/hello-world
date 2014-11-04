<?php
class AuthController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$this->_forward('login');
	}

	public function loginAction()
	{
		$auth = Zend_Auth::getInstance();

		// Configuration de l'adaptateur zend_auth
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter, 'user', 'email', 'password'); //, 'MD5');
		$authAdapter->setIdentity("toto@orange.com")
		->setCredential("titi");
		
		// Authentification
		$result = $auth->authenticate($authAdapter);
		if ($result->isValid()) {
			$data = $authAdapter->getResultRowObject(null, 'password');
			$auth->getStorage()->write($data);
			Zend_Debug::dump($data, "label", true);
		}
		
		// Echec : message d'erreur
		else {
			echo "wrong password";
		}
		
		$this->_helper->viewRenderer->setNoRender();
	}
	
}