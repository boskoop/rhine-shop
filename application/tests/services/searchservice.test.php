<?php

use Rhine\Services\Impl\SearchServiceImpl;

/**
 * @group unit
 */
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
		->with($this->equalTo(array('don')))
		->will($this->returnValue(array($product)));

		$response = $this->searchService->searchProduct(array('don'));

		$this->assertEquals('donald', $response[0]->name);
		$this->assertEquals(1, sizeof($response));
	}

	/**
	 * @expectedException Rhine\Services\SearchQueryTooShortException
	 */
	public function testQueryTooShort()
	{
		$response = $this->searchService->searchProduct(array('do'));
	}

}
