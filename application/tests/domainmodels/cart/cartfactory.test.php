<?php

use Rhine\DomainModels\Cart\Impl\CartFactoryImpl;
use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartPositionDto;

class CartFactoryTest extends Tests\UnitTestCase
{

	private $cartFactory;

	protected function setUpInternal()
	{
		$productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');
		$this->cartFactory = new CartFactoryImpl($productRepositoryMock);
	}

	public function testEmpty()
	{
		$dto = CartDto::createEmptyCart();

		$cart = $this->cartFactory->createCartFromDto($dto);
		$this->assertTrue($cart->isEmpty());
	}

	public function testDtoPositions()
	{
		$dto = CartDto::createEmptyCart();
		$position1 = new CartPositionDto(3, 5);
		$position2 = new CartPositionDto(1, 8);
		$dtoPositions = array($position1, $position2);
		$dto->setPositions($dtoPositions);

		$cart = $this->cartFactory->createCartFromDto($dto);
		
		$this->assertFalse($cart->isEmpty());
		$cartPositions = $cart->getPositions();
		$this->assertEquals(3, $cartPositions[0]->getProductId());
		$this->assertEquals(5, $cartPositions[0]->getQuantity());
		$this->assertEquals(1, $cartPositions[1]->getProductId());
		$this->assertEquals(8, $cartPositions[1]->getQuantity());
	}

}