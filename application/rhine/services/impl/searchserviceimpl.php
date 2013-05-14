<?php namespace Rhine\Services\Impl;

use Rhine\Services\SearchService;
use Rhine\Repositories\ProductRepository;
use Product;
use Laravel\Paginator;

class SearchServiceImpl implements SearchService
{
	
	private $productRepository;

	function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}

	function searchProduct($query)
	{
		// dummy implemation
		return Paginator::make(array(), 0, 6);
	}

}