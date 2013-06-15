<?php

use Rhine\Actions\Cart\CartGetIndexAction;

/**
 * @group unit
 */
class CartGetIndexActionTest extends Tests\UnitTestCase
{

	private $action;
	private $cartServiceMock;

	protected function setUpInternal()
	{
		$this->cartServiceMock = $this->getMock('Rhine\Services\CartService');
		$this->action = new CartGetIndexAction($this->cartServiceMock);
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$response = $this->action->execute();

		$this->assertResponseViewNameIs('cart.index', $response);
	}

}