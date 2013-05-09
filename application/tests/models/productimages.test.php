<?php

class ProductImagesTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the table attributes.
	 *
	 * @return void
	 */
	public function testProductImagesAttributes()
	{
		ProductImage::create(array('product_id' => 1,
			'file' => 'imagedata'
		));

		$image = ProductImage::find(1);
		$this->assertEquals(1, $image->product_id);
		$this->assertEquals('imagedata', $image->file);
	}

}