<?php

/**
 * @group endtoend
 */
class ShopRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the home-route.
	 *
	 * @return void
	 */
	public function testHome()
	{
		$response = $this->httpGet('/');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the shop-route.
	 *
	 * @return void
	 */
	public function testShop()
	{
		$response = $this->httpGet('shop');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the category-route. Expects 'seed_data' to create at least a category.
	 *
	 * @return void
	 */
	public function testCategory()
	{
		$category = Category::first();

		$response = $this->httpGet('category/'.$category->id);
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the category-route. Expects 'seed_data' not to create a category with
	 * id 100.
	 *
	 * @return void
	 */
	public function testCategoryNotFound()
	{
		$this->assertNull(Category::find(100));

		$response = $this->httpGet('category/100');
		$this->assertTrue($response->foundation->isNotFound());
	}

}