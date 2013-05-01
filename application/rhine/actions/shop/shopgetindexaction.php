<?php namespace Rhine\Actions\Shop;

use Laravel\View;
use Rhine\Repositories\CategoryRepository;

class ShopGetIndexAction
{

	private $categoryRepository;

	function __construct($categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

    /**
     * @return View
     */
    public function execute() {
        
        $categories = $this->categoryRepository->findAllOrdered();

        return View::make('shop.index')
                ->with(compact('categories'));
    }

}
