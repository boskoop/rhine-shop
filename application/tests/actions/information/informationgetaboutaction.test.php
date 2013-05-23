<?php

use Rhine\Actions\Information\InformationGetAboutAction;

class InformationGetAboutActionTest extends Tests\UnitTestCase
{

	private $action;

	protected function setUpInternal()
	{
		$this->action = new InformationGetAboutAction();
	}

	/**
	 * Tests the action for the happy case.
	 *
	 * @return void
	 */
	public function testOk()
	{
		$response = $this->action->execute();

		$this->assertResponseViewNameIs('information.about', $response);
	}

}