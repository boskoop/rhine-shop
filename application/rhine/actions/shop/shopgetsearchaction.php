<?php namespace Rhine\Actions\Shop;

use Laravel\View;
use Rhine\Services\SearchService;
use Rhine\Repositories\CategoryRepository;

class ShopGetSearchAction
{

	private $categoryRepository;
	private $searchService;

	function __construct(CategoryRepository $categoryRepository, SearchService $searchService)
	{
		$this->categoryRepository = $categoryRepository;
		$this->searchService = $searchService;
	}

	/**
	 * @return View
	 */
	public function execute($argument)
	{
		$query = $argument;
		$products = $this->searchService->searchProduct($argument);

		$categories = $this->categoryRepository->findAllOrdered();
		$activeCategory = null;

		return View::make('shop.search')
		->with(compact('products'))
		->with(compact('categories'))
		->with(compact('query'))
		->with(compact('activeCategory'));
	}

}
