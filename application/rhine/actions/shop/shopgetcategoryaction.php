<?php namespace Rhine\Actions\Shop;

use Laravel\View;
use Rhine\Repositories\CategoryRepository;

class ShopGetCategoryAction
{

	private $categoryRepository;
	private $productRepository;

	function __construct($categoryRepository, $productRepository)
	{
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
	}

	/**
	 * @return View
	 */
	public function execute($id)
	{
		$category = $this->categoryRepository->findById($id);
		
		if (is_null($category)) {
			return Response::error('404');
		}

		$categories = $this->categoryRepository->findAllOrdered();
		$products = $this->productRepository->findByCategory($category);

		return View::make('shop.index')
		->with(compact('categories'))
		->with(compact('products'));
	}

}
