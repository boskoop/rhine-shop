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

}