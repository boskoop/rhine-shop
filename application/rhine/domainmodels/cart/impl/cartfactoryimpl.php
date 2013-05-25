<?php namespace Rhine\DomainModels\Cart\Impl;

use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartFactory;
use Rhine\Repositories\ProductRepository;

class CartFactoryImpl implements CartFactory
{

	private $productRepository;

	public function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}

	public function createCartFromDto(CartDto $dto)
	{
		$cart = new CartImpl($this->productRepository);
		foreach ($dto->getPositions() as $position) {
			$cart->addPositionWithQuantity($position->getId(), $position->getQuantity());
		}
		return $cart;
	}
}