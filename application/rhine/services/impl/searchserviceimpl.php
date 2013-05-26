<?php namespace Rhine\Services\Impl;

use Rhine\Services\SearchService;
use Rhine\Repositories\ProductRepository;
use Product;

class SearchServiceImpl implements SearchService
{
	
	private $productRepository;

	function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}

	function searchProduct($query)
	{
		$response = $this->productRepository->searchByProductNamePaginated($query);
		return $response;
	}

}