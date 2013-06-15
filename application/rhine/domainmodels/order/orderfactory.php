<?php namespace Rhine\DomainModels\Order;

interface OrderFactory
{

	/**
	 * @return OrderBo
	 */
	function createFromOrder(Order $order);

}
