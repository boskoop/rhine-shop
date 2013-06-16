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

	/**
	 * Returns the Order for given id and user.
	 * 
	 * @return Order, null if not found
	 */
	function findByIdAndUser($orderId, User $user);

	/**
	 * Persists the given order to the database.
	 */
	function persistOrder(User $user, Order $order, array $orderItems);

}