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

		// PC Games
		$pcGamesId = Category::where('name', '=', 'PC Games')->first()->id;
		Product::create(array(
			'name' => 'Tomb Raider',
			'category' => $pcGamesId,
			'price' => 5900,
			'stocksize' => 10,
		));
		Product::create(array(
			'name' => 'Far Cry 3',
			'category' => $pcGamesId,
			'price' => 5900,
			'stocksize' => 10,
		));
		Product::create(array(
			'name' => 'Landwirtschafts-Simulator 2013',
			'category' => $pcGamesId,
			'price' => 2990,
			'stocksize' => 12,
		));

		// PS3 Games
		$ps3Id = Category::where('name', '=', 'Playstation 3')->first()->id;
		Product::create(array(
			'name' => 'Tomb Raider',
			'category' => $ps3Id,
			'price' => 6900,
			'stocksize' => 5,
		));
		Product::create(array(
			'name' => 'Far Cry 3',
			'category' => $ps3Id,
			'price' => 7500,
			'stocksize' => 10,
		));
		Product::create(array(
			'name' => 'NHL 13',
			'category' => $ps3Id,
			'price' => 3990,
			'stocksize' => 3,
		));
		Product::create(array(
			'name' => 'Gran Turismo 6',
			'category' => $ps3Id,
			'price' => 7900,
			'stocksize' => 0,
		));

		// Xbox Games
		$xbox360Id = Category::where('name', '=', 'Xbox 360')->first()->id;
		Product::create(array(
			'name' => 'Tomb Raider',
			'category' => $xbox360Id,
			'price' => 6900,
			'stocksize' => 8,
		));
		Product::create(array(
			'name' => 'Far Cry 3',
			'category' => $xbox360Id,
			'price' => 7500,
			'stocksize' => 10,
		));
		Product::create(array(
			'name' => 'NHL 13',
			'category' => $xbox360Id,
			'price' => 3990,
			'stocksize' => 4,
		));
		Product::create(array(
			'name' => 'Halo 4',
			'category' => $xbox360Id,
			'price' => 4990,
			'stocksize' => 6,
		));
	}

	public function clean($arguments)
	{
		$admin = User::where('username', '=', 'admin')->first();
		$admin->delete();

		$products = Product::all();
		foreach ($products as $product) {
			$product->delete();
		}
		$categories = Category::all();
		foreach ($categories as $category) {
			$category->delete();
		}
	}

}