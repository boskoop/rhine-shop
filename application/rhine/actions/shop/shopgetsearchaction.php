<?php namespace Rhine\Actions\Shop;

use Laravel\View;
use Rhine\Services\SearchService;
use Rhine\Repositories\CategoryRepository;
use Rhine\Services\SearchQueryTooShortException;

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
		$categories = $this->categoryRepository->findAllOrdered();
		$activeCategory = null;

		$queryWords = explode('/', $argument);
		$query = str_replace('/', ' ', $argument);
		try {
			$products = $this->searchService->searchProduct($queryWords);
		} catch (SearchQueryTooShortException $e) {
			return View::make('shop.searcherror')
			->with(compact('categories'))
			->with(compact('query'))
			->with(compact('activeCategory'));
		}

		return View::make('shop.search')
		->with(compact('products'))
		->with(compact('categories'))
		->with(compact('query'))
		->with(compact('activeCategory'));
	}

}
