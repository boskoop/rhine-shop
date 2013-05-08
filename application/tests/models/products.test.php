<?php

class ProductsTest extends Tests\PersistenceTestCase {

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testProductAttributes()
	{
		$product = new Product;
		$product->name = 'donald';
		$product->category = 1;
		$product->price = 1000;
		$product->stocksize = 10;
		$product->save();

		$donald = Product::find(1);
		$this->assertEquals('donald', $donald->name);
		$this->assertEquals(1, $donald->category);
		$this->assertEquals(1000, $donald->price);
		$this->assertEquals(10, $donald->stocksize);
	}

}