<?php namespace Rhine\BusinessModels;

interface CartFactory
{

	/**
	 * @return Cart
	 */
	function createCart();

}
