<?php

use Rhine\Actions\Information\InformationGetToBAction;

class InformationGetToBActionTest extends Tests\ActionTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new InformationGetToBAction();
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$response = $this->action->execute();

		$this->assertResponseViewNameIs('information.tob', $response);
	}

}