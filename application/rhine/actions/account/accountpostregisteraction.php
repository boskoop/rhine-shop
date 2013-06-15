<?php namespace Rhine\Actions\Account;

use Laravel\View;
use Laravel\Redirect;
use Laravel\Hash;
use Rhine\Services\Validators\Account\AddressValidator;
use Rhine\Services\Validators\Account\UserValidator;
use Rhine\Services\Validators\Account\CaptchaValidator;
use Rhine\Services\Validators\ValidationException;
use Address;
use User;

class AccountPostRegisterAction
{

	private $userValidator;
	private $addressValidator;
	private $captchaValidator;

	public function __construct(UserValidator $userValidator, 
			AddressValidator $addressValidator,
			CaptchaValidator $captchaValidator)
	{
		$this->userValidator = $userValidator;
		$this->addressValidator = $addressValidator;
		$this->captchaValidator = $captchaValidator;
	}

	/**
	 * @return View
	 */
	public function execute($input)
	{
		try {
			$this->userValidator->validateNewUser($input);
			$this->addressValidator->validate($input);
			$this->captchaValidator->validate($input);
		} catch(ValidationException $e) {
			return Redirect::to_route('register')
			->with_errors($e->getValidation())
			->with_input();
		}

		$user = User::create(array(
			'username' => $input['username'],
			'email' => $input['email'],
			'password' => Hash::make($input['password'])
			));

		$address = new Address();
		$address->gender_id = $input['title'];
		$address->forename = $input['forename'];
		$address->surname = $input['surname'];
		$address->street1 = $input['street1'];
		$address->street2 = $input['street2'];
		$address->zip = $input['zip'];
		$address->city = $input['city'];
		$address->country = $input['country'];
		
		$user->address()->insert($address);

		return Redirect::to_route('login')
		->with('success', 'register_ok');
	}

}