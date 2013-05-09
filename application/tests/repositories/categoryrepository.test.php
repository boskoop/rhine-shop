<?php

use Rhine\Repositories\Eloquent\EloquentCategoryRepository;

class CategoryRepositoryTest extends Tests\PersistenceTestCase
{

	private $categoryRepository;

	protected function setUpInternal()
	{
		$this->categoryRepository = new EloquentCategoryRepository;
	}

	/**
	 * Tests if findAllOrdered() returns categories in order.
	 *
	 * @return void
	 */
	public function testFindAllOrdered()
	{
		$this->insertCategory('c1', 1);
		$this->insertCategory('c5', 5);
		$this->insertCategory('c2', 2);
		$this->insertCategory('c4', 4);
		$this->insertCategory('c3', 3);

		$orderedCategories = $this->categoryRepository->findAllOrdered();
		$i = 1;
		foreach ($orderedCategories as $category) {
			$this->assertEquals($i, $category->order);
			$i++;
		}
	}

	/**
	 * Tests the function findById().
	 *
	 * @return void
	 */
	public function testFindById()
	{
		$this->assertNull($this->categoryRepository->findById(10));
		$this->assertNull($this->categoryRepository->findById(20));

		Category::create(array(
			'id' => 10,
			'name' => 'c1',
			'order' => 1
			));

		$this->assertNotNull($this->categoryRepository->findById(10));
		$this->assertNull($this->categoryRepository->findById(20));
	}

	private function insertCategory($name, $order)
	{
		return Category::create(array(
			'name' => $name,
			'order' => $order
			));
	}

}