<?php namespace Rhine\DomainModels\Cart;

interface CartFactory
{

	/**
	 * @return Cart
	 */
	function createCart($positions);

}
