<?php namespace Rhine\Actions\Shop;

use Laravel\View;
use Rhine\Repositories\CategoryRepository;
use Rhine\Repositories\ProductRepository;

class ShopGetIndexAction
{

	private $categoryRepository;
	private $productRepository;

	function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
	{
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
	}

	/**
	 * @return View
	 */
	public function execute()
	{
		
		$categories = $this->categoryRepository->findAllOrdered();
		$products = $this->productRepository->findAllOrdered();

		return View::make('shop.index')
		->with(compact('categories'))
		->with(compact('products'));
	}

}
