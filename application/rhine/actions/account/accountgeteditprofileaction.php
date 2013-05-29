<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Laravel\Auth;
use Laravel\Redirect;
use User;

class AccountGetEditProfileAction
{

	/**
	 * @return View
	 */
	public function execute(User $input = null)
	{
		$user = Auth::user();
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		$username = $user->username;
		$email = $user->email;
		if ($input != null) {
			if ($input->username != null) {
				$username = $input->username;
			}
			if ($input->email != null) {
				$email = $input->email;
			}
		}

		return View::make('account.editprofile')
		->with(compact('username'))
		->with(compact('email'));
	}

}