<?php

class Account_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('accountGetIndexAction');
		return $action->execute();
	}

	public function action_editprofile()
	{
		$action = IoC::resolve('accountGetEditProfileAction');
		return $action->execute();
	}

	public function action_saveprofile()
	{
		$input = Input::all();
		$action = IoC::resolve('accountPostEditProfileAction');
		return $action->execute($input);
	}

	public function action_login()
	{
		$action = IoC::resolve('accountGetLoginAction');
		return $action->execute();
	}

}