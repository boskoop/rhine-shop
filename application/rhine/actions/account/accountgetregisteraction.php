<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Laravel\Input;


class AccountGetRegisterAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		$username = Input::old('username');
		$email = Input::old('email');
		$title = Input::old('title');
		$forename = Input::old('forename');
		$surname = Input::old('surname');
		$street1 = Input::old('street1');
		$street2 = Input::old('street2');
		$zip = Input::old('zip');
		$city = Input::old('city');
		$country = Input::old('country');

		return View::make('account.register')
		->with(compact('username'))
		->with(compact('email'))
		->with(compact('title'))
		->with(compact('forename'))
		->with(compact('surname'))
		->with(compact('street1'))
		->with(compact('street2'))
		->with(compact('zip'))
		->with(compact('city'))
		->with(compact('country'));
	}

}