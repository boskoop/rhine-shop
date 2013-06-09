<?php namespace Rhine\Services\Validators\Account;

use Laravel\Validator;
use Laravel\Hash;
use Rhine\Services\Validators\ValidationException;
use User;

class UserValidator
{

	public function __construct()
	{
		// custom validator, checks if the field matches the password of the user with id of first parameter
		Validator::register('hashed_password', function($attribute, $value, $parameters)
		{
			return Hash::check($value, User::find($parameters[0])->password);
		});
	}

	/**
	 * @throws ValidationException
	 */
	public function validate(User $user, $input)
	{
		$rules = array(
			'username' => 'required|alpha_dash|min:3|max:32|unique:users,username,'.$user->id,
			'email' => 'required|email|max:128',
			'password' => 'required_with:old_password|min:6|confirmed|max:32',
			);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			throw new ValidationException($validation);
		}
	}

	public function validateOldPassword(User $user, $input)
	{
		$rules = array(
			'old_password' => 'hashed_password:'.$user->id,
			);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			throw new ValidationException($validation);
		}
	}

}