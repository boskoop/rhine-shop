<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use Rhine\Repositories\CategoryRepository;
use User;
use Category;

class AdminPostDeleteCategoryAction
{

	private $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null, $categoryId)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		// TODO: use category repository
		$category = Category::find($categoryId);
		if ($category != null) {
			$category->delete();
		}

		return Redirect::to_route('manage_categories');
	}

}