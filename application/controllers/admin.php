<?php

class Admin_Controller extends Base_Controller
{

	public function action_orders()
	{
		$action = IoC::resolve('adminGetOrdersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

}