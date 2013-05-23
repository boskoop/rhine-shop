<?php

use Rhine\Actions\Shop\ShopGetIndexAction;

class ShopGetIndexActionTest extends Tests\UnitTestCase
{

	private $action;

	private $categoryRepositoryMock;
	private $productRepositoryMock;

	protected function setUpInternal()
	{
		$this->categoryRepositoryMock = $this->getMock('Rhine\Repositories\CategoryRepository');
		$this->productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');

		$this->action = new ShopGetIndexAction($this->categoryRepositoryMock,
			$this->productRepositoryMock);
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

		$this->categoryRepositoryMock
		->expects($this->once())
		->method('findAllOrdered')
		->will($this->returnValue(array($category)));

		$this->productRepositoryMock
		->expects($this->once())
		->method('findAllOrderedAndPaginated')
		->will($this->returnValue(array($product)));

		$response = $this->action->execute();

		$this->assertResponseViewNameIs('shop.index', $response);
		$this->assertEquals(1, count($response->data['categories']));
		$this->assertEquals('comic', $response->data['categories'][0]->name);
		$this->assertEquals(1, count($response->data['products']));
		$this->assertEquals('donald', $response->data['products'][0]->name);
		$this->assertEquals(null, $response->data['activeCategory']);
	}

}