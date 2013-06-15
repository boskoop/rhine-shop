<?php

/**
 * @group integration
 */
class ProductsTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testProductAttributes()
	{
		Product::create(array('name' => 'donald',
			'category_id' => 1,
			'price' => 1000,
			'stocksize' => 10
		));

		$donald = Product::find(1);
		$this->assertEquals('donald', $donald->name);
		$this->assertEquals(1, $donald->category_id);
		$this->assertEquals(1000, $donald->price);
		$this->assertEquals(10, $donald->stocksize);
	}

}