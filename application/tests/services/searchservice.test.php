<?php

use Rhine\Services\Impl\SearchServiceImpl;

class SearchServiceTest extends Tests\UnitTestCase
{

	private $searchService;
	private $productRepositoryMock;

	protected function setUpInternal()
	{
		$this->productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');
		$this->searchService = new SearchServiceImpl($this->productRepositoryMock);
	}

	public function testSearchProduct()
	{
		$product = new Product(array('id' => 1,
			'name' => 'donald',
			'category_id' => 1,
			'price' => 1000,
			'stocksize' => 10));

		$this->productRepositoryMock
		->expects($this->once())
		->method('searchByProductNamePaginated')
		->with($this->equalTo('don'))
		->will($this->returnValue(array($product)));

		$response = $this->searchService->searchProduct('don');

		$this->assertEquals('donald', $response[0]->name);
		$this->assertEquals(1, sizeof($response));
	}


}
