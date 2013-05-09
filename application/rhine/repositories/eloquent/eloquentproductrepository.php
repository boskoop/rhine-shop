<?php namespace Rhine\Repositories\Eloquent;

use Product;
use Laravel\Config;
use Rhine\Repositories\ProductRepository;

class EloquentProductRepository implements ProductRepository
{
	
	function findByCategoryOrderedAndPaginated($category)
	{
		$productsPerPage = Config::get('rhine.products#per_page', 9);
		return $category->products()->order_by('name', 'asc')->paginate($productsPerPage);
	}

	function findAllOrderedAndPaginated()
	{
		$productsPerPage = Config::get('rhine.products#per_page', 9);
		return Product::order_by('name', 'asc')->paginate($productsPerPage);
	}

}