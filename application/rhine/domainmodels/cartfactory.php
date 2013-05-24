<?php namespace Rhine\DomainModels;

interface CartFactory
{

	/**
	 * @return Cart
	 */
	function createCart($positions);

}
