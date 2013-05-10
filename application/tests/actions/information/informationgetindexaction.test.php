<?php

use Rhine\Actions\Information\InformationGetIndexAction;

class InformationGetIndexActionTest extends Tests\ActionTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new InformationGetIndexAction();
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$response = $this->action->execute();

		$this->assertResponseViewNameIs('information.index', $response);
	}

}