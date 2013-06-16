<?php namespace Rhine\Repositories\Eloquent;

use User;
use Order;
use Rhine\Repositories\OrderRepository;

class EloquentOrderRepository implements OrderRepository
{
	
	public function findOpenOrdersByUser(User $user)
	{
		$orders = $user->orders()->where_null('shipped_at')->order_by('id', 'desc')->get();
		return $orders;
	}

	public function findCompletedOrdersByUser(User $user)
	{
		$orders = $user->orders()->where_not_null('shipped_at')->order_by('id', 'desc')->get();
		return $orders;
	}

	public function findByIdAndUser($orderId, User $user)
	{
		$order = $user->orders()->where('id', '=', $orderId)->first();
		return $order;
	}

	public function persistOrder(User $user, Order $order, array $orderItems)
	{
		$user->orders()->insert($order);
		foreach ($orderItems as $orderItem) {
			$order->items()->insert($orderItem);
		}
	}

}