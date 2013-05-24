<?php namespace Rhine\DomainModels\Cart;

interface CartFactory
{

	/**
	 * @return Cart
	 */
	function createCartFromDto(CartDto $dto);

}
