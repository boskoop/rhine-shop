<?php

/**
 * @group integration
 */
class RoleUserTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the association between Role and User.
	 *
	 * @return void
	 */
	public function testAssociation()
	{
		$role = Role::find(RoleEnum::ADMIN);
		$user = new User(array(
			'username' => 'joe',
			'email' => 'joe@doe.com',
			'password' => 'secret'
		));

		$role->users()->insert($user);

		$user = User::find(1);
		$this->assertEquals($role->id, $user->role_id);

		$user = Role::find(RoleEnum::ADMIN)->users()->first();
		$this->assertEquals($role->id, $user->role_id);

		$role = User::find(1)->role()->first();
		$this->assertEquals(RoleEnum::ADMIN, $role->id);
	}

}