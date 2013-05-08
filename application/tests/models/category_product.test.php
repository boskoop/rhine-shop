<?php

class CategoryProductTest extends Tests\PersistenceTestCase {

	/**
	 * Tests the association between Category and Product if the Product is 
	 * inserted to the Category.
	 *
	 * @return void
	 */
	public function testOneToMany()
	{
		$category = Category::create(array(
			'name' => 'comic',
			'order' => 1
		));
		$product = new Product(array('name' => 'donald',
			'price' => 1000,
			'stocksize' => 10
		));

		$category->products()->insert($product);

		$product = Product::find(1);
		$this->assertEquals($category->id, $product->category_id);

		$product = Category::find(1)->products()->first();
		$this->assertEquals($category->id, $product->category_id);

		$category = Product::find(1)->category()->first();
		$this->assertEquals('comic', $category->name);
	}

}