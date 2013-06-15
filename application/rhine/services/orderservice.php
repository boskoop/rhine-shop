<?php namespace Rhine\Services;

use Rhine\DomainModels\Order\OrderBo;
use User;

interface OrderService
{

	/**
	 * Returns the cart.
	 * 
	 * @return OrderBo
	 */
	function loadOrders(User $user);

}