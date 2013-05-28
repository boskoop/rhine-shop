<?php namespace Rhine\Services\Validators;

use \Laravel\Messages;
use \Exception;

class ValidationException extends Exception
{
	
	private $validationMessages;

	public function __construct(Messages $messages) {
		parent::__construct(implode(' ', $messages->all()));
		$this->validationMessages = $messages;
	}

	public function getValidationMessages()
	{
		return $this->validationMessages;
	}

}