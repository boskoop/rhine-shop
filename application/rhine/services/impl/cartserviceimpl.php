<?php namespace Rhine\Services\Impl;

use Rhine\Services\CartService;
use Rhine\DomainModels\Cart\CartBo;
use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartFactory;
use Laravel\Session;

class CartServiceImpl implements CartService
{

	private $cart;
	private $cartFactory;

	public function __construct(CartFactory $cartFactory)
	{
		$this->cartFactory = $cartFactory;
		$this->cart = null;
	}

	public function loadCart()
	{
		if ($this->cart != null) {
			return $this->cart;
		}

		if (!Session::has('cart')) {
			Session::put('cart', CartDto::createEmptyCart());
		}
		$sessionCart = Session::get('cart');
		$this->cart = $this->cartFactory->createCartFromDto($sessionCart);
		return $this->cart;
	}

	public function saveCart(CartBo $cart)
	{
		$this->cart = $cart;
		$sessionCart = CartDto::createFromCart($cart);
		Session::put('cart', $sessionCart);
	}

}