<?php namespace Rhine\Services\Impl;

use Rhine\Services\CartService;
use Rhine\BusinessModels\Cart;
use Rhine\BusinessModels\CartFactory;

class CartServiceImpl implements CartService
{

	private $cartFactory;

	public function __construct(CartFactory $cartFactory)
	{
		$this->cartFactory = $cartFactory;
	}

	public function loadCart()
	{
		return $this->cartFactory->createCart();
	}

	public function saveCart(Cart $cart)
	{
		// todo
	}

}