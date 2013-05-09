<?php

class PersistenceTestHelperTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests if the tables are empty when the tests runs.
	 *
	 * @return void
	 */
	public function testTablesEmpty()
	{
		$users = User::all();
		$this->assertEmpty($users);

		$user = new User;
		$user->save();

		$users = User::all();
		$this->assertNotEmpty($users);
	}

	/**
	 * Tests if the tables are empty again if a second tests runs.
	 *
	 * @return void
	 */
	public function testTablesEmptyAgain()
	{
		$users = User::all();
		$this->assertEmpty($users);

		$user = new User;
		$user->save();

		$users = User::all();
		$this->assertNotEmpty($users);
	}

}