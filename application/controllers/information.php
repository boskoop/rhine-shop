<?php

class Information_Controller extends Base_Controller {

	public function action_about()
	{
		$action = IoC::resolve('informationGetAboutAction');
		return $action->execute();
	}

	public function action_contact()
	{
		$action = IoC::resolve('informationGetContactAction');
		return $action->execute();
	}

	public function action_tob()
	{
		$action = IoC::resolve('informationGetToBAction');
		return $action->execute();
	}

}