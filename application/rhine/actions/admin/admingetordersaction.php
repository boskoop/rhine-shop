<?php namespace Rhine\Actions\Admin;

use Laravel\View;
use Rhine\Services\OrderService;
use User;

class AdminGetOrdersAction
{

	private $orderService;

	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		$orders = $this->orderService->loadOrdersPaginated();

		return View::make('admin.orders')
		->with(compact('orders'))
		->with(compact('user'));
	}

}