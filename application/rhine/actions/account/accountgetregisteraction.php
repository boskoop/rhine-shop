<?php namespace Rhine\Actions\Account;

use Laravel\View;

class AccountGetRegisterAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		$username = '';
		$email = '';
		$gender = '';
		$forename = '';
		$surname = '';
		$street1 = '';
		$street2 = '';
		$zip = '';
		$city = '';
		$country = '';

		return View::make('account.register')
		->with(compact('username'))
		->with(compact('email'))
		->with(compact('gender'))
		->with(compact('forename'))
		->with(compact('surname'))
		->with(compact('street1'))
		->with(compact('street2'))
		->with(compact('zip'))
		->with(compact('city'))
		->with(compact('country'));
	}

}