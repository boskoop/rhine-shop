<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Laravel\Session;
use Laravel\Cookie;
use Laravel\Config;

abstract class PersistenceTestCase extends PHPUnit_Framework_TestCase {

	private $tempSessionDriver;

	protected final function setUp()
	{
		echo "\nPersistenceTestCase: running ".get_class($this)."->".$this->getName()."()";

		PersistenceTestHelper::cleanDatabase();

		// Initialize the session (session is retrieved via cookie)
		$tempSessionDriver = Config::get('session.driver');
		Config::set('session.driver', 'database');
		Session::load();

		$this->setUpInternal();
	}

	protected final function tearDown()
	{
		// Reset session driver
		Config::set('session.driver', $this->tempSessionDriver);

		$this->tearDownInternal();
	}

	/**
	 * Template method, is called on PHPUnit setUp().
	 *
	 * @return void
	 */
	protected function setUpInternal() { }

	/**
	 * Template method, is called on PHPUnit tearDown().
	 *
	 * @return void
	 */
	protected function tearDownInternal() { }

}