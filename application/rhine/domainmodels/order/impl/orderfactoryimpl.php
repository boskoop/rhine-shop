<?php namespace Rhine\DomainModels\Order\Impl;

use Rhine\DomainModels\Order\OrderFactory;
use Order;

class OrderFactoryImpl implements OrderFactory
{

	public function createFromOrder(Order $order)
	{
		$orderBo = new OrderImpl($order);
		$items = $order->items()->get();
		$orderBo->setItems($items);
		return $orderBo;
	}

}