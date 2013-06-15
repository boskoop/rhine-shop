<?php

use Rhine\Actions\Account\AccountGetOrdersAction;

/**
 * @group unit
 */
class AccountGetOrdersActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new AccountGetOrdersAction();
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

		$this->assertResponseViewNameIs('account.orders', $response);
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