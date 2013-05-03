<?php

class TestExample extends PHPUnit_Framework_TestCase {

	protected function setUp() {
		Tests\PersistenceTestHelper::setUp();
	}

	/**
	 * Test that a given condition is met.
	 *
	 * @return void
	 */
	public function testSomethingIsTrue()
	{
		$this->assertTrue(true);	
	}

	/**
	 * Test that a given condition is met.
	 *
	 * @return void
	 */
	public function testSomethingIsTrue2()
	{
		$this->assertTrue(true);	
	}

}