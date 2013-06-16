<?php namespace Rhine\Actions\Cart;

use Rhine\Services\CartService;
use Rhine\Repositories\AddressRepository;
use Laravel\View;
use User;

class CartGetCheckoutAction
{

	private $cartService;
	private $addressRepository;

	function __construct(CartService $cartService,
		AddressRepository $addressRepository)
	{
		$this->cartService = $cartService;
		$this->addressRepository = $addressRepository;
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
		$address = $this->addressRepository->findByUserId($user->id);

		return View::make('cart.checkout')
		->with(compact('cart'))
		->with(compact('user'))
		->with(compact('address'));
	}

}