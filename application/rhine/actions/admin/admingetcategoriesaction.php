<?php namespace Rhine\Actions\Admin;

use Laravel\View;
use Rhine\Repositories\CategoryRepository;
use User;

class AdminGetCategoriesAction
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

		return View::make('admin.categories')
		->with(compact('categories'))
		->with(compact('user'));
	}

}