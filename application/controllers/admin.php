<?php

class Admin_Controller extends Base_Controller
{

	public function action_orders()
	{
		$action = IoC::resolve('adminGetOrdersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_payorder($orderId)
	{
		$action = IoC::resolve('adminPostPayOrderAction');
		$user = Auth::user();
		return $action->execute($user, $orderId);
	}

	public function action_shiporder($orderId)
	{
		$action = IoC::resolve('adminPostShipOrderAction');
		$user = Auth::user();
		return $action->execute($user, $orderId);
	}

	public function action_deleteorder($orderId)
	{
		$action = IoC::resolve('adminPostDeleteOrderAction');
		$user = Auth::user();
		return $action->execute($user, $orderId);
	}

	public function action_categories()
	{
		$action = IoC::resolve('adminGetCategoriesAction');
		$user = Auth::user();
		return $action->execute($user);
	}

}