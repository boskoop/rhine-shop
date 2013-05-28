<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Laravel\Auth;
use Laravel\Redirect;

class AccountGetEditProfileAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		$user = Auth::user();
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		return View::make('account.editprofile')
		->with(compact('user'));
	}

}