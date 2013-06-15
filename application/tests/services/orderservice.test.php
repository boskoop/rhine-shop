<?php

use Rhine\Services\Impl\OrderServiceImpl;
use Rhine\DomainModels\Order\Impl\OrderImpl;

/**
 * @group unit
 */
class OrderServiceTest extends Tests\UnitTestCase
{

	private $orderService;

	private $orderFactoryMock;
	private $orderRepositoryMock;

	protected function setUpInternal()
	{
		$this->orderFactoryMock = $this->getMock('Rhine\DomainModels\Order\OrderFactory');
		$this->orderRepositoryMock = $this->getMock('Rhine\Repositories\OrderRepository');

		$this->orderService = new OrderServiceImpl($this->orderFactoryMock, $this->orderRepositoryMock);
	}

	public function testLoadOpenOrdersForUser()
	{
		$order1 = new Order(array('id' => 1,
			'user_id' => 1));
		$order2 = new Order(array('id' => 1,
			'user_id' => 1));
		$user = new User(array('id' => 1));

		$this->orderRepositoryMock
		->expects($this->once())
		->method('findOpenOrdersByUser')
		->with($this->equalTo($user))
		->will($this->returnValue(array($order1, $order2)));

		$this->orderFactoryMock
		->expects($this->at(0))
		->method('createFromOrder')
		->with($this->equalTo($order1))
		->will($this->returnValue(new OrderImpl($order1)));

		$this->orderFactoryMock
		->expects($this->at(1))
		->method('createFromOrder')
		->with($this->equalTo($order2))
		->will($this->returnValue(new OrderImpl($order2)));

		$orders = $this->orderService->loadOpenOrdersFor($user);

		$this->assertEquals(2, count($orders));
		$this->assertEquals($order1, $orders[0]->getOrderModel());
		$this->assertEquals($order2, $orders[1]->getOrderModel());
	}

	public function testLoadCompletedOrdersForUser()
	{
		$order1 = new Order(array('id' => 1,
			'user_id' => 1));
		$order2 = new Order(array('id' => 1,
			'user_id' => 1));
		$user = new User(array('id' => 1));

		$this->orderRepositoryMock
		->expects($this->once())
		->method('findCompletedOrdersByUser')
		->with($this->equalTo($user))
		->will($this->returnValue(array($order1, $order2)));

		$this->orderFactoryMock
		->expects($this->at(0))
		->method('createFromOrder')
		->with($this->equalTo($order1))
		->will($this->returnValue(new OrderImpl($order1)));

		$this->orderFactoryMock
		->expects($this->at(1))
		->method('createFromOrder')
		->with($this->equalTo($order2))
		->will($this->returnValue(new OrderImpl($order2)));

		$orders = $this->orderService->loadCompletedOrdersFor($user);

		$this->assertEquals(2, count($orders));
		$this->assertEquals($order1, $orders[0]->getOrderModel());
		$this->assertEquals($order2, $orders[1]->getOrderModel());
	}

}