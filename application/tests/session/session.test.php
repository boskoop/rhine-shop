<?php

use Laravel\Session;

/**
 * @group integration
 */
class SessionTest extends Tests\PersistenceTestCase
{

	public function testArraysInSession()
	{
		$this->assertFalse(Session::has('data'));

		$item = array(1, 2, 3);
		Session::put('data', $item);

		$this->assertTrue(Session::has('data'));

		$retrieved = Session::get('data');

		$this->assertEquals($item[0], 1);
		$this->assertEquals($item[1], 2);
		$this->assertEquals($item[2], 3);
	}

	public function testSessionClearance()
	{
		$this->assertFalse(Session::has('data'));
		$this->assertEquals(null, Session::get('data'));

		Session::put('data', 'payload');

		$this->assertTrue(Session::has('data'));
		$this->assertEquals('payload', Session::get('data'));

		// Reset the session WITHOUT saving
		Session::load();

		$this->assertFalse(Session::has('data'));
		$this->assertEquals(null, Session::get('data'));

		// Reset the session with saving
		Session::put('data', 'payload');
		Session::save();
		Session::load();

		$this->assertTrue(Session::has('data'));
		$this->assertEquals('payload', Session::get('data'));
	}

}