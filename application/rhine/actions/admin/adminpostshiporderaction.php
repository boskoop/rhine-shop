<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use Rhine\Services\OrderService;
use User;

class AdminPostShipOrderAction
{

	private $orderService;

	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null, $orderId)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		$order = null;
		try {
			$order = $this->orderService->loadOrder($orderId);
		} catch (OrderNotFoundException $e) {
			return Response::error('404');
		}

		if ($order->isShipped()) {
			$order->resetShipOrder();
		} else {
			$order->shipOrder();
		}
		$order->getOrderModel()->save();

		return Redirect::to_route('manage_orders');
	}

}