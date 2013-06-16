<?php

use Rhine\Actions\Admin\AdminGetOrdersAction;
use Rhine\DomainModels\Order\Impl\OrderImpl;

/**
 * @group unit
 */
class AdminGetOrdersActionTest extends Tests\UnitTestCase
{

	private $action;

	private $orderServiceMock;

	protected function setUpInternal()
	{
		$this->orderServiceMock = $this->getMock('Rhine\Services\OrderService');
		$this->action = new AdminGetOrdersAction($this->orderServiceMock);
	}

	/**
	 * Tests the action if there are no open orders.
	 *
	 * @return void
	 */
	public function testNoOrders()
	{
		$user = new User(array('id' => 1,
			'username' => 'admin',
			'role_id' => RoleEnum::ADMIN
			));

		$this->orderServiceMock
		->expects($this->once())
		->method('loadOrdersPaginated')
		->will($this->returnValue(array()));

		$response = $this->action->execute($user);

		$this->assertResponseViewNameIs('admin.orders', $response);
		$this->assertEquals(array(), $response->data['orders']);
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