<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use Laravel\Response;
use Rhine\Repositories\ProductRepository;
use User;
use Category;

class AdminPostAddProductAction
{

	private $productRepository;

	public function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
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
		

		return Redirect::to_route('manage_products');
	}

}