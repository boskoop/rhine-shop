<?php namespace Rhine\Services;

use Rhine\DomainModels\Cart\CartBo;

interface CartService
{

	/**
	 * Returns the cart.
	 * 
	 * @return Cart
	 */
	function loadCart();

	/**
	 * Saves the cart.
	 * 
	 * @return void
	 */
	function saveCart(CartBo $cart);

}