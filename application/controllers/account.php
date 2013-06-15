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
		$action = IoC::resolve('accountGetEditProfileAction');
		$user = Auth::user();

		$username = Input::old('username');
		$email = Input::old('email');
		$inputUser = new User(array('username' => $username, 'email' => $email));

		return $action->execute($user, $inputUser);
	}

	public function action_saveprofile()
	{
		$action = IoC::resolve('accountPostEditProfileAction');
		$user = Auth::user();

		$input = Input::get();
		return $action->execute($user, $input);
	}

	public function action_login()
	{
		if (Auth::check()) {
			return Redirect::to_route('account');
		}

		$action = IoC::resolve('accountGetLoginAction');
		return $action->execute();
	}

	public function action_address()
	{
		$action = IoC::resolve('accountGetAddressAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_editaddress()
	{
		$action = IoC::resolve('accountGetEditAddressAction');
		$user = Auth::user();

		if (Session::has('errors')) {
			$inputAddress = new Address(array(
				'gender_id' => Input::old('title'),
				'forename' => Input::old('forename'),
				'surname' => Input::old('surname'),
				'street1' => Input::old('street1'),
				'street2' => Input::old('street2'),
				'zip' => Input::old('zip'),
				'city' => Input::old('city'),
				'country' => Input::old('country')
			));
		} else {
			$inputAddress = null;
		}
		return $action->execute($user, $inputAddress);
	}

	public function action_saveaddress()
	{
		$action = IoC::resolve('accountPostEditAddressAction');
		$user = Auth::user();

		$input = Input::get();
		return $action->execute($user, $input);
	}

	public function action_register()
	{
		if (Auth::check()) {
			return Redirect::to_route('account');
		}

		$action = IoC::resolve('accountGetRegisterAction');

		return $action->execute();
	}

	public function action_doregister()
	{
		if (Auth::check()) {
			return Redirect::to_route('account');
		}

		$action = IoC::resolve('accountPostRegisterAction');

		$input = Input::get();
		return $action->execute($input);
	}

	public function action_deleteprofile()
	{
		$action = IoC::resolve('accountGetDeleteProfileAction');
		$user = Auth::user();
		return $action->execute($user);
	}

	public function action_confirmdeleteprofile()
	{
		$action = IoC::resolve('accountPostDeleteProfileAction');
		$user = Auth::user();

		$input = Input::get();
		return $action->execute($user, $input);
	}

}