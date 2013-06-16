<?php namespace Rhine\Actions\Cart;

use Rhine\Services\CartService;
use Laravel\View;
use User;

class CartGetCheckoutAction
{

	private $cartService;

	function __construct(CartService $cartService)
	{
		$this->cartService = $cartService;
	}

	/**
	 * @return View
	 */
	public function execute(User $user = null)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		$cart = $this->cartService->loadCart();

		return View::make('cart.checkout')
		->with(compact('cart'))
		->with(compact('user'));
	}

}