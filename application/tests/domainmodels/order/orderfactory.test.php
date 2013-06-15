<?php

use Rhine\DomainModels\Cart\Impl\CartFactoryImpl;
use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartPositionDto;

class OrderFactoryTest extends Tests\PersistenceTestCase
{

	private $orderFactory;

	protected function setUpInternal()
	{
		$this->orderFactory = IoC::resolve('orderFactory');
	}

	public function testEmpty()
	{
		$order = Order::create(array('id' => 1));

		$bo = $this->orderFactory->createFromOrder($order);
		$this->assertEquals(0, count($bo->getItems()));
		$this->assertEquals(1, $bo->getOrderId());
		$this->assertEquals(0, $bo->getTotalPrice());
		$this->assertFalse($bo->isPaid());
		$this->assertFalse($bo->isShipped());
	}

	public function testOrderItems()
	{
		$order = Order::create(array('id' => 5,
			'paid_at' => time(),
			'shipped_at' => time()));

		$item1 = new OrderItem(array('id' => 1,
			'price' => 200,
			'quantity' => 2,
			'product_name' => '1'));
		$item2 = new OrderItem(array('id' => 2,
			'price' => 300,
			'quantity' => 3,
			'product_name' => '2'));
		$item3 = new OrderItem(array('id' => 3,
			'price' => 500,
			'quantity' => 5,
			'product_name' => '3'));

		$order->items()->insert($item1);
		$order->items()->insert($item2);
		$order->items()->insert($item3);

		$bo = $this->orderFactory->createFromOrder($order);
		
		$this->assertEquals(3, count($bo->getItems()));
		$this->assertEquals(5, $bo->getOrderId());
		$this->assertEquals(3800, $bo->getTotalPrice());
		$this->assertTrue($bo->isPaid());
		$this->assertTrue($bo->isShipped());
	}

}