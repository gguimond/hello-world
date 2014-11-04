<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

	public function testIndex(){
		$this->dispatch('/');
		$this->assertAction('index');
		$this->assertController('index');
		$this->assertQueryContentContains('h1', 'Welcome');
	}
}

