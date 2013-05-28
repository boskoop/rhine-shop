<?php namespace Rhine\Services\Validators\User;

use Laravel\Validator;
use Rhine\Services\Validators\ValidationException;
use User;

class UserValidator
{

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
			throw new ValidationException($validation->errors);
		}
	}

}