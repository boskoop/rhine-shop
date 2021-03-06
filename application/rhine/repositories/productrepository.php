<?php namespace Rhine\Repositories;

use Product;

interface ProductRepository
{
	/**
	 * Returns the Products of a category ordered by their name and paginated.
	 * 
	 * @return Product[] (paginated)
	 */
	function findByCategoryOrderedAndPaginated($category);
	
	/**
	 * @return Product[] (paginated)
	 */
	function findAllOrderedAndPaginated();
	
	/**
	 * @return Product
	 */
	function findById($id);
	
	/**
	 * @return Product[] (paginated)
	 */
	function searchByProductNamePaginated(array $nameQuery);

}