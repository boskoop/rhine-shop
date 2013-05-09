<?php

class ProductProductImageTest extends Tests\PersistenceTestCase
{

	/**
	 * Tests the association between Product and ProductImage if the ProductImage is 
	 * inserted to the Product.
	 *
	 * @return void
	 */
	public function testOneToOne()
	{
		$product = Product::create(array('name' => 'donald',
			'price' => 1000,
			'stocksize' => 10
		));
		$image = new ProductImage(array('file' => 'imagedata'));

		$product->productImage()->insert($image);

		$image = ProductImage::find(1);
		$this->assertEquals($product->id, $image->product_id);

		$image = Product::find(1)->productImage()->first();
		$this->assertEquals($product->id, $image->product_id);

		$product = ProductImage::find(1)->product()->first();
		$this->assertEquals('donald', $product->name);
	}

}