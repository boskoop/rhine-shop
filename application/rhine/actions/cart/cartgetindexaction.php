<?php namespace Rhine\Actions\Cart;

use Rhine\Services\CartService;
use Laravel\View;

class CartGetIndexAction
{

	private $cartService;

	function __construct(CartService $cartService)
	{
		$this->cartService = $cartService;
	}

	/**
	 * @return View
	 */
	public function execute()
	{
		$cart = $this->cartService->loadCart();

		return View::make('cart.index')
		->with(compact('cart'));
	}

}