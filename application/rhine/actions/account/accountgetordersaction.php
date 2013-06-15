<?php namespace Rhine\Actions\Account;

use Laravel\View;
use User;

class AccountGetOrdersAction
{

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		return View::make('account.orders')
		->with(compact('user'));
	}

}