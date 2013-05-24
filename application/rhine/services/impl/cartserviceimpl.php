<?php namespace Rhine\Services\Impl;

use Rhine\Services\CartService;
use Rhine\DomainModels\Cart\Cart;
use Rhine\DomainModels\Cart\CartFactory;
use Laravel\Session;
class CartServiceImpl implements CartService
{

	private $cartFactory;

	public function __construct(CartFactory $cartFactory)
	{
		$this->cartFactory = $cartFactory;
	}

	public function loadCart()
	{
		if (!Session::has('cart')) {
			Session::put('cart', array());
		}
		$sessionCart = Session::get('cart');
		$cart = $this->cartFactory->createCart($sessionCart);
		return $cart;
	}

	public function saveCart(Cart $cart)
	{
		$sessionCart = $this->extractSessionCartArray($cart);
		Session::put('cart', $sessionCart);
	}

	public function extractSessionCartArray(Cart $cart)
	{
		$sessionCart = array();
		foreach((array)$cart->getPositions() as $position) {
			$sessionCart[''.$position->getProductId()] = $position->getQuantity();
		}
		return $sessionCart;
	}

}