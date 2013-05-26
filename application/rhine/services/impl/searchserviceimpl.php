<?php namespace Rhine\Services\Impl;

use Rhine\Services\SearchService;
use Rhine\Services\SearchQueryTooShortException;
use Rhine\Repositories\ProductRepository;
use Product;

class SearchServiceImpl implements SearchService
{
	
	private $productRepository;

	function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}

	function searchProduct(array $query)
	{
		if (count($query) < 1 || (count($query) == 1 && strlen($query[0]) < 3))  {
			throw new SearchQueryTooShortException($query);
		}

		$response = $this->productRepository->searchByProductNamePaginated($query);
		return $response;
	}

}