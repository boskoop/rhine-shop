<?php

final class GenderEnum
{

	const MALE = 1;
	const FEMALE = 2;

	/**
	 * Constructor should not be visible
	 */
	private function __construct()
	{}

	/**
	 * Retuns all available genders in an array
	 * 
	 * @return array
	 */
	public static function all()
	{
		return array(MALE, FEMALE);
	}

}