<?php namespace Rhine\Services;

use Product;

interface CartService
{
	
	/**
	 * Adds a product to the cart.
	 * 
	 * @return void
	 */
	function addToCart($productId);
	
	/**
	 * Checks if the cart is empty.
	 * 
	 * @return boolean
	 */
	function cartEmpty();

}