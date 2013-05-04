<?php

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

	/**
	 * Tests if category names are unique.
	 * 
	 * @expectedException Laravel\Database\Exception
	 * @return void
	 */
	public function testCategoryNameUnique()
	{
		$category1 = new Category;
		$category1->name = 'comic';
		$category1->order = 1;
		$category1->save();

		$category2 = new Category;
		$category2->name = 'comic';
		$category2->order = 2;
		$category2->save();
	}

	/**
	 * Tests if category order is unique.
	 * 
	 * @expectedException Laravel\Database\Exception
	 * @return void
	 */
	public function testCategoryOrderUnique()
	{
		$category1 = new Category;
		$category1->name = 'comic';
		$category1->order = 1;
		$category1->save();

		$category2 = new Category;
		$category2->name = 'dvd';
		$category2->order = 1;
		$category2->save();
	}
}