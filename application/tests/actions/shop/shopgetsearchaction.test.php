<?php

use Rhine\Actions\Shop\ShopGetSearchAction;

class ShopGetSearchActionTest extends Tests\UnitTestCase
{

	private $action;

	private $searchServiceMock;
	private $categoryRepositoryMock;

	protected function setUpInternal()
	{
		$this->categoryRepositoryMock = $this->getMock('Rhine\Repositories\CategoryRepository');
		$this->searchServiceMock = $this->getMock('Rhine\Services\SearchService');

		$this->action = new ShopGetSearchAction($this->categoryRepositoryMock, $this->searchServiceMock);
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

		$this->searchServiceMock
		->expects($this->once())
		->method('searchProduct')
		->with($this->equalTo('don'))
		->will($this->returnValue(array($product)));

		$response = $this->action->execute('don');

		$this->assertResponseViewNameIs('shop.search', $response);
		$this->assertEquals(1, count($response->data['products']));
		$this->assertEquals('donald', $response->data['products'][0]->name);
		$this->assertEquals(1, count($response->data['categories']));
		$this->assertEquals('comic', $response->data['categories'][0]->name);
		$this->assertEquals('don', $response->data['query']);
		$this->assertEquals(null, $response->data['activeCategory']);
	}

}