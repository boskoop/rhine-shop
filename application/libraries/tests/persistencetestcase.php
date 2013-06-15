<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Laravel\Session;
use Laravel\Cookie;
use Laravel\Config;
use Laravel\Auth;
use Laravel\IoC;
use Rhine\RhineIoC;

abstract class PersistenceTestCase extends PHPUnit_Framework_TestCase {

	private $timer;

	private $tempSessionDriver;

	protected final function setUp()
	{
		$this->timer = new TestTimer();
		echo "\n\n================================================================================";
		echo "\nPersistenceTestCase: running ".get_class($this)."->".$this->getName()."()";

		PersistenceTestHelper::cleanDatabase();

		// Initialize IoC
		$ioc = new RhineIoC();
		$ioc->init();

		// Initialize the session (session is retrieved via cookie)
		$tempSessionDriver = Config::get('session.driver');
		Config::set('session.driver', 'database');
		Session::load();

		$this->setUpInternal();
	}

	protected final function tearDown()
	{
		Session::flush();
		Auth::logout();
		
		// Reset session driver
		Config::set('session.driver', $this->tempSessionDriver);

		$this->tearDownInternal();

		// Reset IoC
		IoC::$registry = array();
		IoC::$singletons = array();

		$timeTaken = $this->timer->getTimeTaken();
		echo "\nPersistenceTestCase: completed ".get_class($this)."->".$this->getName()."()";
		echo "\nPersistenceTestCase: took ".$timeTaken." seconds";
		echo "\n================================================================================\n";
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