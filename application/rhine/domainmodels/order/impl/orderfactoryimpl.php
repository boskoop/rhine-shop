<?php namespace Rhine\DomainModels\Order\Impl;

use Rhine\DomainModels\Order\OrderFactory;

class OrderFactoryImpl implements OrderFactory
{

	public function createFromOrder(Order $order);
	{
		$orderBo new OrderImpl($order);
		$items = $order->items()->get();
		$orderBo->loadItems($items);
		return $orderBo;
	}

}