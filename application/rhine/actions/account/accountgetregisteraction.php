<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Laravel\Auth;
use Laravel\Redirect;

class AccountGetRegisterAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		if (Auth::check()) {
			return Redirect::to_route('account');
		}

		return View::make('account.register');
	}

}