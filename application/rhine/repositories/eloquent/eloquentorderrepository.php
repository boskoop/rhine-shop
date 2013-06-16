<?php namespace Rhine\Repositories\Eloquent;

use User;
use Rhine\Repositories\OrderRepository;

class EloquentOrderRepository implements OrderRepository
{
	
	public function findOpenOrdersByUser(User $user)
	{
		$orders = $user->orders()->where_null('shipped_at')->get();
		return $orders;
	}

	public function findCompletedOrdersByUser(User $user)
	{
		$orders = $user->orders()->where_not_null('shipped_at')->get();
		return $orders;
	}

	function findByIdAndUser($orderId, User $user)
	{
		$order = $user->orders()->where('id', '=', $orderId)->first();
		return $order;
	}

}