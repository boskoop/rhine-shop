<?php

use Tests\Builder\EloquentPersister;
use Tests\Builder\ProductBuilder;

class ProductsTest extends Tests\PersistenceTestCase {

	/**
	 * Tests the User table attributes.
	 *
	 * @return void
	 */
	public function testProductAttributes()
	{
		$product = ProductBuilder::aProduct()
				->withName('donald')
				->withCategoryId(1)
				->withPrice(1000)
				->withStocksize(10)
				->buildWith(new EloquentPersister);

		$donald = Product::find(1);
		$this->assertEquals('donald', $donald->name);
		$this->assertEquals(1, $donald->category_id);
		$this->assertEquals(1000, $donald->price);
		$this->assertEquals(10, $donald->stocksize);
	}

}