<?php

use Laravel\Hash;
use Laravel\Auth;

class UsersTest extends Tests\PersistenceTestCase {

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testUserAttributes()
	{
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

	/**
	 * Tests the login function.
	 *
	 * @return void
	 */
	public function testLogin()
	{
		$credentials = array('username' => 'joe', 'password' => 'secret');
		$this->assertFalse(Auth::attempt($credentials));

		$user = new User;
		$user->username = 'joe';
		$user->password = Hash::make('secret');
		$user->save();

		$this->assertTrue(Auth::attempt($credentials));

		$modifiedCredentials = array('username' => 'joe', 'password' => 'wrong');
		$this->assertFalse(Auth::attempt($modifiedCredentials));
	}
}