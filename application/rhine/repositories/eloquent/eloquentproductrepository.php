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

	function searchByProductNamePaginated(array $nameQuery)
	{
		if (count($nameQuery) < 1) {
			throw new \InvalidArgumentException('Search query must at least contain one element.');
		}
		$productsPerPage = Config::get('rhine.products#per_page', 9);
		$query = Product::where('name', 'like', '%'.$nameQuery[0].'%');
		for ($i = 1; $i < count($nameQuery); $i++) {
			$query = $query->where('name', 'like', '%'.$nameQuery[$i].'%');
		}
		return $query->paginate($productsPerPage);
	}

}