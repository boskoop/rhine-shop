<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use Laravel\Response;
use Rhine\Repositories\CategoryRepository;
use User;
use Category;

class AdminPostAddCategoryAction
{

	private $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null, $name)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		// TODO: use category repository / validator
		if ($name == null or strlen($name) < 1) {
			return Response::error('404');
		}
		$id = Category::max('id') + 1;
		$order = Category::max('order') + 1;
		Category::create(array(
			'id' => $id,
			'name' => $name,
			'order' => $order));

		return Redirect::to_route('manage_categories');
	}

}