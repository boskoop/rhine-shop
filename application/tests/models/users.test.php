<?php

use Laravel\Hash;
use Laravel\Auth;

/**
 * @group integration
 */
class UsersTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testUserAttributes()
	{
		User::create(array(
			'username' => 'joe',
			'email' => 'joe@doe.com',
			'password' => 'secret',
			'role_id' => RoleEnum::ADMIN
		));

		$joe = User::find(1);
		$this->assertEquals('joe', $joe->username);
		$this->assertEquals('joe@doe.com', $joe->email);
		$this->assertEquals('secret', $joe->password);
		$this->assertEquals(RoleEnum::ADMIN, $joe->role_id);
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

		User::create(array(
			'username' => 'joe',
			'password' => Hash::make('secret')
		));

		$this->assertTrue(Auth::attempt($credentials));

		$modifiedCredentials = array('username' => 'joe', 'password' => 'wrong');
		$this->assertFalse(Auth::attempt($modifiedCredentials));
	}

	/**
	 * Tests if usernames are unique.
	 * 
	 * @expectedException Laravel\Database\Exception
	 * @return void
	 */
	public function testUsernameUnique()
	{
		User::create(array(
			'username' => 'joe'
		));

		User::create(array(
			'username' => 'joe'
		));
	}

	/**
	 * Tests the User model admin property.
	 *
	 * @return void
	 */
	public function testUserIsAdmin()
	{
		$admin = User::create(array(
			'id' => 1,
			'username' => 'admin',
			'role_id' => RoleEnum::ADMIN
		));
		$user1 = User::create(array(
			'id' => 2,
			'username' => 'user1',
			'role_id' => RoleEnum::USER
		));
		$user2 = User::create(array(
			'id' => 3,
			'username' => 'user2'
		));

		$this->assertTrue($admin->isAdmin());
		$this->assertFalse($user1->isAdmin());
		$this->assertFalse($user2->isAdmin());

		$admin = User::find(1);
		$user1 = User::find(2);
		$user2 = User::find(3);

		$this->assertTrue($admin->isAdmin());
		$this->assertFalse($user1->isAdmin());
		$this->assertFalse($user2->isAdmin());
	}

}