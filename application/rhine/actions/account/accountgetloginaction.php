<?php namespace Rhine\Actions\Account;

use Laravel\View;

class AccountGetLoginAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('account.login');
	}

}