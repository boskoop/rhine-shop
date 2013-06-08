<?php

use Laravel\Session;
use Laravel\IoC;

use Rhine\RhineIoC;
use Rhine\Services\Impl\CartServiceImpl;
use Rhine\DomainModels\Cart\CartDto;
use Rhine\DomainModels\Cart\CartPositionDto;

class CartServiceTest extends Tests\PersistenceTestCase
{

	private $cartService;

	protected function setUpInternal()
	{
		$factory = IoC::resolve('cartFactory');
		$this->cartService = new CartServiceImpl($factory);
	}

	public function testNewCart()
	{
		$this->assertFalse(Session::has('cart'));

		$cart = $this->cartService->loadCart();

		$this->assertTrue($cart->isEmpty());
		$this->assertTrue(Session::has('cart'));
		$sessionCart = Session::get('cart');
		$this->assertInstanceOf('Rhine\DomainModels\Cart\CartDto', $sessionCart);
		$this->assertEquals(0, sizeof($sessionCart->getPositions()));
	}

	public function testLoadCart()
	{
		$dto = CartDto::createEmptyCart();
		$dto->setPositions(array(new CartPositionDto(2, 3)));
		Session::put('cart', $dto);
		$this->assertTrue(Session::has('cart'));

		$cart = $this->cartService->loadCart();

		$positions = $cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(2, $positions[0]->getProductId());
		$this->assertEquals(3, $positions[0]->getQuantity());
	}

	public function testSaveCart()
	{
		$dto = CartDto::createEmptyCart();
		$dto->setPositions(array(new CartPositionDto(3, 1)));
		$factory = IoC::resolve('cartFactory');
		$cachedCart = $factory->createCartFromDto($dto);

		$this->cartService->saveCart($cachedCart);

		$this->assertTrue(Session::has('cart'));
		$sessionCart = Session::get('cart');
		$this->assertInstanceOf('Rhine\DomainModels\Cart\CartDto', $sessionCart);
		$sessionPositions = $sessionCart->getPositions();
		$this->assertEquals(1, sizeof($sessionPositions));
		$this->assertEquals(3, $sessionPositions[0]->getId());
		$this->assertEquals(1, $sessionPositions[0]->getQuantity());

		$cart = $this->cartService->loadCart();
		$this->assertFalse($cart->isEmpty());
		$positions = $cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(3, $positions[0]->getProductId());
		$this->assertEquals(1, $positions[0]->getQuantity());

	}

	public function testCartCache()
	{
		$dto = CartDto::createEmptyCart();
		$dto->setPositions(array(new CartPositionDto(1, 1)));
		$factory = IoC::resolve('cartFactory');
		$cachedCart = $factory->createCartFromDto($dto);
		$this->cartService->saveCart($cachedCart);
		Session::forget('cart');
		$this->assertFalse(Session::has('cart'));

		$cart = $this->cartService->loadCart();

		$this->assertFalse(Session::has('cart'));
		$positions = $cart->getPositions();
		$this->assertEquals(1, sizeof($positions));
		$this->assertEquals(1, $positions[0]->getProductId());
	}

}