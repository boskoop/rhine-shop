<?php namespace Rhine\Repositories;

use Order;
use User;

interface OrderRepository
{

	/**
	 * Returns an array of Orders which are open for the user.
	 * 
	 * @return Order[]
	 */
	function findOpenOrdersByUser(User $user);

	/**
	 * Returns an array of Orders which are completed for the user.
	 * 
	 * @return Order[]
	 */
	function findCompletedOrdersByUser(User $user);

}