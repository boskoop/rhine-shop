<?php

use Rhine\Actions\Image\ImageGetProductAction;

class ImageGetProductActionTest extends Tests\ActionTestCase
{

	private $action;

	private $productImageRepositoryMock;

	protected function setUpInternal()
	{
		$this->productImageRepositoryMock = $this->getMock('Rhine\Repositories\ProductImageRepository');

		$this->action = new ImageGetProductAction($this->productImageRepositoryMock,
			$this->productImageRepositoryMock);
	}

	/**
	 * Tests the action, if there is no valid product image.
	 *
	 * @return void
	 */
	public function testInvalidProductId()
	{
		$this->productImageRepositoryMock
		->expects($this->once())
		->method('findByProductId')
		->with($this->equalTo(1))
		->will($this->returnValue(null));

		$response = $this->action->execute(1);

		$this->assertResponse404($response);
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$image = new ProductImage(array('product_id' => 1,
			'file' => 'imagedata'
		));

		$this->productImageRepositoryMock
		->expects($this->once())
		->method('findByProductId')
		->with($this->equalTo(1))
		->will($this->returnValue($image));

		$response = $this->action->execute(1);

		$this->assertEquals('imagedata', $response);
	}

}