<?php

class Account_Controller extends Base_Controller {

	public function action_index()
	{
		$action = IoC::resolve('accountGetIndexAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_editprofile()
	{
		$user = Auth::user();

		$username = Input::old('username');
		$email = Input::old('email');
		$inputUser = new User(array('username' => $username, 'email' => $email));

		$action = IoC::resolve('accountGetEditProfileAction');
		return $action->execute($user, $inputUser);
	}

	public function action_saveprofile()
	{
		$input = Input::get();

		$action = IoC::resolve('accountPostEditProfileAction');
		return $action->execute($input);
	}

	public function action_login()
	{
		$action = IoC::resolve('accountGetLoginAction');
		return $action->execute();
	}

	public function action_address()
	{
		$action = IoC::resolve('accountGetAddressAction');
		$user = Auth::user();
		return $action->execute($user);
	}

}