<?php

class Seed_Data_Task
{

	public function run($arguments)
	{
		User::create(array(
			'username' => 'admin',
			'email' => 'admin@localhost',
			'password' => Hash::make('1234')
		));
	}

	public function clean($arguments)
	{
		$admin = User::where('username', '=', 'admin')->first();
		$admin->delete();
	}

}