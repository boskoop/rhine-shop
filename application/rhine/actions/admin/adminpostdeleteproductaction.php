<?php namespace Rhine\Actions\Admin;

use Laravel\Redirect;
use Rhine\Repositories\ProductRepository;
use User;
use Product;

class AdminPostDeleteProductAction
{

	private $productRepository;

	public function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null, $productId)
	{
		if ($user == null or !$user->isAdmin()) {
			throw new \LogicException('User not authenticated!');
		}

		// TODO: use product repository
		$product = Product::find($productId);
		if ($product != null) {
			$product->delete();
		}

		return Redirect::to_route('manage_products');
	}

}