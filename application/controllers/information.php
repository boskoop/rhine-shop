<?php

class Information_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('informationGetIndexAction');
		return $action->execute();
	}

}