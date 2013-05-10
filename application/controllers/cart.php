<?php

class Cart_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('cartGetIndexAction');
		return $action->execute();
	}

}