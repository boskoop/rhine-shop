<?php namespace Rhine\Repositories;

use Product;

interface ProductRepository
{
	/**
	 * Returns the Products of a category ordered by their name.
	 * 
	 * @return Product[]
	 */
	function findByCategory($category);
	
	/**
	 * @return Product[]
	 */
	function findAllOrdered();

}