<?php namespace Rhine\Actions\Cart;

use Rhine\Services\CartService;
use Rhine\Services\OrderService;
use Laravel\Validator;
use Laravel\Redirect;
use User;

class CartPostCheckoutAction
{

	private $cartService;
	private $orderService;

	function __construct(CartService $cartService,
		OrderService $orderService)
	{
		$this->cartService = $cartService;
		$this->orderService = $orderService;
	}

	/**
	 * @return View
	 */
	public function execute(User $user, $input)
	{
		if ($user == null) {
			throw new \LogicException('User not authenticated!');
		}

		$rules = array('terms' => 'accepted');
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to_route('checkout')
			->with_errors($validation);
			return $validation->errors;
		}

		$cart = $this->cartService->loadCart();

		$this->orderService->placeOrder($user, $cart);

		$cart->clear();
		$this->cartService->saveCart($cart);

		return Redirect::to_route('orders')
		->with('success', 'order_placed');
	}

}