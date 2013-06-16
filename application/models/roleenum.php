<?php

abstract class RoleEnum
{

	const ADMIN = 1;
	const ADMIN_VALUE = 'admin';
	const USER = 2;
	const USER_VALUE = 'user';

	private static $map = array(
			RoleEnum::ADMIN => RoleEnum::ADMIN_VALUE, 
			RoleEnum::USER => RoleEnum::USER_VALUE
	);

	/**
	 * Retuns all available roles in an array
	 * 
	 * @return array
	 */
	public static function all()
	{
		return array(RoleEnum::ADMIN, 
			RoleEnum::USER);
	}

	/**
	 * Retuns all available role values in an array
	 * 
	 * @return array
	 */
	public static function values()
	{
		return array(RoleEnum::ADMIN_VALUE, 
			RoleEnum::USER_VALUE);
	}

	public static function getValue($key)
	{
		return self::$map[''.$key];
	}

}