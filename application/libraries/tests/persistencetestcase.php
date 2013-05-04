<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Laravel\Session;

abstract class PersistenceTestCase extends PHPUnit_Framework_TestCase {

	protected final function setUp()
	{
		echo "\nPersistenceTestCase: running ".get_class($this)."->".$this->getName()."()";
		Session::load();

		PersistenceTestHelper::cleanDatabase();
		$this->setUpInternal();
	}

	/**
	 * Template method, is called on PHPUnit setUp().
	 *
	 * @return void
	 */
	protected function setUpInternal() { }

}