<?php

use Rhine\DomainModels\Order\Impl\OrderImpl;
use Rhine\DomainModels\Order\Impl\OrderItemImpl;

class OrderBusinessObjectTest extends Tests\UnitTestCase
{

	public function testGetOrderModel()
	{
		$order = new Order(array('id' => 10));
		$bo = new OrderImpl($order);

		$this->assertEquals(10, $bo->getOrderModel()->id);
	}

	public function testGetOrderId()
	{
		$order = new Order(array('id' => 10));
		$bo = new OrderImpl($order);

		$this->assertEquals(10, $bo->getOrderId());
	}

	public function testPayOrder()
	{
		$order = new Order(array('id' => 10));
		$bo = new OrderImpl($order);

		$this->assertFalse($bo->isPaid());

		$bo->payOrder();

		$this->assertTrue($bo->isPaid());
	}

	public function testShipOrder()
	{
		$order = new Order(array('id' => 10));
		$bo = new OrderImpl($order);

		$this->assertFalse($bo->isShipped());

		$bo->shipOrder();

		$this->assertTrue($bo->isShipped());
	}

	public function testGetItems()
	{
		$order = new Order(array('id' => 10));
		$bo = new OrderImpl($order);

		$item1 = new OrderItem(array('id' => 1,
			'product_name' => '1'));
		$item2 = new OrderItem(array('id' => 2,
			'product_name' => '2'));
		$item3 = new OrderItem(array('id' => 3,
			'product_name' => '3'));

		$this->assertEquals(0, count($bo->getItems()));

		$bo->setItems(array($item1));

		$this->assertEquals(1, count($bo->getItems()));
		$items = $bo->getItems();
		$this->assertEquals('1', $items[0]->getProductName());

		$bo->setItems(array($item2, $item3));

		$this->assertEquals(2, count($bo->getItems()));
		$items = $bo->getItems();
		$this->assertEquals('2', $items[0]->getProductName());
		$this->assertEquals('3', $items[1]->getProductName());
	}

	public function testGetTotalPrice()
	{
		$order = new Order(array('id' => 10));
		$bo = new OrderImpl($order);

		$item1 = new OrderItem(array('id' => 1,
			'price' => 1000,
			'quantity' => 2));
		$item2 = new OrderItem(array('id' => 2,
			'price' => 300,
			'quantity' => 3));

		$this->assertEquals(0, $bo->getTotalPrice());

		$bo->setItems(array($item1, $item2));

		$this->assertEquals(2900, $bo->getTotalPrice());
	}

	public function testOrderItemGetProductName()
	{
		$orderItem = new OrderItem(array('id' => 10,
			'product_name' => 'donald'));
		$bo = new OrderItemImpl($orderItem);

		$this->assertEquals('donald', $bo->getProductName());
	}

	public function testOrderItemGetCategoryName()
	{
		$orderItem = new OrderItem(array('id' => 10,
			'category_name' => 'comic'));
		$bo = new OrderItemImpl($orderItem);

		$this->assertEquals('comic', $bo->getCategoryName());
	}

}