<?php

class UsersTest extends Tests\PersistenceTestCase {

	/**
	 * Tests if the tables are empty when the tests runs.
	 *
	 * @return void
	 */
	public function testUserAttributes()
	{;
		$user = new User;
		$user->username = 'joe';
		$user->email = 'joe@doe.com';
		$user->password = 'secret';
		$user->save();

		$joe = User::find(1);
		$this->assertEquals('joe', $joe->username);
		$this->assertEquals('joe@doe.com', $joe->email);
		$this->assertEquals('secret', $joe->password);
	}
}