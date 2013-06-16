<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use Rhine\Repositories\OrderRepository;
use User;

class AdminPostDeleteOrderAction
{

	private $orderRepository;

	public function __construct(OrderRepository $orderRepository)
	{
		$this->orderRepository = $orderRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null, $orderId)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		$this->orderRepository->deleteOrder($orderId);

		return Redirect::to_route('manage_orders');
	}

}