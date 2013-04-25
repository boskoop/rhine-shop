<?php

class Shop_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('shopGetIndexAction');
		return $action->execute();
	}

}