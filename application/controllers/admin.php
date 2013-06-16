<?php

class Admin_Controller extends Base_Controller
{

	public function action_orders()
	{
		$action = IoC::resolve('adminGetOrdersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_payorder()
	{
		$action = IoC::resolve('adminGetOrdersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_shiporder()
	{
		$action = IoC::resolve('adminGetOrdersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_deleteorder()
	{
		$action = IoC::resolve('adminGetOrdersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

}