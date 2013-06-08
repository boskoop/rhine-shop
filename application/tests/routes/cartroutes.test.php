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

}