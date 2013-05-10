<?php

class Account_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('accountGetIndexAction');
		return $action->execute();
	}

}