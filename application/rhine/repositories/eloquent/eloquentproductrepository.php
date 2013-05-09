<?php namespace Rhine\Repositories\Eloquent;

use Product;
use Rhine\Repositories\ProductRepository;

class EloquentProductRepository implements ProductRepository
{
	
	function findByCategory($category)
	{
		return $category->products()->order_by('name', 'asc')->get();
	}

	function findAllOrdered()
	{
		return Product::order_by('name', 'asc')->get();
	}

}