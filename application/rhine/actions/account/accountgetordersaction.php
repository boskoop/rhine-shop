<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Rhine\Services\OrderService;
use User;

class AccountGetOrdersAction
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

		$orders = $this->orderService->loadOpenOrdersFor($user);

		return View::make('account.orders')
		->with(compact('orders'))
		->with(compact('user'));
	}

}