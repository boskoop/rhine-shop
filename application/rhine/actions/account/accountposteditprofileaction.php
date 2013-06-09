<?php namespace Rhine\Actions\Account;

use Laravel\Redirect;
use Laravel\Config;
use Laravel\Hash;
use Rhine\Services\Validators\UserValidator\UserValidator;
use Rhine\Services\Validators\ValidationException;
use User;

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
	public function execute(User $user, $input)
	{
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		try {
			$this->userValidator->validate($user, $input);
		} catch(ValidationException $e) {
			return Redirect::to_route('editprofile')
			->with_errors($e->getValidation())
			->with_input();
		}

		if ($input['username'] != $user->username) {
			$user->username = $input['username'];
		}
		if ($input['email'] != $user->email) {
			$user->email = $input['email'];
		}
		if (strlen($input['old_password']) > 0) {
			try {
				$this->userValidator->validateOldPassword($user, $input);
				$user->password = Hash::make($input['password']);
			} catch(ValidationException $e) {
				return Redirect::to_route('editprofile')
				->with_errors($e->getValidation())
				->with_input();
			}
		}
		$user->save();

		return Redirect::to_route('profile')->with('status', 'save_ok');
	}

}