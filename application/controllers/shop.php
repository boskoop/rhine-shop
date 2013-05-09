<?php

class Shop_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('shopGetIndexAction');
		return $action->execute();
	}

	public function action_category($id)
	{
		$action = IoC::resolve('shopGetCategoryAction');
		return $action->execute($id);
	}

}