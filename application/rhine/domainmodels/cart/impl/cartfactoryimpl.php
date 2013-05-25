<?php namespace Rhine\DomainModels\Cart\Impl;

use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartFactory;
use Laravel\IoC;

class CartFactoryImpl implements CartFactory
{

	public function createCartFromDto(CartDto $dto)
	{
		$cart = IoC::resolve('cart');
		foreach ($dto->getPositions() as $position) {
			$cart->addPositionWithQuantity($position->getId(), $position->getQuantity());
		}
		return $cart;
	}
}