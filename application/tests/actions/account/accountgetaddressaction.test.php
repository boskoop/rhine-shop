<?php

use Rhine\Actions\Account\AccountGetAddressAction;

class AccountGetAddressActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new AccountGetAddressAction();
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

		$this->assertResponseViewNameIs('account.address', $response);
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