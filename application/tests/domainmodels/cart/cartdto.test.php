<?php

use Rhine\DomainModels\Cart\CartDto;
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

	public function testCreateFromCart()
	{
		$productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');
		$cart = new CartImpl($productRepositoryMock);
		$cart->addPosition(1);
		$cart->addPosition(2);

		$dto = CartDto::createFromCart($cart);
		
		$positionsDtoArray = $dto->getPositions();
		$this->assertEquals(2, sizeof($positionsDtoArray));
	}

	public function testCartPositionDtoQuantities()
	{
		$productRepositoryMock = $this->getMock('Rhine\Repositories\ProductRepository');
		$cart = new CartImpl($productRepositoryMock);
		$cart->addPosition(2);
		$cart->addPosition(2);
		$cart->addPosition(1);
		$cart->addPosition(3);
		$cart->addPosition(3);
		$cart->addPosition(3);

		$dto = CartDto::createFromCart($cart);
		
		$positionsDtoArray = $dto->getPositions();
		$this->assertEquals(3, sizeof($positionsDtoArray));
		$this->assertEquals(2, $positionsDtoArray[0]->getId());
		$this->assertEquals(2, $positionsDtoArray[0]->getQuantity());
		$this->assertEquals(1, $positionsDtoArray[1]->getId());
		$this->assertEquals(1, $positionsDtoArray[1]->getQuantity());
		$this->assertEquals(3, $positionsDtoArray[2]->getId());
		$this->assertEquals(3, $positionsDtoArray[2]->getQuantity());
	}

}