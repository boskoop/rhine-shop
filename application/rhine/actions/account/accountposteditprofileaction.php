<?php namespace Rhine\Actions\Account;

use Laravel\Auth;
use Laravel\Redirect;
use Rhine\Services\Validators\User\UserValidator;

class AccountPostEditProfileAction
{

	private $userValidator;

	public function __construct(UserValidator $userValidator)
	{
		$this->userValidator = $userValidator;
	}

	/**
	 * @return Redirect
	 */
	public function execute($input)
	{
		$user = Auth::user();
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		$this->userValidator->validate($user, $input);


		return Redirect::to_route('profile');
	}

}