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

	/**
	 * Tests the association between Category and Product if multiple Products
	 * are added subsequently.
	 *
	 * @return void
	 */
	public function testSubsequentlyProductInserts()
	{
		$category = Category::create(array(
			'name' => 'comic',
			'order' => 1
		));
		$product1 = new Product(array('name' => 'donald',
			'price' => 1000,
			'stocksize' => 10
		));
		$product2 = new Product(array('name' => 'mickey mouse',
			'price' => 2000,
			'stocksize' => 20
		));

		$product1 = $category->products()->insert($product1);
		$product2 = $category->products()->insert($product2);

		$products = Category::find(1)->products()->order_by('name', 'asc')->get();

		$this->assertEquals(2, count($products));
		$this->assertEquals('donald', $products[0]->name);
		$this->assertEquals('mickey mouse', $products[1]->name);
	}

}