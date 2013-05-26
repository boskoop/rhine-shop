<?php namespace Rhine\Services;

use Product;

interface SearchService
{
	/**
	 * @return Product[] (paginated)
	 */
	function searchProduct(array $query);

}