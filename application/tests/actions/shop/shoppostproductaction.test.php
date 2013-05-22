<?php

use Rhine\Actions\Shop\ShopPostProductAction;

class ShopPostProductActionTest extends Tests\ActionTestCase
{

	private $action;

	private $categoryRepositoryMock;
	private $productRepositoryMock;
	private $cartServiceMock;

	protected function setUpInternal()
	{
		$this->categoryRepositoryMock = $this->getMock('Rhine\Repositories\CategoryRepository');
		$this->productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');
		$this->cartServiceMock = $this->getMock('Rhine\Services\CartService');

		$this->action = new ShopPostProductAction($this->categoryRepositoryMock,
			$this->productRepositoryMock, $this->cartServiceMock);
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$category = new Category(array('id' => 1,
			'name' => 'comic',
			'order' => 1));
		$product = new Product(array('id' => 1,
			'name' => 'donald',
			'category_id' => 1,
			'price' => 1000,
			'stocksize' => 10));

		$this->cartServiceMock
		->expects($this->once())
		->method('addToCart')
		->with($this->equalTo(1));

		$this->productRepositoryMock
		->expects($this->once())
		->method('findById')
		->with($this->equalTo(1))
		->will($this->returnValue($product));

		$this->categoryRepositoryMock
		->expects($this->once())
		->method('findAllOrdered')
		->will($this->returnValue(array($category)));

		$this->categoryRepositoryMock
		->expects($this->once())
		->method('findByProduct')
		->with($this->equalTo($product))
		->will($this->returnValue($category));

		$response = $this->action->execute(1);

		$this->assertResponseViewNameIs('shop.addproduct', $response);
		$this->assertEquals(1, count($response->data['categories']));
		$this->assertEquals('comic', $response->data['categories'][0]->name);
		$this->assertEquals('donald', $response->data['product']->name);
		$this->assertEquals(null, $response->data['activeCategory']);
	}

	/**
	 * Tests the action, if the product is not found
	 *
	 * @return void
	 */
	public function testProductNotFound()
	{
		$this->productRepositoryMock
		->expects($this->once())
		->method('findById')
		->with($this->equalTo(1))
		->will($this->returnValue(null));

		$response = $this->action->execute(1);

		$this->assertResponse404($response);
	}

}