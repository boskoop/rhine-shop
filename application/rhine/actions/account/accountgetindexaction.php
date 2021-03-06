<?php namespace Rhine\Actions\Account;

use Laravel\View;
use User;

class AccountGetIndexAction
{

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		return View::make('account.index')
		->with(compact('user'));
	}

}