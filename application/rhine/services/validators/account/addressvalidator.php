<?php namespace Rhine\Services\Validators\Account;

use Laravel\Validator;
use Rhine\Services\Validators\ValidationException;
use Address;

class AddressValidator
{

	/**
	 * @throws ValidationException
	 */
	public function validate($input)
	{
		$rules = array(
			'title' => 'required|integer|exists:genders,id',
			'forename' => 'required|max:64',
			'surname' => 'required|max:64',
			'street1' => 'required|max:64',
			'street2' => 'max:64',
			'zip' => 'required|max:16',
			'city' => 'required|max:64',
			'country' => 'required|alpha|min:2|max:2|match:/^[A-Z]{2}$/',
			);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			throw new ValidationException($validation);
		}
	}

}