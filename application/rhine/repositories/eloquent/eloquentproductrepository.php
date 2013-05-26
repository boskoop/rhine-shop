<?php namespace Rhine\Repositories\Eloquent;

use Product;
use Laravel\Config;
use Rhine\Repositories\ProductRepository;
use Laravel\Paginator;

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

	function findById($id)
	{
		return Product::where('id', '=', $id)->first();
	}

	function searchByProductNamePaginated($nameQuery)
	{
		return Paginator::make(array(), 0, 6);
	}

}