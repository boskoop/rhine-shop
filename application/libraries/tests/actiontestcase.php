<?php namespace Tests;

use PHPUnit_Framework_TestCase;

abstract class ActionTestCase extends PHPUnit_Framework_TestCase
{

	protected final function setUp()
	{
		echo "\nActionTestCase: running ".get_class($this)."->".$this->getName()."()";
		$this->setUpInternal();
		echo "\n";
	}

	/**
	 * Template method, is called on PHPUnit setUp().
	 *
	 * @return void
	 */
	protected function setUpInternal() { }


	// Assert-helpers
	protected function assertResponse404($response)
	{
		$this->assertInstanceOf('Laravel\Response', $response, 'Response is not an instance of Laravel\Response');
		$this->assertNotNull($response->foundation, 'Response foundation is null');
		$reponseCode = $response->foundation->getStatusCode();

		$this->assertEquals('404', $reponseCode, 'Expected 404 response but was: '.$reponseCode);
	}

	protected function assertResponseViewNameIs($name, $response)
	{
		$this->assertEquals($name, $response->view, 'Expected view name $name, but was: '.$response->view);
	}

}