<?php namespace Rhine\Services;

use Rhine\DomainModels\Order\OrderBo;
use User;

interface OrderService
{

	/**
	 * Loads open orders from the database an wraps them into a business object.
	 * 
	 * @return OrderBo[]
	 */
	function loadOpenOrdersFor(User $user);

	/**
	 * Loads open completed from the database an wraps them into a business object.
	 * 
	 * @return OrderBo[]
	 */
	function loadCompletedOrdersFor(User $user);

}