<?php namespace Tests;

use PHPUnit_Framework_TestCase;
use Laravel\Session;

abstract class PersistenceTestCase extends PHPUnit_Framework_TestCase {

	protected final function setUp()
	{
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