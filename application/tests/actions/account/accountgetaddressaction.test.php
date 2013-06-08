<?php

use Rhine\Actions\Account\AccountGetAddressAction;

class AccountGetAddressActionTest extends Tests\UnitTestCase
{

	private $action;

	private $addressRepositoryMock;

	protected function setUpInternal()
	{
		$this->addressRepositoryMock = $this->getMock('Rhine\Repositories\AddressRepository');
		$this->action = new AccountGetAddressAction($this->addressRepositoryMock);
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$user = new User(array('id' => 1, 'username' => 'user'));
		$address = new Address(array('id' => 1,
			'user_id' => 1,
			'forename' => 'Bart'
			));

		$this->addressRepositoryMock
		->expects($this->once())
		->method('findByUserId')
		->with($this->equalTo(1))
		->will($this->returnValue($address));

		$response = $this->action->execute($user);

		$this->assertResponseViewNameIs('account.address', $response);
		$this->assertEquals('user', $response->data['user']->username);
		$this->assertEquals('Bart', $response->data['address']->forename);
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