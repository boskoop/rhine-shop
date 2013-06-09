<?php

abstract class GenderEnum
{

	const MALE = 1;
	const MALE_VALUE = 'male';
	const FEMALE = 2;
	const FEMALE_VALUE = 'female';

	private static $map = array(
			GenderEnum::MALE => GenderEnum::MALE_VALUE, 
			GenderEnum::FEMALE => GenderEnum::FEMALE_VALUE
	);

	/**
	 * Retuns all available genders in an array
	 * 
	 * @return array
	 */
	public static function all()
	{
		return array(GenderEnum::MALE, 
			GenderEnum::FEMALE);
	}

	/**
	 * Retuns all available gender values in an array
	 * 
	 * @return array
	 */
	public static function values()
	{
		return array(GenderEnum::MALE_VALUE, 
			GenderEnum::FEMALE_VALUE);
	}

	public static function getValue($key)
	{
		return self::$map[''.$key];
	}

}