<?php namespace Rhine\DomainModels\Order;

use Order;

interface OrderFactory
{

	/**
	 * @return OrderBo
	 */
	function createFromOrder(Order $order);

}
