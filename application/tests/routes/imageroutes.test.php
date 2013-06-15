<?php

/**
 * @group endtoend
 */
class ImageRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the product-image-route. Expects 'seed_data' to create at least a product-image.
	 *
	 * @return void
	 */
	public function testProductImage()
	{
		$image = ProductImage::first();

		$response = $this->httpGet('product/'.$image->id.'/image.png');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests the product-image-route. Expects 'seed_data' not to create a product-image with
	 * id 100.
	 *
	 * @return void
	 */
	public function testProductImageNotFound()
	{
		$this->assertNull(ProductImage::find(100));

		$response = $this->httpGet('product/100/image.png');
		$this->assertTrue($response->foundation->isNotFound());
	}

}