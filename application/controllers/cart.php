<?php

class Cart_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('cartGetIndexAction');
		return $action->execute();
	}

	public function action_addproduct($productId)
	{
		$action = IoC::resolve('cartPostAddProductAction');
		return $action->execute($productId);
	}

	public function action_subtractproduct($productId)
	{
		$action = IoC::resolve('cartPostSubtractProductAction');
		return $action->execute($productId);
	}

	public function action_deleteproduct($productId)
	{
		$action = IoC::resolve('cartPostDeleteProductAction');
		return $action->execute($productId);
	}

	public function action_checkout()
	{
		$action = IoC::resolve('cartGetCheckoutAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_processcheckout()
	{
		$action = IoC::resolve('cartPostCheckoutAction');
		$user = Auth::user();

		$input = Input::get();
		return $action->execute($user, $input);
	}

}