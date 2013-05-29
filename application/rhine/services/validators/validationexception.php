<?php namespace Rhine\Services\Validators;

use \Laravel\Validator;
use \Exception;

class ValidationException extends Exception
{
	
	private $validation;

	public function __construct(Validator $validation) {
		parent::__construct(implode(' ', $validation->errors->all()));
		$this->validation = $validation;
	}

	public function getValidation()
	{
		return $this->validation;
	}

}