<?php namespace Rhine\Repositories;

use Product;

interface ProductRepository
{
	/**
	 * Returns the Products of a category ordered by their name and paginated.
	 * 
	 * @return Product[]
	 */
	function findByCategoryOrderedAndPaginated($category);
	
	/**
	 * @return Product[]
	 */
	function findAllOrderedAndPaginated();

}