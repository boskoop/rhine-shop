<?php namespace Tests;

use \Laravel\CLI\Command;
use \Laravel\Request;
use \Laravel\Database\Schema;
use \DB;

class PersistenceTestHelper {

	public static function setUp()
	{
		static::checkTestEnv();
		echo "\nPersistenceTestHelper: cleaning database\n";

		require path('sys').'cli/dependencies'.EXT;
		if (!static::checkTableExists('laravel_migrations'))
		{
			echo "PersistenceTestHelper: creating migrations table\n";
			Command::run(array('migrate:install'));
			echo "\n";
		}

		Command::run(array('migrate:reset'));
		Command::run(array('migrate'));

		echo "PersistenceTestHelper: database cleaned!\n";
	}

	private static function checkTestEnv()
	{
		if (!Request::is_env('test'))
		{
			throw new Exception('PersistenceTestHelper called but env is not test');
		}
	}

	private static function checkTableExists($tableName)
	{
		$check = DB::only('SELECT name FROM sqlite_master WHERE type=\'table\' AND name=\''.$tableName.'\'');
		return $check;
	}

}