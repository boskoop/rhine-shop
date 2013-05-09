<?php

class CategoriesTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testCategoryAttributes()
	{
		Category::create(array(
			'name' => 'comic',
			'order' => 1
		));

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
		Category::create(array(
			'name' => 'comic',
			'order' => 1
		));

		Category::create(array(
			'name' => 'comic',
			'order' => 2
		));
	}

	/**
	 * Tests if category order is unique.
	 * 
	 * @expectedException Laravel\Database\Exception
	 * @return void
	 */
	public function testCategoryOrderUnique()
	{
		Category::create(array(
			'name' => 'comic',
			'order' => 1
		));

		Category::create(array(
			'name' => 'dvd',
			'order' => 1
		));
	}
}