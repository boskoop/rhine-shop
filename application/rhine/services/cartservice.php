<?php namespace Rhine\Services;

use Rhine\BusinessModels\Cart;

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
	function saveCart(Cart $cart);

}