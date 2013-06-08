<?php

abstract class GenderEnum
{

	const MALE = 1;
	const FEMALE = 2;

	/**
	 * Retuns all available genders in an array
	 * 
	 * @return array
	 */
	public static function all()
	{
		return array(GenderEnum::MALE, GenderEnum::FEMALE);
	}

}