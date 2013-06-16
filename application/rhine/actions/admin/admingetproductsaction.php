<?php namespace Rhine\Actions\Admin;

use Laravel\View;
use Rhine\Repositories\CategoryRepository;
use User;

class AdminGetProductsAction
{

	private $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		$categories = $this->categoryRepository->findAllOrdered();
		$products = array();
		foreach($categories as $category) {
			$catProducts = $category->products()->get();
			$products = array_merge($products, $catProducts);
		}

		return View::make('admin.products')
		->with(compact('products'))
		->with(compact('user'));
	}

}