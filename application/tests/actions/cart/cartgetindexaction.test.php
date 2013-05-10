<?php

use Rhine\Actions\Cart\CartGetIndexAction;

class CartGetIndexActionTest extends Tests\ActionTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new CartGetIndexAction();
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