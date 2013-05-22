<?php

class ProductRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the product-route. Expects 'seed_data' to create at least a product.
	 *
	 * @return void
	 */
	public function testProduct()
	{
		$product = Product::first();

		$response = $this->httpGet('product/'.$product->id);
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the product-route. Expects 'seed_data' not to create a product with
	 * id 100.
	 *
	 * @return void
	 */
	public function testProductNotFound()
	{
		$this->assertNull(Product::find(100));

		$response = $this->httpGet('product/100');
		$this->assertTrue($response->foundation->isNotFound());
	}

	/**
	 * Tests the product-route. Expects 'seed_data' to create at least a category.
	 *
	 * @return void
	 */
	public function testAddProduct()
	{
		$product = Product::first();

		$response = $this->httpPost('product/'.$product->id);
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the product-route. Expects 'seed_data' not to create a product with
	 * id 100.
	 *
	 * @return void
	 */
	public function testAddProductNotFound()
	{
		$this->assertNull(Product::find(100));

		$response = $this->httpPost('product/100');
		$this->assertTrue($response->foundation->isNotFound());
	}

}