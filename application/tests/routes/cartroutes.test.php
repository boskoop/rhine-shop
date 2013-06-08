<?php

use Rhine\RhineIoC;
use Rhine\Services\Impl\CartServiceImpl;

class CartRoutesTest extends Tests\RouteTestCase
{

	/**
	 * Tests the cart-route.
	 *
	 * @return void
	 */
	public function testCart()
	{
		$response = $this->httpGet('cart');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests adding a product to the cart.
	 *
	 * @return void
	 */
	public function testAddToCart()
	{
		$cart = Ioc::resolve('cartService')->loadCart();
		$this->assertTrue($cart->isEmpty());
		$response = $this->httpPost('cart/add/1', array('csrf_token' => Session::token()));
		$this->assertTrue($response->foundation->isRedirect());

		$cart = Ioc::resolve('cartService')->loadCart();
		$this->assertFalse($cart->isEmpty());
		$response = $this->httpGet('cart');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests subtracting a product from the cart.
	 *
	 * @return void
	 */
	public function testSubtractFromCart()
	{
		$cart = Ioc::resolve('cartService')->loadCart();
		$cart->addPosition(1);
		$cart->addPosition(1);
		$this->assertFalse($cart->isEmpty());
		$this->assertEquals(2, $cart->getTotalQuantity());

		$response = $this->httpPost('cart/sub/1', array('csrf_token' => Session::token()));
		$this->assertTrue($response->foundation->isRedirect());
		$cart = Ioc::resolve('cartService')->loadCart();
		$this->assertFalse($cart->isEmpty());
		$this->assertEquals(1, $cart->getTotalQuantity());

		$response = $this->httpPost('cart/sub/1', array('csrf_token' => Session::token()));
		$this->assertTrue($response->foundation->isRedirect());
		$cart = Ioc::resolve('cartService')->loadCart();
		$this->assertTrue($cart->isEmpty());

		$response = $this->httpGet('cart');
		$this->assertTrue($response->foundation->isOk());
	}

	/**
	 * Tests deleting a product from the cart.
	 *
	 * @return void
	 */
	public function testClearFromCart()
	{
		$cart = Ioc::resolve('cartService')->loadCart();
		$cart->addPosition(1);
		$cart->addPosition(1);
		$cart->addPosition(2);
		$this->assertFalse($cart->isEmpty());
		$this->assertEquals(3, $cart->getTotalQuantity());

		$response = $this->httpPost('cart/del/1', array('csrf_token' => Session::token()));
		$this->assertTrue($response->foundation->isRedirect());
		$cart = Ioc::resolve('cartService')->loadCart();
		$this->assertFalse($cart->isEmpty());
		$this->assertEquals(1, $cart->getTotalQuantity());

		$response = $this->httpPost('cart/del/2', array('csrf_token' => Session::token()));
		$this->assertTrue($response->foundation->isRedirect());
		$cart = Ioc::resolve('cartService')->loadCart();
		$this->assertTrue($cart->isEmpty());

		$response = $this->httpGet('cart');
		$this->assertTrue($response->foundation->isOk());
	}

}