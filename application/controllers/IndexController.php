<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    	$client = new Zend_Http_Client('http://www.google.fr', array(
    			'maxredirects' => 0,
    			'timeout'      => 30,
    			'adapter'    => 'Zend_Http_Client_Adapter_Proxy',
    			'proxy_host' => 'c-proxy.rd.francetelecom.fr',
    			'proxy_port' => 3128
    	));
    	$response = $client->request();
    	Zend_Debug::dump($response, "http", true);
    }


}

