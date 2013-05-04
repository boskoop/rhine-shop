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
		foreach ($orderedCategories as $category)
		{
			$this->assertEquals($i, $category->order);
			$i++;
		}
	}

	private function insertCategory($name, $order)
	{
		$category = new Category;
		$category->name = $name;
		$category->order = $order;
		$category->save();
	}

}