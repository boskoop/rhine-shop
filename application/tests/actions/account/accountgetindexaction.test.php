<?php

use Rhine\Actions\Account\AccountGetIndexAction;

/**
 * @group unit
 */
class AccountGetIndexActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new AccountGetIndexAction();
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

		$this->assertResponseViewNameIs('account.index', $response);
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