<?php namespace Rhine\DomainModels\Cart;

interface CartFactory
{

	/**
	 * @return CartBo
	 */
	function createCartFromDto(CartDto $dto);

}
