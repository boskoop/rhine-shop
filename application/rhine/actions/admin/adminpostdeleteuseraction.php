<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use User;

class AdminPostDeleteUserAction
{

	/**
	 * @return View
	 */
	public function execute(User $admin = null, $userId)
	{
		if ($admin == null or !$admin->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		// TODO: use repository
		$user = User::find($userId);
		if ($user != null and !$user->isAdmin()) {
			$user->delete();
		}

		return Redirect::to_route('manage_users');
	}

}