<?php namespace Tests;

use PHPUnit_Framework_TestCase;

abstract class PersistenceTestCase extends PHPUnit_Framework_TestCase {

	protected final function setUp() {
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