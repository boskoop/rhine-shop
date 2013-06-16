<?php namespace Rhine\Services;

class OrderNotFoundException extends \Exception
{

	public function __construct()
	{
		parent::__construct('There is no order for given id and user');
	}

}