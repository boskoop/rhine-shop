<?php

abstract class GenderEnum
{

	const MALE = 1;
	const MALE_VALUE = 'male';
	const FEMALE = 2;
	const FEMALE_VALUE = 'female';

	/**
	 * Retuns all available genders in an array
	 * 
	 * @return array
	 */
	public static function all()
	{
		return array(GenderEnum::MALE, GenderEnum::FEMALE);
	}

	/**
	 * Retuns all available gender values in an array
	 * 
	 * @return array
	 */
	public static function values()
	{
		return array(GenderEnum::MALE_VALUE, GenderEnum::FEMALE_VALUE);
	}

}