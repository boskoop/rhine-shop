<?php

use Rhine\Actions\Account\AccountGetLoginAction;

class AccountGetLoginActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new AccountGetLoginAction();
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$response = $this->action->execute();

		$this->assertResponseViewNameIs('account.login', $response);
	}

}