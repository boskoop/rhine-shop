<?php namespace Rhine\Repositories;

use Category;

interface CategoryRepository
{
	/**
	 * @return Category[]
	 */
	function findAllOrdered();

}