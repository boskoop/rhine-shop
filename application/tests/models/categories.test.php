<?php

use Laravel\Hash;
use Laravel\Auth;

class CategoriesTest extends Tests\PersistenceTestCase {

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testCategoryAttributes()
	{
		$category = new Category;
		$category->name = 'comic';
		$category->order = 1;
		$category->save();

		$comic = Category::find(1);
		$this->assertEquals('comic', $comic->name);
		$this->assertEquals(1, $comic->order);
	}
}