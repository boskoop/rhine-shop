<?php namespace Rhine\Actions\Admin;

use Laravel\View;
use User;

class AdminGetUsersAction
{

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		$users = User::get();

		return View::make('admin.users')
		->with(compact('users'))
		->with(compact('user'));
	}

}