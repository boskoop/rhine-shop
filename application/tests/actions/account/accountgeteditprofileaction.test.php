<?php

use Rhine\Actions\Account\AccountGetEditProfileAction;

class AccountGetEditProfileActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new AccountGetEditProfileAction();
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$user = new User(array('id' => 1, 'username' => 'user'));

		$response = $this->action->execute($user);

		$this->assertResponseViewNameIs('account.editprofile', $response);
	}

	/**
	 * Tests the action if the user is not logged in.
	 *
	 * @return void
	 * @expectedException \LogicException
	 */
	public function testNotAuthenticated()
	{
		$this->action->execute(null);
	}

}