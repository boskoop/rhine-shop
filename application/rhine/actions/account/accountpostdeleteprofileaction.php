<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Laravel\Auth;
use Laravel\Redirect;
use Rhine\Services\Validators\Account\UserValidator;
use Rhine\Services\Validators\Account\CaptchaValidator;
use Rhine\Services\Validators\ValidationException;
use Address;
use User;

class AccountPostDeleteProfileAction
{

	private $userValidator;
	private $captchaValidator;

	public function __construct(UserValidator $userValidator, 
			CaptchaValidator $captchaValidator)
	{
		$this->userValidator = $userValidator;
		$this->captchaValidator = $captchaValidator;
	}

	/**
	 * @return View
	 */
	public function execute(User $user, $input)
	{
		if ($user == null) {
			throw new \LogicException('User not authorized!');
		}

		try {
			$this->captchaValidator->validate($input);
			$this->userValidator->validatePassword($user, $input);
		} catch(ValidationException $e) {
			return Redirect::to_route('deleteprofile')
			->with_errors($e->getValidation())
			->with_input();
		}

		Auth::logout();

		$user->delete();

		return Redirect::to_route('login')
		->with('success', 'delete_ok');
	}

}