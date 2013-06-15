<?php

use Laravel\IoC;

/**
 * @group integration
 */
class ProductImageRepositoryTest extends Tests\PersistenceTestCase
{

	private $productImageRepository;

	protected function setUpInternal()
	{
		$this->productImageRepository = IoC::resolve('productImageRepository');
	}

	/**
	 * Tests if findByCategory() returns Products in order.
	 *
	 * @return void
	 */
	public function testFindByProductId()
	{
		ProductImage::create(array('product_id' => 1,
			'file' => 'imagedata1'
		));
		ProductImage::create(array('product_id' => 2,
			'file' => 'imagedata2'
		));

		$image = $this->productImageRepository->findByProductId(1);
		$this->assertEquals('imagedata1', $image->file);

		$image = $this->productImageRepository->findByProductId(2);
		$this->assertEquals('imagedata2', $image->file);

		$image = $this->productImageRepository->findByProductId(3);
		$this->assertNull($image);
	}

}