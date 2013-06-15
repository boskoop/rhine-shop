<?php namespace Rhine\Services\Validators\Account;

use Laravel\Validator;
use Rhine\Services\Validators\ValidationException;
use Address;

class CaptchaValidator
{

	/**
	 * @throws ValidationException
	 */
	public function validate($input)
	{
		$rules = array(
			'captcha' => 'required|laracaptcha',
			);
		$messages = array(
			'laracaptcha' => __('rhine/account.captcha_error'),
			);

		$validation = Validator::make($input, $rules, $messages);

		if ($validation->fails()) {
			throw new ValidationException($validation);
		}
	}

}