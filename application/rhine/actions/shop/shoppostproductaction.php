<?php namespace Rhine\Actions\Shop;

use Laravel\View;
use Laravel\Response;
use Rhine\Repositories\CategoryRepository;
use Rhine\Repositories\ProductRepository;
use Rhine\Services\CartService;

class ShopPostProductAction
{

	private $categoryRepository;
	private $productRepository;
	private $cartService;

	function __construct(CategoryRepository $categoryRepository, 
		ProductRepository $productRepository, 
		CartService $cartService)
	{
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
		$this->cartService = $cartService;
	}

	/**
	 * @return View
	 */
	public function execute($id)
	{
		$product = $this->productRepository->findById($id);

		if (is_null($product)) {
			return Response::error('404');
		}

		$cart = $this->cartService->loadCart();
		$cart->addPosition($id);
		$this->cartService->saveCart($cart);

		$productCategory = $this->categoryRepository->findByProduct($product);
		$categories = $this->categoryRepository->findAllOrdered();
		$activeCategory = null;

		return View::make('shop.addproduct')
		->with(compact('categories'))
		->with(compact('product'))
		->with(compact('productCategory'))
		->with(compact('activeCategory'));
	}

}
