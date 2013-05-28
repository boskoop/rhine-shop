<?php

use Rhine\Actions\Account\AccountGetEditProfileAction;

class AccountGetEditActionTest extends Tests\PersistenceTestCase
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
		User::create(array('id' => 1, 'username' => 'user'));
		Auth::login(1);

		$response = $this->action->execute();

		$this->assertResponseViewNameIs('account.editprofile', $response);
		Auth::logout();
	}

	/**
	 * Tests the action if the user is not logged in.
	 *
	 * @return void
	 * @expectedException \LogicException
	 */
	public function testNotAuthorized()
	{
		$this->assertFalse(Auth::check());

		$this->action->execute();
	}

	private function assertResponseViewNameIs($name, $response)
	{
		$this->assertEquals($name, $response->view, 'Expected view name $name, but was: '.$response->view);
	}

}