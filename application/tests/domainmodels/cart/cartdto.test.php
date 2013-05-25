<?php

use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartPositionDto;
use Rhine\DomainModels\Cart\Impl\CartImpl;

class CartDtoTest extends Tests\UnitTestCase
{

	public function testCreateEmpty()
	{
		$dto = CartDto::createEmptyCart();

		$positionsDtoArray = $dto->getPositions();
		$this->assertEquals(0, sizeof($positionsDtoArray));
	}

	public function testCreateFromEmptyCart()
	{
		$productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');
		$cart = new CartImpl($productRepositoryMock);

		$dto = CartDto::createFromCart($cart);
		
		$positionsDtoArray = $dto->getPositions();
		$this->assertEquals(0, sizeof($positionsDtoArray));
	}

}