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

	public function action_addcategory()
	{
		$action = IoC::resolve('adminPostAddCategoryAction');
		$user = Auth::user();
		$name = Input::get('category');
		return $action->execute($user, $name);
	}

	public function action_deletecategory($categoryId)
	{
		$action = IoC::resolve('adminPostDeleteCategoryAction');
		$user = Auth::user();
		return $action->execute($user, $categoryId);
	}

	public function action_users()
	{
		$action = IoC::resolve('adminGetUsersAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_deleteuser($userId)
	{
		$action = IoC::resolve('adminPostDeleteUserAction');
		$user = Auth::user();
		return $action->execute($user, $userId);
	}

}