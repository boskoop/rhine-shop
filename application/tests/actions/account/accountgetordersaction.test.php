<?php

use Rhine\Actions\Account\AccountGetOrdersAction;
use Rhine\DomainModels\Order\Impl\OrderImpl;

/**
 * @group unit
 */
class AccountGetOrdersActionTest extends Tests\UnitTestCase
{

	private $action;

	private $orderServiceMock;

	protected function setUpInternal()
	{
		$this->orderServiceMock = $this->getMock('Rhine\Services\OrderService');
		$this->action = new AccountGetOrdersAction($this->orderServiceMock);
	}

	/**
	 * Tests the action if there are no open orders.
	 *
	 * @return void
	 */
	public function testNoOrders()
	{
		$user = new User(array('id' => 1, 'username' => 'user'));

		$this->orderServiceMock
		->expects($this->once())
		->method('loadOpenOrdersFor')
		->with($this->equalTo($user))
		->will($this->returnValue(array()));

		$response = $this->action->execute($user);

		$this->assertResponseViewNameIs('account.orders', $response);
		$this->assertEquals(array(), $response->data['orders']);
	}

	/**
	 * Tests the action if there is an open order.
	 *
	 * @return void
	 */
	public function testWithOrder()
	{
		$user = new User(array('id' => 1, 'username' => 'user'));
		$order = new OrderImpl(new Order(array('id' => 1)));

		$this->orderServiceMock
		->expects($this->once())
		->method('loadOpenOrdersFor')
		->with($this->equalTo($user))
		->will($this->returnValue(array($order)));

		$response = $this->action->execute($user);

		$this->assertResponseViewNameIs('account.orders', $response);
		$this->assertEquals(1, $response->data['orders'][0]->getOrderId());
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