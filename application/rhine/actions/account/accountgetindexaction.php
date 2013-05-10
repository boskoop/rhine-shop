<?php namespace Rhine\Actions\Account;

use Laravel\View;

class AccountGetIndexAction
{

	/**
	 * @return View
	 */
	public function execute()
	{
		return View::make('account.index');
	}

}