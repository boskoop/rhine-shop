<?php namespace Rhine\Services;

use Rhine\DomainModels\Order\OrderBo;
use User;

interface OrderService
{

	/**
	 * Loads open orders from the database and wraps them into a business object.
	 * 
	 * @return OrderBo[]
	 */
	function loadOpenOrdersFor(User $user);

	/**
	 * Loads open completed from the database and wraps them into a business object.
	 * 
	 * @return OrderBo[]
	 */
	function loadCompletedOrdersFor(User $user);

	/**
	 * Loads an order for given orderId and user from the database and wraps it into a business object.
	 * 
	 * @throws OrderNotFoundException if there is no order for the user with given id
	 * @return OrderBo, null if the orderId does not exist for the user
	 */
	function loadOrderFor(User $user, $orderId);

}