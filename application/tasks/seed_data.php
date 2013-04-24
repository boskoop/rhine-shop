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

		Category::create(array(
			'name' => 'PC Games',
			'order' => 1
		));
		Category::create(array(
			'name' => 'Playstation 3',
			'order' => 2
		));
		Category::create(array(
			'name' => 'Xbox 360',
			'order' => 3
		));
	}

	public function clean($arguments)
	{
		$admin = User::where('username', '=', 'admin')->first();
		$admin->delete();

		$categories = Category::all();
		foreach ($categories as $category) {
			$category->delete();
		}
	}

}