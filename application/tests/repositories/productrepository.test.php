<?php

use Rhine\Repositories\Eloquent\EloquentProductRepository;

class ProductRepositoryTest extends Tests\PersistenceTestCase
{

	private $productRepository;

	protected function setUpInternal()
	{
		$this->productRepository = new EloquentProductRepository;
	}

	/**
	 * Tests if findByCategory() returns Products in order.
	 *
	 * @return void
	 */
	public function testFindByCategory_ordered()
	{
		$category1 = $this->insertCategory('c1', 1);
		$this->insertProduct('b', $category1, 10, 10);
		$this->insertProduct('c', $category1, 10, 10);
		$this->insertProduct('a', $category1, 10, 10);

		$products = $this->productRepository->findByCategoryOrderedAndPaginated($category1)->results;

		$this->assertEquals(3, count($products));
		$this->assertEquals('a', $products[0]->name);
		$this->assertEquals('b', $products[1]->name);
		$this->assertEquals('c', $products[2]->name);
	}

	/**
	 * Tests if findByCategory() only returns Products for the given Category.
	 *
	 * @return void
	 */
	public function testFindByCategory_multiCategories()
	{
		$category1 = $this->insertCategory('c1', 1);
		$this->insertProduct('p1', $category1, 10, 10);

		$category2 = $this->insertCategory('c2', 2);
		$this->insertProduct('p2', $category2, 10, 10);

		$products = $this->productRepository->findByCategoryOrderedAndPaginated($category1)->results;
		$this->assertEquals(1, count($products));
		$this->assertEquals('p1', $products[0]->name);

		$products = $this->productRepository->findByCategoryOrderedAndPaginated($category2)->results;
		$this->assertEquals(1, count($products));
		$this->assertEquals('p2', $products[0]->name);
	}

	/**
	 * Tests if findAllOrdered() returns Products in order.
	 *
	 * @return void
	 */
	public function testFindAllOrdered()
	{
		$category1 = $this->insertCategory('c1', 1);
		$this->insertProduct('y', $category1, 10, 10);
		$this->insertProduct('z', $category1, 10, 10);
		$this->insertProduct('x', $category1, 10, 10);

		$products = $this->productRepository->findAllOrderedAndPaginated()->results;

		$this->assertEquals(3, count($products));
		$this->assertEquals('x', $products[0]->name);
		$this->assertEquals('y', $products[1]->name);
		$this->assertEquals('z', $products[2]->name);
	}

	/**
	 * Tests the function findById().
	 *
	 * @return void
	 */
	public function testFindById()
	{
		$this->assertNull($this->productRepository->findById(10));
		$this->assertNull($this->productRepository->findById(20));

		Product::create(array(
			'id' => 10,
			'name' => 'p1',
			'price' => 100,
			'stocksize' => 100
			));

		$this->assertNotNull($this->productRepository->findById(10));
		$this->assertNull($this->productRepository->findById(20));
	}

	/**
	 * Tests the function searchByProductNamePaginated().
	 *
	 * @return void
	 */
	public function testSearchByProductNamePaginated()
	{
		$result = $this->productRepository->searchByProductNamePaginated(null);
		$this->assertEquals(0, sizeof($result->results));
		$result = $this->productRepository->searchByProductNamePaginated('don');
		$this->assertEquals(0, sizeof($result->results));

		Product::create(array(
			'id' => 10,
			'name' => 'donald',
			'price' => 100,
			'stocksize' => 100
			));
		$result = $this->productRepository->searchByProductNamePaginated('don');
		$this->assertEquals(1, sizeof($result->results));
		$this->assertEquals('donald', $result->results[0]->name);

		Product::create(array(
			'id' => 20,
			'name' => 'don',
			'price' => 200,
			'stocksize' => 200
			));
		$result = $this->productRepository->searchByProductNamePaginated('don');
		$this->assertEquals(2, sizeof($result->results));
	}

	private function insertCategory($name, $order)
	{
		return Category::create(array(
			'name' => $name,
			'order' => $order
			));
	}

	private function insertProduct($name, $category, $price, $stocksize)
	{
		$product = new Product(array('name' => $name,
			'price' => $price,
			'stocksize' => $stocksize
			));
		$category->products()->insert($product);
	}

}